<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Invoice;
use Uni\AdminBundle\Entity\Order;
use Uni\AdminBundle\Entity\InvoiceAction;
use Uni\AdminBundle\Entity\Shipment;
use Uni\OfferBundle\Form\InvoiceType;
use Uni\OfferBundle\Form\InvoiceActionType;
use Uni\OfferBundle\Form\ShipmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Invoice controller.
 *
 */
class InvoiceController extends Controller
{

    /**
     * Lists all Invoice entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $invoices = $em->getRepository('UniAdminBundle:Invoice')->findBy(array('account' => $account), array($sort => $direction));
        else $invoices = $em->getRepository('UniAdminBundle:Invoice')->findBy(array('account' => $account), array('updated_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $invoices = $paginator->paginate($invoices, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($invoices as $key => $invoice) {
            $deleteForms[] = $this->createDeleteForm($invoice)->createView();
        }

        return $this->render('UniOfferBundle:Invoice:index.html.twig', array(
            'invoices' => $invoices,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Invoice entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $invoice = new Invoice();
        $invoice->setIssuedAt(new \DateTime('now'));
        $invoice->setPayIn(new \DateTime('+ 30 days'));
        $newForm = $this->createNewForm($invoice);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $invoice->setUser($user);
                $invoice->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoice);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoice.new.flash' );
                $this->setAction($invoice, $this->get('translator')->trans('invoiceaction.set.new', array('%user%' => $user, '%invoice%' => $invoice), 'UniOfferBundle'));
                return $this->redirect($this->generateUrl('offer_invoice_index'));
            }
        }

        return $this->render('UniOfferBundle:Invoice:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    private function setAction($invoice, $description)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $invoiceAction = new InvoiceAction();
        $invoiceAction->setInvoice($invoice);
        $invoiceAction->setUser($user);
        $invoiceAction->setAccount($account);
        $invoiceAction->setDescription($description);
        $em = $this->getDoctrine()->getManager();
        $em->persist($invoiceAction);
        $em->flush();
    }

    /**
     * Creates a form to create a new Invoice entity.
     *
     * @param Invoice $invoice The Invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Invoice $invoice)
    {
        return $this->createForm(InvoiceType::class, $invoice, array(
            'action' => $this->generateUrl('offer_invoice_new'),
        ));
    }

    public function addAction(Request $request, Order $order)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $order->getAccount()) return $this->redirect($this->generateUrl('offer_invoice_index'));

        $invoice = new Invoice();
        $addForm = $this->createAddForm($invoice, $order);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted()) {
            if($addForm->isValid()) {
                $invoice->setUser($user);
                $invoice->setAccount($account);
                $invoice->setOrder($order);
                $invoice->setAmount($order->getAmount());
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoice);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoice.new.flash' );
                return $this->redirect($this->generateUrl('offer_invoice_show', array('id' => $invoice->getId())));
            }
        }

        return $this->redirect($this->generateUrl('offer_order_show', array('id' => $order->getId())));
    }

    private function createAddForm(Invoice $invoice, Order $order)
    {
        return $this->createForm(InvoiceType::class, $invoice, array(
            'action' => $this->generateUrl('offer_invoice_add', array('id' => $order->getId())),
        ))->remove('order')->remove('amount');
    }

    /**
     * Finds and displays a Invoice entity.
     *
     */
    public function showAction(Invoice $invoice)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $invoice->getAccount()) return $this->redirect($this->generateUrl('offer_invoice_index'));
        $editForm = $this->createEditForm($invoice);
        $deleteForm = $this->createDeleteForm($invoice);

        $em = $this->getDoctrine()->getManager();
        $invoiceactions = $em->getRepository('UniAdminBundle:InvoiceAction')->findBy(array('invoice' => $invoice), array('created_at' => 'DESC'));
        $shipments = $em->getRepository('UniAdminBundle:Shipment')->findBy(array('invoice' => $invoice), array('created_at' => 'DESC'));

        $invoiceAction = new InvoiceAction();
        $invoiceActionForm = $this->createInvoiceActionForm($invoiceAction, $invoice);

        $shipment = new Shipment();
        $shipmentForm = $this->createAddShipmentForm($shipment, $invoice);

        $user = $invoice->getUser();
        $order = $invoice->getOrder();
        $budget = $order ? $order->getBudget() : null;
        $issuer = $budget ? $budget->getIssuer() : null;
        $client = $budget ? $budget->getClient() : null;
        $seller = $budget ? $budget->getSeller() : null;
        $items = $budget ? $budget->getItems() : null;

        return $this->render('UniOfferBundle:Invoice:show.html.twig', array(
            'invoice' => $invoice,
            'invoiceactions' => $invoiceactions,
            'shipments' => $shipments,
            'user' => $user,
            'order' => $order,
            'budget' => $budget,
            'issuer' => $issuer,
            'items' => $items,
            'client' => $client,
            'seller' => $seller,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
            'shipmentForm' => $shipmentForm->createView(),
            'invoiceActionForm' => $invoiceActionForm->createView(),
        ));
    }

    private function createAddShipmentForm(Shipment $shipment, Invoice $invoice)
    {
        return $this->createForm(ShipmentType::class, $shipment, array(
            'action' => $this->generateUrl('offer_shipment_add', array('id' => $invoice->getId())),
        ))->remove('invoice');
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     */
    public function editAction(Request $request, Invoice $invoice)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $invoice->getAccount()) return $this->redirect($this->generateUrl('offer_invoice_index'));
        $editForm = $this->createEditForm($invoice);
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm->handleRequest($request);

        $originalActions = new ArrayCollection();
        foreach ($invoice->getActions() as $action) $originalActions->add($action);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                foreach ($originalActions as $action) if (false === $invoice->getActions()->contains($action)) $em->remove($action);
                $em->persist($invoice);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoice.edit.flash' );
                $this->setAction($invoice, $this->get('translator')->trans('invoiceaction.set.edit', array('%user%' => $user, '%invoice%' => $invoice), 'UniOfferBundle'));
                return $this->redirect($this->generateUrl('offer_invoice_show', array('id' => $invoice->getId())));
            }
        }

        $order = $invoice->getOrder();
        $budget = $order ? $order->getBudget() : null;
        $client = $budget ? $budget->getClient() : null;
        $issuer = $budget ? $budget->getIssuer() : null;

        return $this->render('UniOfferBundle:Invoice:edit.html.twig', array(
            'invoice' => $invoice,
            'order' => $order,
            'budget' => $budget,
            'client' => $client,
            'issuer' => $issuer,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Invoice entity.
     *
     * @param Invoice $invoice The Invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Invoice $invoice)
    {
        return $this->createForm(InvoiceType::class, $invoice, array(
            'action' => $this->generateUrl('offer_invoice_edit', array('id' => $invoice->getId())),
        ));
    }

    private function createInvoiceActionForm(InvoiceAction $invoiceAction, Invoice $invoice)
    {
        return $this->createForm(InvoiceActionType::class, $invoiceAction, array(
            'action' => $this->generateUrl('offer_invoiceaction_new', array('id' => $invoice->getId())),
        ));
    }

    /**
     * Deletes a Invoice entity.
     *
     */
    public function deleteAction(Request $request, Invoice $invoice)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $invoice->getAccount()) return $this->redirect($this->generateUrl('offer_invoice_index'));
        $deleteForm = $this->createDeleteForm($invoice);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'invoice.delete.flash' );
        }

        return $this->redirect($this->generateUrl('offer_invoice_index'));
    }

    /**
     * Creates a form to delete a Invoice entity.
     *
     * @param Invoice $invoice The Invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Invoice $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_invoice_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
