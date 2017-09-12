<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Shipment;
use Uni\AdminBundle\Entity\Invoice;
use Uni\OfferBundle\Form\ShipmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Shipment controller.
 *
 */
class ShipmentController extends Controller
{

    /**
     * Lists all Shipment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $shipments = $em->getRepository('UniAdminBundle:Shipment')->findBy(array('account' => $account), array($sort => $direction));
        else $shipments = $em->getRepository('UniAdminBundle:Shipment')->findBy(array('account' => $account), array('updated_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $shipments = $paginator->paginate($shipments, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($shipments as $key => $shipment) $deleteForms[] = $this->createDeleteForm($shipment)->createView();

        return $this->render('UniOfferBundle:Shipment:index.html.twig', array(
            'shipments' => $shipments,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Shipment entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $shipment = new Shipment();
        $newForm = $this->createNewForm($shipment);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $shipment->setUser($user);
                $shipment->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($shipment);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'shipment.new.flash' );
                return $this->redirect($this->generateUrl('offer_shipment_index'));
            }
        }

        return $this->render('UniOfferBundle:Shipment:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Shipment entity.
     *
     * @param Shipment $shipment The Shipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Shipment $shipment)
    {
        return $this->createForm(ShipmentType::class, $shipment, array(
            'action' => $this->generateUrl('offer_shipment_new'),
        ));
    }

    /**
     * Creates a new Shipment entity.
     *
     */
    public function addAction(Request $request, Invoice $invoice)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $shipment = new Shipment();
        $addForm = $this->createAddForm($shipment, $invoice);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted()) {
            if($addForm->isValid()) {
                $shipment->setUser($user);
                $shipment->setAccount($account);
                $shipment->setInvoice($invoice);
                $em = $this->getDoctrine()->getManager();
                $em->persist($shipment);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'shipment.new.flash' );
            }
        }

        return $this->redirect($this->generateUrl('offer_invoice_show', array('id' => $invoice->getId())));
    }

    private function createAddForm(Shipment $shipment, Invoice $invoice)
    {
        return $this->createForm(ShipmentType::class, $shipment, array(
            'action' => $this->generateUrl('offer_shipment_add', array('id' => $invoice->getId())),
        ))->remove('invoice');
    }

    /**
     * Finds and displays a Shipment entity.
     *
     */
    public function showAction(Shipment $shipment)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $shipment->getAccount()) return $this->redirect($this->generateUrl('offer_shipment_index'));
        $editForm = $this->createEditForm($shipment);
        $deleteForm = $this->createDeleteForm($shipment);

        return $this->render('UniOfferBundle:Shipment:show.html.twig', array(
            'shipment' => $shipment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Shipment entity.
     *
     */
    public function editAction(Request $request, Shipment $shipment)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $shipment->getAccount()) return $this->redirect($this->generateUrl('offer_shipment_index'));
        $editForm = $this->createEditForm($shipment);
        $deleteForm = $this->createDeleteForm($shipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($shipment);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'shipment.edit.flash' );
                return $this->redirect($this->generateUrl('offer_shipment_index'));
            }
        }

        return $this->render('UniOfferBundle:Shipment:edit.html.twig', array(
            'shipment' => $shipment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Shipment entity.
     *
     * @param Shipment $shipment The Shipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Shipment $shipment)
    {
        return $this->createForm(ShipmentType::class, $shipment, array(
            'action' => $this->generateUrl('offer_shipment_edit', array('id' => $shipment->getId())),
        ));
    }

    private function createShipmentActionForm(ShipmentAction $shipmentAction, Shipment $shipment)
    {
        return $this->createForm(ShipmentActionType::class, $shipmentAction, array(
            'action' => $this->generateUrl('offer_shipmentaction_new', array('id' => $shipment->getId())),
        ));
    }

    /**
     * Deletes a Shipment entity.
     *
     */
    public function deleteAction(Request $request, Shipment $shipment)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $shipment->getAccount()) return $this->redirect($this->generateUrl('offer_shipment_index'));
        $deleteForm = $this->createDeleteForm($shipment);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shipment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'shipment.delete.flash' );
        }

        return $this->redirect($this->generateUrl('offer_shipment_index'));
    }

    /**
     * Creates a form to delete a Shipment entity.
     *
     * @param Shipment $shipment The Shipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Shipment $shipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_shipment_delete', array('id' => $shipment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
