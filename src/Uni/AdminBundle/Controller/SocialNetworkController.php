<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\SocialNetwork;
use Uni\AdminBundle\Form\SocialNetworkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialnetwork controller.
 *
 */
class SocialNetworkController extends Controller
{

    /**
     * Lists all SocialNetwork entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $socialNetworks = $em->getRepository('UniAdminBundle:SocialNetwork')->findBy(array(), array($sort => $direction));
        else $socialNetworks = $em->getRepository('UniAdminBundle:SocialNetwork')->findAll();
        $paginator = $this->get('knp_paginator');
        $socialNetworks = $paginator->paginate($socialNetworks, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($socialNetworks as $key => $socialNetwork) {
            $deleteForms[] = $this->createDeleteForm($socialNetwork)->createView();
        }

        return $this->render('UniAdminBundle:SocialNetwork:index.html.twig', array(
            'socialNetworks' => $socialNetworks,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new SocialNetwork entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialNetwork = new SocialNetwork();
        $newForm = $this->createNewForm($socialNetwork);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialNetwork);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialNetwork.new.flash' );
                return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
            }
        }

        return $this->render('UniAdminBundle:SocialNetwork:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new SocialNetwork entity.
     *
     * @param SocialNetwork $socialNetwork The SocialNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(SocialNetwork $socialNetwork)
    {
        return $this->createForm(new SocialNetworkType(), $socialNetwork, array(
            'action' => $this->generateUrl('admin_socialnetwork_new'),
        ));
    }

    /**
     * Finds and displays a SocialNetwork entity.
     *
     */
    public function showAction(SocialNetwork $socialNetwork)
    {
        $editForm = $this->createEditForm($socialNetwork);
        $deleteForm = $this->createDeleteForm($socialNetwork);

        return $this->render('UniAdminBundle:SocialNetwork:show.html.twig', array(
            'socialNetwork' => $socialNetwork,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SocialNetwork entity.
     *
     */
    public function editAction(Request $request, SocialNetwork $socialNetwork)
    {
        $editForm = $this->createEditForm($socialNetwork);
        $deleteForm = $this->createDeleteForm($socialNetwork);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($socialNetwork);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'socialNetwork.edit.flash' );
                return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
            }
        }

        return $this->render('UniAdminBundle:SocialNetwork:edit.html.twig', array(
            'socialNetwork' => $socialNetwork,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SocialNetwork entity.
     *
     * @param SocialNetwork $socialNetwork The SocialNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SocialNetwork $socialNetwork)
    {
        return $this->createForm(new SocialNetworkType(), $socialNetwork, array(
            'action' => $this->generateUrl('admin_socialnetwork_edit', array('id' => $socialNetwork->getId())),
        ));
    }

    /**
     * Deletes a SocialNetwork entity.
     *
     */
    public function deleteAction(Request $request, SocialNetwork $socialNetwork)
    {
        $deleteForm = $this->createDeleteForm($socialNetwork);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialNetwork);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'socialNetwork.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_socialnetwork_index'));
    }

    /**
     * Creates a form to delete a SocialNetwork entity.
     *
     * @param SocialNetwork $socialNetwork The SocialNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SocialNetwork $socialNetwork)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_socialnetwork_delete', array('id' => $socialNetwork->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
