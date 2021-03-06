<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Page;
use Uni\AdminBundle\Form\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Lists all Page entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $pages = $em->getRepository('UniAdminBundle:Page')->findBy(array(), array($sort => $direction));
        else $pages = $em->getRepository('UniAdminBundle:Page')->findAll();
        $paginator = $this->get('knp_paginator');
        $pages = $paginator->paginate($pages, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($pages as $key => $page) {
            $deleteForms[] = $this->createDeleteForm($page)->createView();
        }

        return $this->render('UniAdminBundle:Page:index.html.twig', array(
            'pages' => $pages,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Page entity.
     *
     */
    public function newAction(Request $request)
    {
        $page = new Page();
        $newForm = $this->createNewForm($page);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($page);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'page.new.flash' );
                return $this->redirect($this->generateUrl('admin_page_index'));
            }
        }

        return $this->render('UniAdminBundle:Page:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Page entity.
     *
     * @param Page $page The Page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Page $page)
    {
        return $this->createForm(new PageType(), $page, array(
            'action' => $this->generateUrl('admin_page_new'),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction(Page $page)
    {
        $editForm = $this->createEditForm($page);
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('UniAdminBundle:Page:show.html.twig', array(
            'page' => $page,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction(Request $request, Page $page)
    {
        $editForm = $this->createEditForm($page);
        $deleteForm = $this->createDeleteForm($page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($page);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'page.edit.flash' );
                return $this->redirect($this->generateUrl('admin_page_index'));
            }
        }

        return $this->render('UniAdminBundle:Page:edit.html.twig', array(
            'page' => $page,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Page entity.
     *
     * @param Page $page The Page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Page $page)
    {
        return $this->createForm(new PageType(), $page, array(
            'action' => $this->generateUrl('admin_page_edit', array('id' => $page->getId())),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'page.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_page_index'));
    }

    /**
     * Creates a form to delete a Page entity.
     *
     * @param Page $page The Page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_page_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
