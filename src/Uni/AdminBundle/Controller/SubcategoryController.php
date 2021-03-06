<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Subcategory;
use Uni\AdminBundle\Form\SubcategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subcategory controller.
 *
 */
class SubcategoryController extends Controller
{

    /**
     * Lists all Subcategory entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $subcategories = $em->getRepository('UniAdminBundle:Subcategory')->findBy(array(), array($sort => $direction));
        else $subcategories = $em->getRepository('UniAdminBundle:Subcategory')->findAll();
        $paginator = $this->get('knp_paginator');
        $subcategories = $paginator->paginate($subcategories, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($subcategories as $key => $subcategory) {
            $deleteForms[] = $this->createDeleteForm($subcategory)->createView();
        }

        return $this->render('UniAdminBundle:Subcategory:index.html.twig', array(
            'subcategories' => $subcategories,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Subcategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $subcategory = new Subcategory();
        $newForm = $this->createNewForm($subcategory);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($subcategory);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'subcategory.new.flash' );
                return $this->redirect($this->generateUrl('admin_subcategory_index'));
            }
        }

        return $this->render('UniAdminBundle:Subcategory:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Subcategory entity.
     *
     * @param Subcategory $subcategory The Subcategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Subcategory $subcategory)
    {
        return $this->createForm(new SubcategoryType(), $subcategory, array(
            'action' => $this->generateUrl('admin_subcategory_new'),
        ));
    }

    /**
     * Finds and displays a Subcategory entity.
     *
     */
    public function showAction(Subcategory $subcategory)
    {
        $editForm = $this->createEditForm($subcategory);
        $deleteForm = $this->createDeleteForm($subcategory);

        return $this->render('UniAdminBundle:Subcategory:show.html.twig', array(
            'subcategory' => $subcategory,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Subcategory entity.
     *
     */
    public function editAction(Request $request, Subcategory $subcategory)
    {
        $editForm = $this->createEditForm($subcategory);
        $deleteForm = $this->createDeleteForm($subcategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($subcategory);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'subcategory.edit.flash' );
                return $this->redirect($this->generateUrl('admin_subcategory_index'));
            }
        }

        return $this->render('UniAdminBundle:Subcategory:edit.html.twig', array(
            'subcategory' => $subcategory,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Subcategory entity.
     *
     * @param Subcategory $subcategory The Subcategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Subcategory $subcategory)
    {
        return $this->createForm(new SubcategoryType(), $subcategory, array(
            'action' => $this->generateUrl('admin_subcategory_edit', array('id' => $subcategory->getId())),
        ));
    }

    /**
     * Deletes a Subcategory entity.
     *
     */
    public function deleteAction(Request $request, Subcategory $subcategory)
    {
        $deleteForm = $this->createDeleteForm($subcategory);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subcategory);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'subcategory.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_subcategory_index'));
    }

    /**
     * Creates a form to delete a Subcategory entity.
     *
     * @param Subcategory $subcategory The Subcategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subcategory $subcategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_subcategory_delete', array('id' => $subcategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
