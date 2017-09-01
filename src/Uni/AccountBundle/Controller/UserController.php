<?php

namespace Uni\AccountBundle\Controller;

use Uni\AdminBundle\Entity\User;
use Uni\AccountBundle\Form\UserType;
use Uni\AccountBundle\Form\UserRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $users = $em->getRepository('UniAdminBundle:User')->findBy(array(), array($sort => $direction));
        else $users = $em->getRepository('UniAdminBundle:User')->findAll();
        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($users, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($users as $key => $user) {
            $deleteForms[] = $this->createDeleteForm($user)->createView();
        }

        return $this->render('UniAccountBundle:User:index.html.twig', array(
            'users' => $users,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    public function newAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $dispatcher = $this->get('event_dispatcher');
        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        $newForm = $this->createForm(new UserRegisterType(), $user);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if ($newForm->isValid()) {
                $event = new FormEvent($newForm, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $userManager->updateUser($user);
                $url = $this->generateUrl('account_user_index');
                $response = new RedirectResponse($url);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
            }
            $event = new FormEvent($newForm, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);
        }

        return $this->render('UniAccountBundle:User:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));

    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $user)
    {
        $editForm = $this->createEditForm($user);
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('UniAccountBundle:User:show.html.twig', array(
            'user' => $user,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createEditForm($user);
        $deleteForm = $this->createDeleteForm($user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'user.edit.flash' );
                return $this->redirect($this->generateUrl('account_user_index'));
            }
        }

        return $this->render('UniAccountBundle:User:edit.html.twig', array(
            'user' => $user,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $user)
    {
        return $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('account_user_edit', array('id' => $user->getId())),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'user.delete.flash' );
        }

        return $this->redirect($this->generateUrl('account_user_index'));
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
