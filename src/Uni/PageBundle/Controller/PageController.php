<?php

namespace Uni\PageBundle\Controller;

use Uni\AdminBundle\Entity\Page;
use Uni\PageBundle\Form\PageType;
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $pages = $em->getRepository('UniAdminBundle:Page')->findBy(array('account' => $account), array($sort => $direction));
        else $pages = $em->getRepository('UniAdminBundle:Page')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $pages = $paginator->paginate($pages, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($pages as $key => $page) {
            $deleteForms[] = $this->createDeleteForm($page)->createView();
        }

        return $this->render('UniPageBundle:Page:index.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $page = new Page();
        $newForm = $this->createNewForm($page);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $page->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($page);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'page.new.flash' );
                return $this->redirect($this->generateUrl('page_page_index'));
            }
        }

        return $this->render('UniPageBundle:Page:new.html.twig', array(
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
            'action' => $this->generateUrl('page_page_new'),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction(Page $page)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $page->getAccount()) return $this->redirect($this->generateUrl('page_page_index'));

        $editForm = $this->createEditForm($page);
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('UniPageBundle:Page:show.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $page->getAccount()) return $this->redirect($this->generateUrl('page_page_index'));

        $editForm = $this->createEditForm($page);
        $deleteForm = $this->createDeleteForm($page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($page);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'page.edit.flash' );
                return $this->redirect($this->generateUrl('page_page_index'));
            }
        }

        return $this->render('UniPageBundle:Page:edit.html.twig', array(
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
            'action' => $this->generateUrl('page_page_edit', array('id' => $page->getId())),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $page->getAccount()) return $this->redirect($this->generateUrl('page_page_index'));

        $deleteForm = $this->createDeleteForm($page);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'page.delete.flash' );
        }

        return $this->redirect($this->generateUrl('page_page_index'));
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
            ->setAction($this->generateUrl('page_page_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function previewAction(Page $page)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $photographies = $em->getRepository('UniAdminBundle:Photography')->findByPage($page);
        $teams = $em->getRepository('UniAdminBundle:Team')->findByPage($page);
        $features = $em->getRepository('UniAdminBundle:Feature')->findByPage($page);
        $links = $em->getRepository('UniAdminBundle:Link')->findByPage($page);
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findByPage($page);
        $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findByPage($page);
        $socialmedialist = $em->getRepository('UniAdminBundle:Socialmedia')->findByPage($page);
        shuffle($photographies);
        $backgrounds = array();

        if(!empty($photographies)) {
            // conteo de secciones
            $sections = 0;
            if($page) $sections += 4; // (main, about, location, contact) = 4
            if(!empty($teams)) $sections += 1;
            if(!empty($features)) $sections += 1;
            if(!empty($links)) $sections += 1;
            if(!empty($catalogs)) $sections += count($catalogs);
            if(!empty($portfolios)) $sections += count($portfolios);
            if(!empty($socialmedialist)) $sections += 1;

            $currentPhotography = 0;
            for ($section=0; $section < $sections; $section++) {
                if (array_key_exists($currentPhotography, $photographies)) {
                    array_push($backgrounds, $photographies[$currentPhotography]);
                    $currentPhotography++;
                } else {
                    $currentPhotography = 0;
                    array_push($backgrounds, $photographies[$currentPhotography]);
                }
            }
        }

        return $this->render('UniPageBundle:Page:preview.html.twig', array(
            'page' => $page,
            'photographies' => $photographies,
            'teams' => $teams,
            'features' => $features,
            'links' => $links,
            'catalogs' => $catalogs,
            'portfolios' => $portfolios,
            'socialmedialist' => $socialmedialist,
            'backgrounds' => $backgrounds,
        ));
    }
}
