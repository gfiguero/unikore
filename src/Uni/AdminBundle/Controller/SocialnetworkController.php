<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Socialnetwork;
use Uni\AdminBundle\Form\SocialnetworkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialnetwork controller.
 *
 */
class SocialnetworkController extends Controller
{

    /**
     * Lists all Socialnetwork entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $socialnetworks = $em->getRepository('UniAdminBundle:Socialnetwork')->findBy(array(), array($sort => $direction));
        else $socialnetworks = $em->getRepository('UniAdminBundle:Socialnetwork')->findAll();
        $paginator = $this->get('knp_paginator');
        $socialnetworks = $paginator->paginate($socialnetworks, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($socialnetworks as $key => $socialnetwork) {
            $deleteForms[] = $this->createDeleteForm($socialnetwork)->createView();
        }

        return $this->render('UniAdminBundle:Socialnetwork:index.html.twig', array(
            'socialnetworks' => $socialnetworks,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Socialnetwork entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialnetwork = new Socialnetwork();
        $newForm = $this->createNewForm($socialnetwork);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialnetwork);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialnetwork.new.flash' );
                return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
            }
        }

        return $this->render('UniAdminBundle:Socialnetwork:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Socialnetwork entity.
     *
     * @param Socialnetwork $socialnetwork The Socialnetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Socialnetwork $socialnetwork)
    {
        return $this->createForm(new SocialnetworkType(), $socialnetwork, array(
            'action' => $this->generateUrl('admin_socialnetwork_new'),
        ));
    }

    /**
     * Finds and displays a Socialnetwork entity.
     *
     */
    public function showAction(Socialnetwork $socialnetwork)
    {
        $editForm = $this->createEditForm($socialnetwork);
        $deleteForm = $this->createDeleteForm($socialnetwork);

        return $this->render('UniAdminBundle:Socialnetwork:show.html.twig', array(
            'socialnetwork' => $socialnetwork,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Socialnetwork entity.
     *
     */
    public function editAction(Request $request, Socialnetwork $socialnetwork)
    {
        $editForm = $this->createEditForm($socialnetwork);
        $deleteForm = $this->createDeleteForm($socialnetwork);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialnetwork);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialnetwork.edit.flash' );
                return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
            }
        }

        return $this->render('UniAdminBundle:Socialnetwork:edit.html.twig', array(
            'socialnetwork' => $socialnetwork,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Socialnetwork entity.
     *
     * @param Socialnetwork $socialnetwork The Socialnetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Socialnetwork $socialnetwork)
    {
        return $this->createForm(new SocialnetworkType(), $socialnetwork, array(
            'action' => $this->generateUrl('admin_socialnetwork_edit', array('id' => $socialnetwork->getId())),
        ));
    }

    /**
     * Deletes a Socialnetwork entity.
     *
     */
    public function deleteAction(Request $request, Socialnetwork $socialnetwork)
    {
        $deleteForm = $this->createDeleteForm($socialnetwork);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialnetwork);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'socialnetwork.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
    }

    /**
     * Creates a form to delete a Socialnetwork entity.
     *
     * @param Socialnetwork $socialnetwork The Socialnetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Socialnetwork $socialnetwork)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_socialnetwork_delete', array('id' => $socialnetwork->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
