<?php

namespace Uni\PortfolioBundle\Controller;

use Uni\AdminBundle\Entity\Portfolio;
use Uni\PortfolioBundle\Form\PortfolioType;
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findBy(array('account' => $account), array($sort => $direction));
        else $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $portfolios = $paginator->paginate($portfolios, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($portfolios as $key => $portfolio) {
            $deleteForms[] = $this->createDeleteForm($portfolio)->createView();
        }

        return $this->render('UniPortfolioBundle:Portfolio:index.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $portfolio = new Portfolio();
        $newForm = $this->createNewForm($portfolio);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                foreach ($portfolio->getPortfolioCategories() as $portfoliocategory) {
                    $portfoliocategory->setAccount($account);
                }
                $portfolio->setUser($user);
                $portfolio->setAccount($account);
                $portfolio->setSlug(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolio.new.flash' );
                return $this->redirect($this->generateUrl('portfolio_portfolio_index'));
            }
        }

        return $this->render('UniPortfolioBundle:Portfolio:new.html.twig', array(
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
            'action' => $this->generateUrl('portfolio_portfolio_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a Portfolio entity.
     *
     */
    public function showAction(Portfolio $portfolio)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolio->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolio_index'));

        $editForm = $this->createEditForm($portfolio);
        $deleteForm = $this->createDeleteForm($portfolio);

        return $this->render('UniPortfolioBundle:Portfolio:show.html.twig', array(
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
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolio->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolio_index'));

        $editForm = $this->createEditForm($portfolio);
        $deleteForm = $this->createDeleteForm($portfolio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                foreach ($portfolio->getPortfolioCategories() as $portfoliocategory) {
                    $category->setAccount($account);
                }
                $portfolio->setSlug(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolio.edit.flash' );
//                return $this->redirect($this->generateUrl('catalog_catalog_index'));
                return $this->redirect($this->generateUrl('portfolio_portfolio_edit', array('id' => $portfolio->getId())));
                dump($portfolio);die();
            }
        }

        return $this->render('UniPortfolioBundle:Portfolio:edit.html.twig', array(
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
            'action' => $this->generateUrl('portfolio_portfolio_edit', array('id' => $portfolio->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a Portfolio entity.
     *
     */
    public function deleteAction(Request $request, Portfolio $portfolio)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolio->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolio_index'));

        $deleteForm = $this->createDeleteForm($portfolio);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolio);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'portfolio.delete.flash' );
        }

        return $this->redirect($this->generateUrl('portfolio_portfolio_index'));
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
            ->setAction($this->generateUrl('portfolio_portfolio_delete', array('id' => $portfolio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
