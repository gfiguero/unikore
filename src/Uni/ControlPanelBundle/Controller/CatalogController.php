<?php

namespace Uni\ControlPanelBundle\Controller;

use Uni\AdminBundle\Entity\Catalog;
use Uni\ControlPanelBundle\Form\CatalogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Catalog controller.
 *
 */
class CatalogController extends Controller
{

    /**
     * Lists all Catalog entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findBy(array(), array($sort => $direction));
        else $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findAll();
        $paginator = $this->get('knp_paginator');
        $catalogs = $paginator->paginate($catalogs, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($catalogs as $key => $catalog) {
            $deleteForms[] = $this->createDeleteForm($catalog)->createView();
        }

        return $this->render('UniControlPanelBundle:Catalog:index.html.twig', array(
            'catalogs' => $catalogs,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Catalog entity.
     *
     */
    public function newAction(Request $request)
    {
        $catalog = new Catalog();
        $newForm = $this->createNewForm($catalog);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalog.new.flash' );
                return $this->redirect($this->generateUrl('controlpanel_catalog_index'));
            }
        }

        return $this->render('UniControlPanelBundle:Catalog:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Catalog entity.
     *
     * @param Catalog $catalog The Catalog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Catalog $catalog)
    {
        return $this->createForm(new CatalogType(), $catalog, array(
            'action' => $this->generateUrl('controlpanel_catalog_new'),
        ));
    }

    /**
     * Finds and displays a Catalog entity.
     *
     */
    public function showAction(Catalog $catalog)
    {
        $editForm = $this->createEditForm($catalog);
        $deleteForm = $this->createDeleteForm($catalog);

        return $this->render('UniControlPanelBundle:Catalog:show.html.twig', array(
            'catalog' => $catalog,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Catalog entity.
     *
     */
    public function editAction(Request $request, Catalog $catalog)
    {
        $editForm = $this->createEditForm($catalog);
        $deleteForm = $this->createDeleteForm($catalog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalog.edit.flash' );
                return $this->redirect($this->generateUrl('controlpanel_catalog_index'));
            }
        }

        return $this->render('UniControlPanelBundle:Catalog:edit.html.twig', array(
            'catalog' => $catalog,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Catalog entity.
     *
     * @param Catalog $catalog The Catalog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Catalog $catalog)
    {
        return $this->createForm(new CatalogType(), $catalog, array(
            'action' => $this->generateUrl('controlpanel_catalog_edit', array('id' => $catalog->getId())),
        ));
    }

    /**
     * Deletes a Catalog entity.
     *
     */
    public function deleteAction(Request $request, Catalog $catalog)
    {
        $deleteForm = $this->createDeleteForm($catalog);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catalog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'catalog.delete.flash' );
        }

        return $this->redirect($this->generateUrl('controlpanel_catalog_index'));
    }

    /**
     * Creates a form to delete a Catalog entity.
     *
     * @param Catalog $catalog The Catalog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Catalog $catalog)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('controlpanel_catalog_delete', array('id' => $catalog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
