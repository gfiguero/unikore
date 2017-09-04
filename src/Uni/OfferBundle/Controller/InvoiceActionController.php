<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Invoice;
use Uni\AdminBundle\Entity\InvoiceAction;
use Uni\OfferBundle\Form\InvoiceActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvoiceActionController extends Controller
{
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
                $invoiceAction->setInvoice($invoice);
                $em = $this->getDoctrine()->getManager();
                $em->persist($invoiceAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'invoiceAction.new.flash' );
            }
        }

        return $this->redirect($this->generateUrl('offer_invoice_show', array('id' => $invoice->getId())));
    }
}
