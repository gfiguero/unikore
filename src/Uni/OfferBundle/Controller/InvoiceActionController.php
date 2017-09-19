<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Invoice;
use Uni\AdminBundle\Entity\InvoiceAction;
use Uni\OfferBundle\Form\InvoiceActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvoiceActionController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $invoiceactions = $em->getRepository('UniAdminBundle:InvoiceAction')->findBy(array('account' => $account), array($sort => $direction));
        else $invoiceactions = $em->getRepository('UniAdminBundle:InvoiceAction')->findBy(array('account' => $account), array('created_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $invoiceactions = $paginator->paginate($invoiceactions, $request->query->getInt('page', 1), 100);

        return $this->render('UniOfferBundle:InvoiceAction:index.html.twig', array(
            'invoiceactions' => $invoiceactions,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request, Invoice $invoice)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $invoice->getAccount()) return $this->redirect($this->generateUrl('offer_invoice_index'));

        $invoiceAction = new InvoiceAction();
        $newForm = $this->createForm(new InvoiceActionType(), $invoiceAction);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $invoiceAction->setUser($user);
                $invoiceAction->setAccount($account);
                $invoiceAction->setInvoice($invoice);
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoiceAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoiceaction.new.flash' );
            }
        }

        return $this->redirect($this->generateUrl('offer_invoice_show', array('id' => $invoice->getId())));
    }
}
