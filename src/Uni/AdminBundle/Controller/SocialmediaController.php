<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Socialmedia;
use Uni\AdminBundle\Form\SocialmediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialmedia controller.
 *
 */
class SocialmediaController extends Controller
{

    /**
     * Lists all Socialmedia entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $socialmedias = $em->getRepository('UniAdminBundle:Socialmedia')->findBy(array(), array($sort => $direction));
        else $socialmedias = $em->getRepository('UniAdminBundle:Socialmedia')->findAll();
        $paginator = $this->get('knp_paginator');
        $socialmedias = $paginator->paginate($socialmedias, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($socialmedias as $key => $socialmedia) {
            $deleteForms[] = $this->createDeleteForm($socialmedia)->createView();
        }

        return $this->render('UniAdminBundle:Socialmedia:index.html.twig', array(
            'socialmedias' => $socialmedias,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Socialmedia entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialmedia = new Socialmedia();
        $newForm = $this->createNewForm($socialmedia);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialmedia);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialmedia.new.flash' );
                return $this->redirect($this->generateUrl('admin_socialmedia_index'));
            }
        }

        return $this->render('UniAdminBundle:Socialmedia:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Socialmedia entity.
     *
     * @param Socialmedia $socialmedia The Socialmedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Socialmedia $socialmedia)
    {
        return $this->createForm(new SocialmediaType(), $socialmedia, array(
            'action' => $this->generateUrl('admin_socialmedia_new'),
        ));
    }

    /**
     * Finds and displays a Socialmedia entity.
     *
     */
    public function showAction(Socialmedia $socialmedia)
    {
        $editForm = $this->createEditForm($socialmedia);
        $deleteForm = $this->createDeleteForm($socialmedia);

        return $this->render('UniAdminBundle:Socialmedia:show.html.twig', array(
            'socialmedia' => $socialmedia,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Socialmedia entity.
     *
     */
    public function editAction(Request $request, Socialmedia $socialmedia)
    {
        $editForm = $this->createEditForm($socialmedia);
        $deleteForm = $this->createDeleteForm($socialmedia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialmedia);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialmedia.edit.flash' );
                return $this->redirect($this->generateUrl('admin_socialmedia_index'));
            }
        }

        return $this->render('UniAdminBundle:Socialmedia:edit.html.twig', array(
            'socialmedia' => $socialmedia,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Socialmedia entity.
     *
     * @param Socialmedia $socialmedia The Socialmedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Socialmedia $socialmedia)
    {
        return $this->createForm(new SocialmediaType(), $socialmedia, array(
            'action' => $this->generateUrl('admin_socialmedia_edit', array('id' => $socialmedia->getId())),
        ));
    }

    /**
     * Deletes a Socialmedia entity.
     *
     */
    public function deleteAction(Request $request, Socialmedia $socialmedia)
    {
        $deleteForm = $this->createDeleteForm($socialmedia);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialmedia);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'socialmedia.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_socialmedia_index'));
    }

    /**
     * Creates a form to delete a Socialmedia entity.
     *
     * @param Socialmedia $socialmedia The Socialmedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Socialmedia $socialmedia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_socialmedia_delete', array('id' => $socialmedia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
