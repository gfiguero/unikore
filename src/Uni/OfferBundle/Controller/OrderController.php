<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Order;
use Uni\AdminBundle\Entity\Budget;
use Uni\AdminBundle\Entity\Invoice;
use Uni\OfferBundle\Form\OrderType;
use Uni\OfferBundle\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Order controller.
 *
 */
class OrderController extends Controller
{

    /**
     * Lists all Order entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $orders = $em->getRepository('UniAdminBundle:Order')->findBy(array('account' => $account), array($sort => $direction));
        else $orders = $em->getRepository('UniAdminBundle:Order')->findBy(array('account' => $account), array('updated_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $orders = $paginator->paginate($orders, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($orders as $key => $order) $deleteForms[] = $this->createDeleteForm($order)->createView();

        return $this->render('UniOfferBundle:Order:index.html.twig', array(
            'orders' => $orders,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Order entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $order = new Order();
        $newForm = $this->createNewForm($order);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $order->setUser($user);
                $order->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'order.new.flash' );
                return $this->redirect($this->generateUrl('offer_order_show', array('id' => $order->getId())));
            }
        }

        return $this->render('UniOfferBundle:Order:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Order entity.
     *
     * @param Order $order The Order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Order $order)
    {
        return $this->createForm(OrderType::class, $order, array(
            'action' => $this->generateUrl('offer_order_new'),
        ));
    }

    public function addAction(Request $request, Budget $budget)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $budget->getAccount()) return $this->redirect($this->generateUrl('offer_order_index'));

        $order = new Order();
        $addForm = $this->createAddForm($order, $budget);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted()) {
            if($addForm->isValid()) {
                $order->setUser($user);
                $order->setAccount($account);
                $order->setBudget($budget);
                $order->setAmount($budget->getTotal());
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'order.new.flash' );
                return $this->redirect($this->generateUrl('offer_order_show', array('id' => $order->getId())));
            }
        }

        return $this->redirect($this->generateUrl('offer_budget_show', array('id' => $budget->getId())));
    }

    private function createAddForm(Order $order, Budget $budget)
    {
        return $this->createForm(OrderType::class, $order, array(
            'action' => $this->generateUrl('offer_order_add', array('id' => $budget->getId())),
        ))->remove('budget')->remove('amount');
    }

    /**
     * Finds and displays a Order entity.
     *
     */
    public function showAction(Order $order)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $order->getAccount()) return $this->redirect($this->generateUrl('offer_order_index'));

        $invoices = $order->getInvoices();
        $budget = $order->getBudget();
        $client = ($budget ? $budget->getClient() : null);
        $seller = ($budget ? $budget->getSeller() : null);
        $items =  ($budget ? $budget->getItems() : null);            

        $deleteForm = $this->createDeleteForm($order);

        $newInvoice = new Invoice();
        $newInvoice->setPayIn(new \DateTime('+30 days'));
        $invoiceForm = $this->createInvoiceForm($newInvoice, $order);

        return $this->render('UniOfferBundle:Order:show.html.twig', array(
            'order' => $order,
            'invoices' => $invoices,
            'budget' => $budget,
            'items' => $items,
            'client' => $client,
            'seller' => $seller,
            'invoiceForm' => $invoiceForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    private function createInvoiceForm(Invoice $invoice, Order $order)
    {
        return $this->createForm(InvoiceType::class, $invoice, array(
            'action' => $this->generateUrl('offer_invoice_add', array('id' => $order->getId())),
        ))->remove('order')->remove('amount');
    }

    /**
     * Displays a form to edit an existing Order entity.
     *
     */
    public function editAction(Request $request, Order $order)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $order->getAccount()) return $this->redirect($this->generateUrl('offer_order_index'));

        $editForm = $this->createEditForm($order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'order.edit.flash' );
                return $this->redirect($this->generateUrl('offer_order_show', array('id' => $order->getId())));
            }
        }

        $deleteForm = $this->createDeleteForm($order);

        return $this->render('UniOfferBundle:Order:edit.html.twig', array(
            'order' => $order,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Order entity.
     *
     * @param Order $order The Order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Order $order)
    {
        return $this->createForm(OrderType::class, $order, array(
            'action' => $this->generateUrl('offer_order_edit', array('id' => $order->getId())),
        ));
    }

    /**
     * Deletes a Order entity.
     *
     */
    public function deleteAction(Request $request, Order $order)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $order->getAccount()) {
            return $this->redirect($this->generateUrl('offer_order_index'));
        }
        $deleteForm = $this->createDeleteForm($order);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'order.delete.flash' );
        }

        return $this->redirect($this->generateUrl('offer_order_index'));
    }

    /**
     * Creates a form to delete a Order entity.
     *
     * @param Order $order The Order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Order $order)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_order_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
