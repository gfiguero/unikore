<?php

namespace Uni\PageBundle\Controller;

use Uni\AdminBundle\Entity\Team;
use Uni\PageBundle\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Team controller.
 *
 */
class TeamController extends Controller
{

    /**
     * Lists all Team entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $teams = $em->getRepository('UniAdminBundle:Team')->findBy(array('account' => $account), array($sort => $direction));
        else $teams = $em->getRepository('UniAdminBundle:Team')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $teams = $paginator->paginate($teams, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($teams as $key => $team) {
            $deleteForms[] = $this->createDeleteForm($team)->createView();
        }

        return $this->render('UniPageBundle:Team:index.html.twig', array(
            'teams' => $teams,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Team entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $team = new Team();
        $newForm = $this->createNewForm($team);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $team->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'team.new.flash' );
                return $this->redirect($this->generateUrl('page_team_index'));
            }
        }

        return $this->render('UniPageBundle:Team:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Team entity.
     *
     * @param Team $team The Team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Team $team)
    {
        return $this->createForm(new TeamType(), $team, array(
            'action' => $this->generateUrl('page_team_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a Team entity.
     *
     */
    public function showAction(Team $team)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $team->getAccount()) return $this->redirect($this->generateUrl('page_team_index'));

        $editForm = $this->createEditForm($team);
        $deleteForm = $this->createDeleteForm($team);

        return $this->render('UniPageBundle:Team:show.html.twig', array(
            'team' => $team,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Team entity.
     *
     */
    public function editAction(Request $request, Team $team)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $team->getAccount()) return $this->redirect($this->generateUrl('page_team_index'));

        $editForm = $this->createEditForm($team);
        $deleteForm = $this->createDeleteForm($team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'team.edit.flash' );
                return $this->redirect($this->generateUrl('page_team_index'));
            }
        }

        return $this->render('UniPageBundle:Team:edit.html.twig', array(
            'team' => $team,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Team entity.
     *
     * @param Team $team The Team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Team $team)
    {
        return $this->createForm(new TeamType(), $team, array(
            'action' => $this->generateUrl('page_team_edit', array('id' => $team->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a Team entity.
     *
     */
    public function deleteAction(Request $request, Team $team)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $team->getAccount()) return $this->redirect($this->generateUrl('page_team_index'));

        $deleteForm = $this->createDeleteForm($team);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'team.delete.flash' );
        }

        return $this->redirect($this->generateUrl('page_team_index'));
    }

    /**
     * Creates a form to delete a Team entity.
     *
     * @param Team $team The Team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Team $team)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page_team_delete', array('id' => $team->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}