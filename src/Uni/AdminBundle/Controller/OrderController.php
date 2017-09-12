<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Order;
use Uni\AdminBundle\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $orders = $em->getRepository('UniAdminBundle:Order')->findBy(array(), array($sort => $direction));
        else $orders = $em->getRepository('UniAdminBundle:Order')->findAll();
        $paginator = $this->get('knp_paginator');
        $orders = $paginator->paginate($orders, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($orders as $key => $order) {
            $deleteForms[] = $this->createDeleteForm($order)->createView();
        }

        return $this->render('UniAdminBundle:Order:index.html.twig', array(
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
        $order = new Order();
        $newForm = $this->createNewForm($order);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'order.new.flash' );
                return $this->redirect($this->generateUrl('admin_order_index'));
            }
        }

        return $this->render('UniAdminBundle:Order:new.html.twig', array(
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
        return $this->createForm(new OrderType(), $order, array(
            'action' => $this->generateUrl('admin_order_new'),
        ));
    }

    /**
     * Finds and displays a Order entity.
     *
     */
    public function showAction(Order $order)
    {
        $editForm = $this->createEditForm($order);
        $deleteForm = $this->createDeleteForm($order);

        return $this->render('UniAdminBundle:Order:show.html.twig', array(
            'order' => $order,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Order entity.
     *
     */
    public function editAction(Request $request, Order $order)
    {
        $editForm = $this->createEditForm($order);
        $deleteForm = $this->createDeleteForm($order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'order.edit.flash' );
                return $this->redirect($this->generateUrl('admin_order_index'));
            }
        }

        return $this->render('UniAdminBundle:Order:edit.html.twig', array(
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
        return $this->createForm(new OrderType(), $order, array(
            'action' => $this->generateUrl('admin_order_edit', array('id' => $order->getId())),
        ));
    }

    /**
     * Deletes a Order entity.
     *
     */
    public function deleteAction(Request $request, Order $order)
    {
        $deleteForm = $this->createDeleteForm($order);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'order.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_order_index'));
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
            ->setAction($this->generateUrl('admin_order_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
