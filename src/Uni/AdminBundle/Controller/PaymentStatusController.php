<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\PaymentStatus;
use Uni\AdminBundle\Form\PaymentStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paymentstatus controller.
 *
 */
class PaymentStatusController extends Controller
{

    /**
     * Lists all PaymentStatus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $paymentStatuses = $em->getRepository('UniAdminBundle:PaymentStatus')->findBy(array(), array($sort => $direction));
        else $paymentStatuses = $em->getRepository('UniAdminBundle:PaymentStatus')->findAll();
        $paginator = $this->get('knp_paginator');
        $paymentStatuses = $paginator->paginate($paymentStatuses, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($paymentStatuses as $key => $paymentStatus) {
            $deleteForms[] = $this->createDeleteForm($paymentStatus)->createView();
        }

        return $this->render('UniAdminBundle:PaymentStatus:index.html.twig', array(
            'paymentStatuses' => $paymentStatuses,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PaymentStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $paymentStatus = new PaymentStatus();
        $newForm = $this->createNewForm($paymentStatus);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($paymentStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'paymentStatus.new.flash' );
                return $this->redirect($this->generateUrl('admin_paymentstatus_index'));
            }
        }

        return $this->render('UniAdminBundle:PaymentStatus:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new PaymentStatus entity.
     *
     * @param PaymentStatus $paymentStatus The PaymentStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PaymentStatus $paymentStatus)
    {
        return $this->createForm(new PaymentStatusType(), $paymentStatus, array(
            'action' => $this->generateUrl('admin_paymentstatus_new'),
        ));
    }

    /**
     * Finds and displays a PaymentStatus entity.
     *
     */
    public function showAction(PaymentStatus $paymentStatus)
    {
        $editForm = $this->createEditForm($paymentStatus);
        $deleteForm = $this->createDeleteForm($paymentStatus);

        return $this->render('UniAdminBundle:PaymentStatus:show.html.twig', array(
            'paymentStatus' => $paymentStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaymentStatus entity.
     *
     */
    public function editAction(Request $request, PaymentStatus $paymentStatus)
    {
        $editForm = $this->createEditForm($paymentStatus);
        $deleteForm = $this->createDeleteForm($paymentStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($paymentStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'paymentStatus.edit.flash' );
                return $this->redirect($this->generateUrl('admin_paymentstatus_index'));
            }
        }

        return $this->render('UniAdminBundle:PaymentStatus:edit.html.twig', array(
            'paymentStatus' => $paymentStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a PaymentStatus entity.
     *
     * @param PaymentStatus $paymentStatus The PaymentStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PaymentStatus $paymentStatus)
    {
        return $this->createForm(new PaymentStatusType(), $paymentStatus, array(
            'action' => $this->generateUrl('admin_paymentstatus_edit', array('id' => $paymentStatus->getId())),
        ));
    }

    /**
     * Deletes a PaymentStatus entity.
     *
     */
    public function deleteAction(Request $request, PaymentStatus $paymentStatus)
    {
        $deleteForm = $this->createDeleteForm($paymentStatus);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paymentStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'paymentStatus.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_paymentstatus_index'));
    }

    /**
     * Creates a form to delete a PaymentStatus entity.
     *
     * @param PaymentStatus $paymentStatus The PaymentStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaymentStatus $paymentStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_paymentstatus_delete', array('id' => $paymentStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
