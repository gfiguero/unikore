<?php

namespace Uni\PageBundle\Controller;

use Uni\AdminBundle\Entity\Link;
use Uni\PageBundle\Form\LinkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Link controller.
 *
 */
class LinkController extends Controller
{

    /**
     * Lists all Link entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $links = $em->getRepository('UniAdminBundle:Link')->findBy(array('account' => $account), array($sort => $direction));
        else $links = $em->getRepository('UniAdminBundle:Link')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $links = $paginator->paginate($links, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($links as $key => $link) {
            $deleteForms[] = $this->createDeleteForm($link)->createView();
        }

        return $this->render('UniPageBundle:Link:index.html.twig', array(
            'links' => $links,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Link entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $link = new Link();
        $newForm = $this->createNewForm($link);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $link->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($link);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'link.new.flash' );
                return $this->redirect($this->generateUrl('page_link_index'));
            }
        }

        return $this->render('UniPageBundle:Link:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Link entity.
     *
     * @param Link $link The Link entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Link $link)
    {
        return $this->createForm(new LinkType(), $link, array(
            'action' => $this->generateUrl('page_link_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a Link entity.
     *
     */
    public function showAction(Link $link)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $link->getAccount()) return $this->redirect($this->generateUrl('page_link_index'));

        $editForm = $this->createEditForm($link);
        $deleteForm = $this->createDeleteForm($link);

        return $this->render('UniPageBundle:Link:show.html.twig', array(
            'link' => $link,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Link entity.
     *
     */
    public function editAction(Request $request, Link $link)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $link->getAccount()) return $this->redirect($this->generateUrl('page_link_index'));

        $editForm = $this->createEditForm($link);
        $deleteForm = $this->createDeleteForm($link);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($link);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'link.edit.flash' );
                return $this->redirect($this->generateUrl('page_link_index'));
            }
        }

        return $this->render('UniPageBundle:Link:edit.html.twig', array(
            'link' => $link,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Link entity.
     *
     * @param Link $link The Link entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Link $link)
    {
        return $this->createForm(new LinkType(), $link, array(
            'action' => $this->generateUrl('page_link_edit', array('id' => $link->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a Link entity.
     *
     */
    public function deleteAction(Request $request, Link $link)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $link->getAccount()) return $this->redirect($this->generateUrl('page_link_index'));

        $deleteForm = $this->createDeleteForm($link);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($link);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'link.delete.flash' );
        }

        return $this->redirect($this->generateUrl('page_link_index'));
    }

    /**
     * Creates a form to delete a Link entity.
     *
     * @param Link $link The Link entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Link $link)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page_link_delete', array('id' => $link->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
