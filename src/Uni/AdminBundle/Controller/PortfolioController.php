<?php

namespace Uni\AdminBundle\Controller;

use Uni\AdminBundle\Entity\Portfolio;
use Uni\AdminBundle\Form\PortfolioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Portfolio controller.
 *
 */
class PortfolioController extends Controller
{

    /**
     * Lists all Portfolio entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findBy(array(), array($sort => $direction));
        else $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findAll();
        $paginator = $this->get('knp_paginator');
        $portfolios = $paginator->paginate($portfolios, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($portfolios as $key => $portfolio) {
            $deleteForms[] = $this->createDeleteForm($portfolio)->createView();
        }

        return $this->render('UniAdminBundle:Portfolio:index.html.twig', array(
            'portfolios' => $portfolios,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Portfolio entity.
     *
     */
    public function newAction(Request $request)
    {
        $portfolio = new Portfolio();
        $newForm = $this->createNewForm($portfolio);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolio.new.flash' );
                return $this->redirect($this->generateUrl('admin_portfolio_index'));
            }
        }

        return $this->render('UniAdminBundle:Portfolio:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Portfolio entity.
     *
     * @param Portfolio $portfolio The Portfolio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Portfolio $portfolio)
    {
        return $this->createForm(new PortfolioType(), $portfolio, array(
            'action' => $this->generateUrl('admin_portfolio_new'),
        ));
    }

    /**
     * Finds and displays a Portfolio entity.
     *
     */
    public function showAction(Portfolio $portfolio)
    {
        $editForm = $this->createEditForm($portfolio);
        $deleteForm = $this->createDeleteForm($portfolio);

        return $this->render('UniAdminBundle:Portfolio:show.html.twig', array(
            'portfolio' => $portfolio,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Portfolio entity.
     *
     */
    public function editAction(Request $request, Portfolio $portfolio)
    {
        $editForm = $this->createEditForm($portfolio);
        $deleteForm = $this->createDeleteForm($portfolio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolio.edit.flash' );
                return $this->redirect($this->generateUrl('admin_portfolio_index'));
            }
        }

        return $this->render('UniAdminBundle:Portfolio:edit.html.twig', array(
            'portfolio' => $portfolio,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Portfolio entity.
     *
     * @param Portfolio $portfolio The Portfolio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Portfolio $portfolio)
    {
        return $this->createForm(new PortfolioType(), $portfolio, array(
            'action' => $this->generateUrl('admin_portfolio_edit', array('id' => $portfolio->getId())),
        ));
    }

    /**
     * Deletes a Portfolio entity.
     *
     */
    public function deleteAction(Request $request, Portfolio $portfolio)
    {
        $deleteForm = $this->createDeleteForm($portfolio);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolio);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'portfolio.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_portfolio_index'));
    }

    /**
     * Creates a form to delete a Portfolio entity.
     *
     * @param Portfolio $portfolio The Portfolio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Portfolio $portfolio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_portfolio_delete', array('id' => $portfolio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
