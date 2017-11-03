<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\Catalog;
use Uni\CatalogBundle\Form\CatalogType;
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findBy(array('account' => $account), array($sort => $direction));
        else $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $catalogs = $paginator->paginate($catalogs, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($catalogs as $key => $catalog) {
            $deleteForms[] = $this->createDeleteForm($catalog)->createView();
        }

        return $this->render('UniCatalogBundle:Catalog:index.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $catalog = new Catalog();
        $newForm = $this->createNewForm($catalog);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                foreach ($catalog->getCategories() as $category) {
                    $category->setAccount($account);
                    foreach ($category->getSubcategories() as $subcategory) {
                        $subcategory->setAccount($account);
                    }
                }
                $catalog->setUser($user);
                $catalog->setAccount($account);
                $catalog->setSlug(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalog.new.flash' );
                return $this->redirect($this->generateUrl('catalog_catalog_index'));
            }
        }

        return $this->render('UniCatalogBundle:Catalog:new.html.twig', array(
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
            'action' => $this->generateUrl('catalog_catalog_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a Catalog entity.
     *
     */
    public function showAction(Catalog $catalog)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalog->getAccount()) return $this->redirect($this->generateUrl('catalog_catalog_index'));

        $editForm = $this->createEditForm($catalog);
        $deleteForm = $this->createDeleteForm($catalog);

        return $this->render('UniCatalogBundle:Catalog:show.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalog->getAccount()) return $this->redirect($this->generateUrl('catalog_catalog_index'));

        $editForm = $this->createEditForm($catalog);
        $deleteForm = $this->createDeleteForm($catalog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                foreach ($catalog->getCategories() as $category) {
                    foreach ($category->getSubcategories() as $subcategory) {
                        $category->setAccount($account);
                        $subcategory->setAccount($account);
                    }
                }
                $catalog->setSlug(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalog.edit.flash' );
//                return $this->redirect($this->generateUrl('catalog_catalog_index'));
                return $this->redirect($this->generateUrl('catalog_catalog_edit', array('id' => $catalog->getId())));
                dump($catalog);die();
            }
        }

        return $this->render('UniCatalogBundle:Catalog:edit.html.twig', array(
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
            'action' => $this->generateUrl('catalog_catalog_edit', array('id' => $catalog->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a Catalog entity.
     *
     */
    public function deleteAction(Request $request, Catalog $catalog)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalog->getAccount()) return $this->redirect($this->generateUrl('catalog_catalog_index'));

        $deleteForm = $this->createDeleteForm($catalog);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catalog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'catalog.delete.flash' );
        }

        return $this->redirect($this->generateUrl('catalog_catalog_index'));
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
            ->setAction($this->generateUrl('catalog_catalog_delete', array('id' => $catalog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
