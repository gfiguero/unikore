<?php

namespace Uni\AccountBundle\Controller;

use Uni\AdminBundle\Entity\Group;
use Uni\AccountBundle\Form\GroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Group controller.
 *
 */
class GroupController extends Controller
{

    /**
     * Lists all Group entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $groups = $em->getRepository('UniAdminBundle:Group')->findBy(array(), array($sort => $direction));
        else $groups = $em->getRepository('UniAdminBundle:Group')->findAll();
        $paginator = $this->get('knp_paginator');
        $groups = $paginator->paginate($groups, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($groups as $key => $group) {
            $deleteForms[] = $this->createDeleteForm($group)->createView();
        }

        return $this->render('UniAccountBundle:Group:index.html.twig', array(
            'groups' => $groups,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Group entity.
     *
     */
    public function newAction(Request $request)
    {
        $group = new Group();
        $newForm = $this->createNewForm($group);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($group);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'group.new.flash' );
                return $this->redirect($this->generateUrl('account_group_index'));
            }
        }

        return $this->render('UniAccountBundle:Group:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Group entity.
     *
     * @param Group $group The Group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Group $group)
    {
        return $this->createForm(new GroupType(), $group, array(
            'action' => $this->generateUrl('account_group_new'),
        ));
    }

    /**
     * Finds and displays a Group entity.
     *
     */
    public function showAction(Group $group)
    {
        $editForm = $this->createEditForm($group);
        $deleteForm = $this->createDeleteForm($group);

        return $this->render('UniAccountBundle:Group:show.html.twig', array(
            'group' => $group,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Group entity.
     *
     */
    public function editAction(Request $request, Group $group)
    {
        $editForm = $this->createEditForm($group);
        $deleteForm = $this->createDeleteForm($group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($group);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'group.edit.flash' );
                return $this->redirect($this->generateUrl('account_group_index'));
            }
        }

        return $this->render('UniAccountBundle:Group:edit.html.twig', array(
            'group' => $group,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Group entity.
     *
     * @param Group $group The Group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Group $group)
    {
        return $this->createForm(new GroupType(), $group, array(
            'action' => $this->generateUrl('account_group_edit', array('id' => $group->getId())),
        ));
    }

    /**
     * Deletes a Group entity.
     *
     */
    public function deleteAction(Request $request, Group $group)
    {
        $deleteForm = $this->createDeleteForm($group);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'group.delete.flash' );
        }

        return $this->redirect($this->generateUrl('account_group_index'));
    }

    /**
     * Creates a form to delete a Group entity.
     *
     * @param Group $group The Group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Group $group)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_group_delete', array('id' => $group->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
