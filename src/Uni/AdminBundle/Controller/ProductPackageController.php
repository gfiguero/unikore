<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\ProductPackage;
use Uni\AdminBundle\Form\ProductPackageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productpackage controller.
 *
 */
class ProductPackageController extends Controller
{

    /**
     * Lists all ProductPackage entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $productPackages = $em->getRepository('UniAdminBundle:ProductPackage')->findBy(array(), array($sort => $direction));
        else $productPackages = $em->getRepository('UniAdminBundle:ProductPackage')->findAll();
        $paginator = $this->get('knp_paginator');
        $productPackages = $paginator->paginate($productPackages, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($productPackages as $key => $productPackage) {
            $deleteForms[] = $this->createDeleteForm($productPackage)->createView();
        }

        return $this->render('UniAdminBundle:ProductPackage:index.html.twig', array(
            'productPackages' => $productPackages,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProductPackage entity.
     *
     */
    public function newAction(Request $request)
    {
        $productPackage = new ProductPackage();
        $newForm = $this->createNewForm($productPackage);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productPackage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productPackage.new.flash' );
                return $this->redirect($this->generateUrl('admin_productpackage_index'));
            }
        }

        return $this->render('UniAdminBundle:ProductPackage:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new ProductPackage entity.
     *
     * @param ProductPackage $productPackage The ProductPackage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProductPackage $productPackage)
    {
        return $this->createForm(new ProductPackageType(), $productPackage, array(
            'action' => $this->generateUrl('admin_productpackage_new'),
        ));
    }

    /**
     * Finds and displays a ProductPackage entity.
     *
     */
    public function showAction(ProductPackage $productPackage)
    {
        $editForm = $this->createEditForm($productPackage);
        $deleteForm = $this->createDeleteForm($productPackage);

        return $this->render('UniAdminBundle:ProductPackage:show.html.twig', array(
            'productPackage' => $productPackage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductPackage entity.
     *
     */
    public function editAction(Request $request, ProductPackage $productPackage)
    {
        $editForm = $this->createEditForm($productPackage);
        $deleteForm = $this->createDeleteForm($productPackage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productPackage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productPackage.edit.flash' );
                return $this->redirect($this->generateUrl('admin_productpackage_index'));
            }
        }

        return $this->render('UniAdminBundle:ProductPackage:edit.html.twig', array(
            'productPackage' => $productPackage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ProductPackage entity.
     *
     * @param ProductPackage $productPackage The ProductPackage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProductPackage $productPackage)
    {
        return $this->createForm(new ProductPackageType(), $productPackage, array(
            'action' => $this->generateUrl('admin_productpackage_edit', array('id' => $productPackage->getId())),
        ));
    }

    /**
     * Deletes a ProductPackage entity.
     *
     */
    public function deleteAction(Request $request, ProductPackage $productPackage)
    {
        $deleteForm = $this->createDeleteForm($productPackage);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productPackage);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'productPackage.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_productpackage_index'));
    }

    /**
     * Creates a form to delete a ProductPackage entity.
     *
     * @param ProductPackage $productPackage The ProductPackage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductPackage $productPackage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_productpackage_delete', array('id' => $productPackage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
