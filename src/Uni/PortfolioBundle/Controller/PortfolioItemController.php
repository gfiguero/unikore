<?php

namespace Uni\PortfolioBundle\Controller;

use Uni\AdminBundle\Entity\PortfolioItem;
use Uni\PortfolioBundle\Form\PortfolioItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * PortfolioItem controller.
 *
 */
class PortfolioItemController extends Controller
{

    /**
     * Lists all PortfolioItem entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $portfolioitems = $em->getRepository('UniAdminBundle:PortfolioItem')->findBy(array('account' => $account), array($sort => $direction));
        else $portfolioitems = $em->getRepository('UniAdminBundle:PortfolioItem')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $portfolioitems = $paginator->paginate($portfolioitems, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($portfolioitems as $key => $portfolioitem) {
            $deleteForms[] = $this->createDeleteForm($portfolioitem)->createView();
        }

        return $this->render('UniPortfolioBundle:PortfolioItem:index.html.twig', array(
            'portfolioitems' => $portfolioitems,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PortfolioItem entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $portfolioitem = new PortfolioItem();
        $newForm = $this->createNewForm($portfolioitem);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $portfolioitem->setUser($user);
                $portfolioitem->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolioitem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolioitem.new.flash' );
                return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));
            }
        }

        return $this->render('UniPortfolioBundle:PortfolioItem:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new PortfolioItem entity.
     *
     * @param PortfolioItem $portfolioitem The PortfolioItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PortfolioItem $portfolioitem)
    {
        return $this->createForm(PortfolioItemType::class, $portfolioitem, array(
            'action' => $this->generateUrl('portfolio_portfolioitem_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a PortfolioItem entity.
     *
     */
    public function showAction(PortfolioItem $portfolioitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolioitem->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));

        $editForm = $this->createEditForm($portfolioitem);
        $deleteForm = $this->createDeleteForm($portfolioitem);

        return $this->render('UniPortfolioBundle:PortfolioItem:show.html.twig', array(
            'portfolioitem' => $portfolioitem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PortfolioItem entity.
     *
     */
    public function editAction(Request $request, PortfolioItem $portfolioitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolioitem->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));

        $editForm = $this->createEditForm($portfolioitem);
        $deleteForm = $this->createDeleteForm($portfolioitem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolioitem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'portfolioitem.edit.flash' );
                return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));
            }
        }

        return $this->render('UniPortfolioBundle:PortfolioItem:edit.html.twig', array(
            'portfolioitem' => $portfolioitem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a PortfolioItem entity.
     *
     * @param PortfolioItem $portfolioitem The PortfolioItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PortfolioItem $portfolioitem)
    {
        return $this->createForm(new PortfolioItemType(), $portfolioitem, array(
            'action' => $this->generateUrl('portfolio_portfolioitem_edit', array('id' => $portfolioitem->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a PortfolioItem entity.
     *
     */
    public function deleteAction(Request $request, PortfolioItem $portfolioitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $portfolioitem->getAccount()) return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));

        $deleteForm = $this->createDeleteForm($portfolioitem);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolioitem);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'portfolioitem.delete.flash' );
        }

        return $this->redirect($this->generateUrl('portfolio_portfolioitem_index'));
    }

    /**
     * Creates a form to delete a PortfolioItem entity.
     *
     * @param PortfolioItem $portfolioitem The PortfolioItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PortfolioItem $portfolioitem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfolio_portfolioitem_delete', array('id' => $portfolioitem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
