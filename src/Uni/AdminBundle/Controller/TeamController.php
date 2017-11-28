<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Team;
use Uni\AdminBundle\Form\TeamType;
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
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $teams = $em->getRepository('UniAdminBundle:Team')->findBy(array(), array($sort => $direction));
        else $teams = $em->getRepository('UniAdminBundle:Team')->findAll();
        $paginator = $this->get('knp_paginator');
        $teams = $paginator->paginate($teams, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($teams as $key => $team) {
            $deleteForms[] = $this->createDeleteForm($team)->createView();
        }

        return $this->render('UniAdminBundle:Team:index.html.twig', array(
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
        $team = new Team();
        $newForm = $this->createNewForm($team);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'team.new.flash' );
                return $this->redirect($this->generateUrl('admin_team_index'));
            }
        }

        return $this->render('UniAdminBundle:Team:new.html.twig', array(
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
            'action' => $this->generateUrl('admin_team_new'),
        ));
    }

    /**
     * Finds and displays a Team entity.
     *
     */
    public function showAction(Team $team)
    {
        $editForm = $this->createEditForm($team);
        $deleteForm = $this->createDeleteForm($team);

        return $this->render('UniAdminBundle:Team:show.html.twig', array(
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
        $editForm = $this->createEditForm($team);
        $deleteForm = $this->createDeleteForm($team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'team.edit.flash' );
                return $this->redirect($this->generateUrl('admin_team_index'));
            }
        }

        return $this->render('UniAdminBundle:Team:edit.html.twig', array(
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
            'action' => $this->generateUrl('admin_team_edit', array('id' => $team->getId())),
        ));
    }

    /**
     * Deletes a Team entity.
     *
     */
    public function deleteAction(Request $request, Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'team.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_team_index'));
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
            ->setAction($this->generateUrl('admin_team_delete', array('id' => $team->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
