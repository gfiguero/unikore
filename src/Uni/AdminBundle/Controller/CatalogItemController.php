<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\CatalogItem;
use Uni\AdminBundle\Form\CatalogItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Catalogitem controller.
 *
 */
class CatalogItemController extends Controller
{

    /**
     * Lists all CatalogItem entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $catalogItems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array(), array($sort => $direction));
        else $catalogItems = $em->getRepository('UniAdminBundle:CatalogItem')->findAll();
        $paginator = $this->get('knp_paginator');
        $catalogItems = $paginator->paginate($catalogItems, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($catalogItems as $key => $catalogItem) {
            $deleteForms[] = $this->createDeleteForm($catalogItem)->createView();
        }

        return $this->render('UniAdminBundle:CatalogItem:index.html.twig', array(
            'catalogItems' => $catalogItems,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new CatalogItem entity.
     *
     */
    public function newAction(Request $request)
    {
        $catalogItem = new CatalogItem();
        $newForm = $this->createNewForm($catalogItem);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalogItem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalogItem.new.flash' );
                return $this->redirect($this->generateUrl('admin_catalogitem_index'));
            }
        }

        return $this->render('UniAdminBundle:CatalogItem:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new CatalogItem entity.
     *
     * @param CatalogItem $catalogItem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(CatalogItem $catalogItem)
    {
        return $this->createForm(new CatalogItemType(), $catalogItem, array(
            'action' => $this->generateUrl('admin_catalogitem_new'),
        ));
    }

    /**
     * Finds and displays a CatalogItem entity.
     *
     */
    public function showAction(CatalogItem $catalogItem)
    {
        $editForm = $this->createEditForm($catalogItem);
        $deleteForm = $this->createDeleteForm($catalogItem);

        return $this->render('UniAdminBundle:CatalogItem:show.html.twig', array(
            'catalogItem' => $catalogItem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CatalogItem entity.
     *
     */
    public function editAction(Request $request, CatalogItem $catalogItem)
    {
        $editForm = $this->createEditForm($catalogItem);
        $deleteForm = $this->createDeleteForm($catalogItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalogItem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalogItem.edit.flash' );
                return $this->redirect($this->generateUrl('admin_catalogitem_index'));
            }
        }

        return $this->render('UniAdminBundle:CatalogItem:edit.html.twig', array(
            'catalogItem' => $catalogItem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a CatalogItem entity.
     *
     * @param CatalogItem $catalogItem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CatalogItem $catalogItem)
    {
        return $this->createForm(new CatalogItemType(), $catalogItem, array(
            'action' => $this->generateUrl('admin_catalogitem_edit', array('id' => $catalogItem->getId())),
        ));
    }

    /**
     * Deletes a CatalogItem entity.
     *
     */
    public function deleteAction(Request $request, CatalogItem $catalogItem)
    {
        $deleteForm = $this->createDeleteForm($catalogItem);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catalogItem);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'catalogItem.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_catalogitem_index'));
    }

    /**
     * Creates a form to delete a CatalogItem entity.
     *
     * @param CatalogItem $catalogItem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CatalogItem $catalogItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_catalogitem_delete', array('id' => $catalogItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
