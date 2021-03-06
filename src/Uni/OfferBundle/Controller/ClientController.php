<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Client;
use Uni\OfferBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $clients = $em->getRepository('UniAdminBundle:Client')->findBy(array('account' => $account), array($sort => $direction));
        else $clients = $em->getRepository('UniAdminBundle:Client')->findBy(array('account' => $account), array('updated_at' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $clients = $paginator->paginate($clients, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($clients as $key => $client) {
            $deleteForms[] = $this->createDeleteForm($client)->createView();
        }

        return $this->render('UniOfferBundle:Client:index.html.twig', array(
            'clients' => $clients,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Client entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $client = new Client();
        $newForm = $this->createNewForm($client);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $client->setUser($user);
                $client->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'client.new.flash' );
                return $this->redirect($this->generateUrl('offer_client_index'));
            }
        }

        return $this->render('UniOfferBundle:Client:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Client $client)
    {
        return $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('offer_client_new'),
        ));
    }

    /**
     * Finds and displays a Client entity.
     *
     */
    public function showAction(Client $client)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $client->getAccount()) return $this->redirect($this->generateUrl('offer_client_index'));

        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('UniOfferBundle:Client:show.html.twig', array(
            'client' => $client,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     */
    public function editAction(Request $request, Client $client)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $client->getAccount()) return $this->redirect($this->generateUrl('offer_client_index'));

        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'client.edit.flash' );
                return $this->redirect($this->generateUrl('offer_client_index'));
            }
        }

        return $this->render('UniOfferBundle:Client:edit.html.twig', array(
            'client' => $client,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Client $client)
    {
        return $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('offer_client_edit', array('id' => $client->getId())),
        ));
    }

    /**
     * Deletes a Client entity.
     *
     */
    public function deleteAction(Request $request, Client $client)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $client->getAccount()) return $this->redirect($this->generateUrl('offer_client_index'));

        $deleteForm = $this->createDeleteForm($client);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'client.delete.flash' );
        }

        return $this->redirect($this->generateUrl('offer_client_index'));
    }

    /**
     * Creates a form to delete a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
