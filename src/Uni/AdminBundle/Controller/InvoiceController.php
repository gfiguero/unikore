<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Invoice;
use Uni\AdminBundle\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $invoices = $em->getRepository('UniAdminBundle:Invoice')->findBy(array(), array($sort => $direction));
        else $invoices = $em->getRepository('UniAdminBundle:Invoice')->findAll();
        $paginator = $this->get('knp_paginator');
        $invoices = $paginator->paginate($invoices, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($invoices as $key => $invoice) {
            $deleteForms[] = $this->createDeleteForm($invoice)->createView();
        }

        return $this->render('UniAdminBundle:Invoice:index.html.twig', array(
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
        $invoice = new Invoice();
        $newForm = $this->createNewForm($invoice);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoice);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoice.new.flash' );
                return $this->redirect($this->generateUrl('admin_invoice_index'));
            }
        }

        return $this->render('UniAdminBundle:Invoice:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
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
        return $this->createForm(new InvoiceType(), $invoice, array(
            'action' => $this->generateUrl('admin_invoice_new'),
        ));
    }

    /**
     * Finds and displays a Invoice entity.
     *
     */
    public function showAction(Invoice $invoice)
    {
        $editForm = $this->createEditForm($invoice);
        $deleteForm = $this->createDeleteForm($invoice);

        return $this->render('UniAdminBundle:Invoice:show.html.twig', array(
            'invoice' => $invoice,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     */
    public function editAction(Request $request, Invoice $invoice)
    {
        $editForm = $this->createEditForm($invoice);
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoice);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoice.edit.flash' );
                return $this->redirect($this->generateUrl('admin_invoice_index'));
            }
        }

        return $this->render('UniAdminBundle:Invoice:edit.html.twig', array(
            'invoice' => $invoice,
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
        return $this->createForm(new InvoiceType(), $invoice, array(
            'action' => $this->generateUrl('admin_invoice_edit', array('id' => $invoice->getId())),
        ));
    }

    /**
     * Deletes a Invoice entity.
     *
     */
    public function deleteAction(Request $request, Invoice $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'invoice.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_invoice_index'));
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
            ->setAction($this->generateUrl('admin_invoice_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
