<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\AccountPayment;
use Uni\AdminBundle\Form\AccountPaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Accountpayment controller.
 *
 */
class AccountPaymentController extends Controller
{

    /**
     * Lists all AccountPayment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $accountPayments = $em->getRepository('UniAdminBundle:AccountPayment')->findBy(array(), array($sort => $direction));
        else $accountPayments = $em->getRepository('UniAdminBundle:AccountPayment')->findAll();
        $paginator = $this->get('knp_paginator');
        $accountPayments = $paginator->paginate($accountPayments, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($accountPayments as $key => $accountPayment) {
            $deleteForms[] = $this->createDeleteForm($accountPayment)->createView();
        }

        return $this->render('UniAdminBundle:AccountPayment:index.html.twig', array(
            'accountPayments' => $accountPayments,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new AccountPayment entity.
     *
     */
    public function newAction(Request $request)
    {
        $accountPayment = new AccountPayment();
        $newForm = $this->createNewForm($accountPayment);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accountPayment);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'accountPayment.new.flash' );
                return $this->redirect($this->generateUrl('admin_accountpayment_index'));
            }
        }

        return $this->render('UniAdminBundle:AccountPayment:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new AccountPayment entity.
     *
     * @param AccountPayment $accountPayment The AccountPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(AccountPayment $accountPayment)
    {
        return $this->createForm(new AccountPaymentType(), $accountPayment, array(
            'action' => $this->generateUrl('admin_accountpayment_new'),
        ));
    }

    /**
     * Finds and displays a AccountPayment entity.
     *
     */
    public function showAction(AccountPayment $accountPayment)
    {
        $editForm = $this->createEditForm($accountPayment);
        $deleteForm = $this->createDeleteForm($accountPayment);

        return $this->render('UniAdminBundle:AccountPayment:show.html.twig', array(
            'accountPayment' => $accountPayment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AccountPayment entity.
     *
     */
    public function editAction(Request $request, AccountPayment $accountPayment)
    {
        $editForm = $this->createEditForm($accountPayment);
        $deleteForm = $this->createDeleteForm($accountPayment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accountPayment);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'accountPayment.edit.flash' );
                return $this->redirect($this->generateUrl('admin_accountpayment_index'));
            }
        }

        return $this->render('UniAdminBundle:AccountPayment:edit.html.twig', array(
            'accountPayment' => $accountPayment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a AccountPayment entity.
     *
     * @param AccountPayment $accountPayment The AccountPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(AccountPayment $accountPayment)
    {
        return $this->createForm(new AccountPaymentType(), $accountPayment, array(
            'action' => $this->generateUrl('admin_accountpayment_edit', array('id' => $accountPayment->getId())),
        ));
    }

    /**
     * Deletes a AccountPayment entity.
     *
     */
    public function deleteAction(Request $request, AccountPayment $accountPayment)
    {
        $deleteForm = $this->createDeleteForm($accountPayment);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accountPayment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'accountPayment.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_accountpayment_index'));
    }

    /**
     * Creates a form to delete a AccountPayment entity.
     *
     * @param AccountPayment $accountPayment The AccountPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountPayment $accountPayment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_accountpayment_delete', array('id' => $accountPayment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
