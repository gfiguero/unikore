<?php

namespace Uni\PortfolioBundle\Controller;

use Uni\AdminBundle\Entity\Document;
use Uni\PortfolioBundle\Form\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Document controller.
 *
 */
class DocumentController extends Controller
{

    /**
     * Lists all Document entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $documents = $em->getRepository('UniAdminBundle:Document')->findBy(array('account' => $account), array($sort => $direction));
        else $documents = $em->getRepository('UniAdminBundle:Document')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $documents = $paginator->paginate($documents, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($documents as $key => $document) {
            $deleteForms[] = $this->createDeleteForm($document)->createView();
        }

        return $this->render('UniPortfolioBundle:Document:index.html.twig', array(
            'documents' => $documents,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Document entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $document = new Document();
        $newForm = $this->createNewForm($document);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $document->setUser($user);
                $document->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($document);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'document.new.flash' );
                return $this->redirect($this->generateUrl('portfolio_document_index'));
            }
        }

        return $this->render('UniPortfolioBundle:Document:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Document entity.
     *
     * @param Document $document The Document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Document $document)
    {
        return $this->createForm(DocumentType::class, $document, array(
            'action' => $this->generateUrl('portfolio_document_new'),
        ));
    }

    /**
     * Finds and displays a Document entity.
     *
     */
    public function showAction(Document $document)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $document->getAccount()) return $this->redirect($this->generateUrl('portfolio_document_index'));

        $editForm = $this->createEditForm($document);
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('UniPortfolioBundle:Document:show.html.twig', array(
            'document' => $document,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Document entity.
     *
     */
    public function editAction(Request $request, Document $document)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $document->getAccount()) return $this->redirect($this->generateUrl('portfolio_document_index'));

        $editForm = $this->createEditForm($document);
        $deleteForm = $this->createDeleteForm($document);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($document);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'document.edit.flash' );
                return $this->redirect($this->generateUrl('portfolio_document_index'));
            }
        }

        return $this->render('UniPortfolioBundle:Document:edit.html.twig', array(
            'document' => $document,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Document entity.
     *
     * @param Document $document The Document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Document $document)
    {
        return $this->createForm(new DocumentType(), $document, array(
            'action' => $this->generateUrl('portfolio_document_edit', array('id' => $document->getId())),
        ));
    }

    /**
     * Deletes a Document entity.
     *
     */
    public function deleteAction(Request $request, Document $document)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $document->getAccount()) return $this->redirect($this->generateUrl('portfolio_document_index'));

        $deleteForm = $this->createDeleteForm($document);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'document.delete.flash' );
        }

        return $this->redirect($this->generateUrl('portfolio_document_index'));
    }

    /**
     * Creates a form to delete a Document entity.
     *
     * @param Document $document The Document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Document $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfolio_document_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
