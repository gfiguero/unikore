<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Provider;
use Uni\OfferBundle\Form\ProviderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provider controller.
 *
 */
class ProviderController extends Controller
{

    /**
     * Lists all Provider entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providers = $em->getRepository('UniAdminBundle:Provider')->findBy(array('account' => $account), array($sort => $direction));
        else $providers = $em->getRepository('UniAdminBundle:Provider')->findBy(array('account' => $account), array('updated_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $providers = $paginator->paginate($providers, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($providers as $key => $provider) {
            $deleteForms[] = $this->createDeleteForm($provider)->createView();
        }

        return $this->render('UniOfferBundle:Provider:index.html.twig', array(
            'providers' => $providers,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Provider entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $provider = new Provider();
        $newForm = $this->createNewForm($provider);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $provider->setUser($user);
                $provider->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($provider);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'provider.new.flash' );
                return $this->redirect($this->generateUrl('offer_provider_index'));
            }
        }

        return $this->render('UniOfferBundle:Provider:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Provider $provider)
    {
        return $this->createForm(new ProviderType(), $provider, array(
            'action' => $this->generateUrl('offer_provider_new'),
        ));
    }

    /**
     * Finds and displays a Provider entity.
     *
     */
    public function showAction(Provider $provider)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $provider->getAccount()) return $this->redirect($this->generateUrl('offer_provider_index'));

        $editForm = $this->createEditForm($provider);
        $deleteForm = $this->createDeleteForm($provider);

        return $this->render('UniOfferBundle:Provider:show.html.twig', array(
            'provider' => $provider,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Provider entity.
     *
     */
    public function editAction(Request $request, Provider $provider)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $provider->getAccount()) return $this->redirect($this->generateUrl('offer_provider_index'));

        $editForm = $this->createEditForm($provider);
        $deleteForm = $this->createDeleteForm($provider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($provider);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'provider.edit.flash' );
                return $this->redirect($this->generateUrl('offer_provider_index'));
            }
        }

        return $this->render('UniOfferBundle:Provider:edit.html.twig', array(
            'provider' => $provider,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Provider $provider)
    {
        return $this->createForm(new ProviderType(), $provider, array(
            'action' => $this->generateUrl('offer_provider_edit', array('id' => $provider->getId())),
        ));
    }

    /**
     * Deletes a Provider entity.
     *
     */
    public function deleteAction(Request $request, Provider $provider)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $provider->getAccount()) return $this->redirect($this->generateUrl('offer_provider_index'));

        $deleteForm = $this->createDeleteForm($provider);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'provider.delete.flash' );
        }

        return $this->redirect($this->generateUrl('offer_provider_index'));
    }

    /**
     * Creates a form to delete a Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provider $provider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_provider_delete', array('id' => $provider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
