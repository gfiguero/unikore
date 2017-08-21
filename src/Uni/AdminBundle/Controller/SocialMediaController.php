<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\SocialMedia;
use Uni\AdminBundle\Form\SocialMediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialmedia controller.
 *
 */
class SocialMediaController extends Controller
{

    /**
     * Lists all SocialMedia entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $socialMedia = $em->getRepository('UniAdminBundle:SocialMedia')->findBy(array(), array($sort => $direction));
        else $socialMedia = $em->getRepository('UniAdminBundle:SocialMedia')->findAll();
        $paginator = $this->get('knp_paginator');
        $socialMedia = $paginator->paginate($socialMedia, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($socialMedia as $key => $socialMedia) {
            $deleteForms[] = $this->createDeleteForm($socialMedia)->createView();
        }

        return $this->render('UniAdminBundle:SocialMedia:index.html.twig', array(
            'socialMedia' => $socialMedia,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new SocialMedia entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialMedia = new SocialMedia();
        $newForm = $this->createNewForm($socialMedia);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialMedia);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialMedia.new.flash' );
                return $this->redirect($this->generateUrl('admin_socialmedia_index'));
            }
        }

        return $this->render('UniAdminBundle:SocialMedia:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new SocialMedia entity.
     *
     * @param SocialMedia $socialMedia The SocialMedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(SocialMedia $socialMedia)
    {
        return $this->createForm(new SocialMediaType(), $socialMedia, array(
            'action' => $this->generateUrl('admin_socialmedia_new'),
        ));
    }

    /**
     * Finds and displays a SocialMedia entity.
     *
     */
    public function showAction(SocialMedia $socialMedia)
    {
        $editForm = $this->createEditForm($socialMedia);
        $deleteForm = $this->createDeleteForm($socialMedia);

        return $this->render('UniAdminBundle:SocialMedia:show.html.twig', array(
            'socialMedia' => $socialMedia,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SocialMedia entity.
     *
     */
    public function editAction(Request $request, SocialMedia $socialMedia)
    {
        $editForm = $this->createEditForm($socialMedia);
        $deleteForm = $this->createDeleteForm($socialMedia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialMedia);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialMedia.edit.flash' );
                return $this->redirect($this->generateUrl('admin_socialmedia_index'));
            }
        }

        return $this->render('UniAdminBundle:SocialMedia:edit.html.twig', array(
            'socialMedia' => $socialMedia,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SocialMedia entity.
     *
     * @param SocialMedia $socialMedia The SocialMedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SocialMedia $socialMedia)
    {
        return $this->createForm(new SocialMediaType(), $socialMedia, array(
            'action' => $this->generateUrl('admin_socialmedia_edit', array('id' => $socialMedia->getId())),
        ));
    }

    /**
     * Deletes a SocialMedia entity.
     *
     */
    public function deleteAction(Request $request, SocialMedia $socialMedia)
    {
        $deleteForm = $this->createDeleteForm($socialMedia);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialMedia);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'socialMedia.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_socialmedia_index'));
    }

    /**
     * Creates a form to delete a SocialMedia entity.
     *
     * @param SocialMedia $socialMedia The SocialMedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SocialMedia $socialMedia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_socialmedia_delete', array('id' => $socialMedia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
