<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\InvoiceAction;
use Uni\AdminBundle\Form\InvoiceActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invoiceaction controller.
 *
 */
class InvoiceActionController extends Controller
{

    /**
     * Lists all InvoiceAction entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $invoiceActions = $em->getRepository('UniAdminBundle:InvoiceAction')->findBy(array(), array($sort => $direction));
        else $invoiceActions = $em->getRepository('UniAdminBundle:InvoiceAction')->findAll();
        $paginator = $this->get('knp_paginator');
        $invoiceActions = $paginator->paginate($invoiceActions, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($invoiceActions as $key => $invoiceAction) {
            $deleteForms[] = $this->createDeleteForm($invoiceAction)->createView();
        }

        return $this->render('UniAdminBundle:InvoiceAction:index.html.twig', array(
            'invoiceActions' => $invoiceActions,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new InvoiceAction entity.
     *
     */
    public function newAction(Request $request)
    {
        $invoiceAction = new InvoiceAction();
        $newForm = $this->createNewForm($invoiceAction);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoiceAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoiceAction.new.flash' );
                return $this->redirect($this->generateUrl('admin_invoiceaction_index'));
            }
        }

        return $this->render('UniAdminBundle:InvoiceAction:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new InvoiceAction entity.
     *
     * @param InvoiceAction $invoiceAction The InvoiceAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(InvoiceAction $invoiceAction)
    {
        return $this->createForm(new InvoiceActionType(), $invoiceAction, array(
            'action' => $this->generateUrl('admin_invoiceaction_new'),
        ));
    }

    /**
     * Finds and displays a InvoiceAction entity.
     *
     */
    public function showAction(InvoiceAction $invoiceAction)
    {
        $editForm = $this->createEditForm($invoiceAction);
        $deleteForm = $this->createDeleteForm($invoiceAction);

        return $this->render('UniAdminBundle:InvoiceAction:show.html.twig', array(
            'invoiceAction' => $invoiceAction,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InvoiceAction entity.
     *
     */
    public function editAction(Request $request, InvoiceAction $invoiceAction)
    {
        $editForm = $this->createEditForm($invoiceAction);
        $deleteForm = $this->createDeleteForm($invoiceAction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoiceAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoiceAction.edit.flash' );
                return $this->redirect($this->generateUrl('admin_invoiceaction_index'));
            }
        }

        return $this->render('UniAdminBundle:InvoiceAction:edit.html.twig', array(
            'invoiceAction' => $invoiceAction,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a InvoiceAction entity.
     *
     * @param InvoiceAction $invoiceAction The InvoiceAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(InvoiceAction $invoiceAction)
    {
        return $this->createForm(new InvoiceActionType(), $invoiceAction, array(
            'action' => $this->generateUrl('admin_invoiceaction_edit', array('id' => $invoiceAction->getId())),
        ));
    }

    /**
     * Deletes a InvoiceAction entity.
     *
     */
    public function deleteAction(Request $request, InvoiceAction $invoiceAction)
    {
        $deleteForm = $this->createDeleteForm($invoiceAction);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoiceAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'invoiceAction.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_invoiceaction_index'));
    }

    /**
     * Creates a form to delete a InvoiceAction entity.
     *
     * @param InvoiceAction $invoiceAction The InvoiceAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvoiceAction $invoiceAction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_invoiceaction_delete', array('id' => $invoiceAction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
