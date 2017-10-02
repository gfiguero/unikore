<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\CatalogItem;
use Uni\CatalogBundle\Form\CatalogItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * CatalogItem controller.
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array(), array($sort => $direction));
        else $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array());
        $paginator = $this->get('knp_paginator');
        $catalogitems = $paginator->paginate($catalogitems, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($catalogitems as $key => $catalogitem) {
            $deleteForms[] = $this->createDeleteForm($catalogitem)->createView();
        }

        return $this->render('UniCatalogBundle:CatalogItem:index.html.twig', array(
            'catalogitems' => $catalogitems,
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
        $user = $this->getUser();
        $account = $user->getAccount();

        $catalogitem = new CatalogItem();
        $newForm = $this->createNewForm($catalogitem);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $catalogitem->setReferencePrice();
                $catalogitem->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalogitem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalogitem.new.flash' );
                return $this->redirect($this->generateUrl('catalog_catalogitem_index'));
            }
        }

        return $this->render('UniCatalogBundle:CatalogItem:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new CatalogItem entity.
     *
     * @param CatalogItem $catalogitem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(CatalogItem $catalogitem)
    {
        return $this->createForm(CatalogItemType::class, $catalogitem, array(
            'action' => $this->generateUrl('catalog_catalogitem_new'),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Finds and displays a CatalogItem entity.
     *
     */
    public function showAction(CatalogItem $catalogitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalogitem->getAccount()) return $this->redirect($this->generateUrl('catalog_catalogitem_index'));

        $editForm = $this->createEditForm($catalogitem);
        $deleteForm = $this->createDeleteForm($catalogitem);

        return $this->render('UniCatalogBundle:CatalogItem:show.html.twig', array(
            'catalogitem' => $catalogitem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CatalogItem entity.
     *
     */
    public function editAction(Request $request, CatalogItem $catalogitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalogitem->getAccount()) return $this->redirect($this->generateUrl('catalog_catalogitem_index'));

        $editForm = $this->createEditForm($catalogitem);
        $deleteForm = $this->createDeleteForm($catalogitem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $catalogitem->setReferencePrice();
                $em = $this->getDoctrine()->getManager();
                $em->persist($catalogitem);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'catalogitem.edit.flash' );
                return $this->redirect($this->generateUrl('catalog_catalogitem_index'));
            }
        }

        return $this->render('UniCatalogBundle:CatalogItem:edit.html.twig', array(
            'catalogitem' => $catalogitem,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a CatalogItem entity.
     *
     * @param CatalogItem $catalogitem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CatalogItem $catalogitem)
    {
        return $this->createForm(new CatalogItemType(), $catalogitem, array(
            'action' => $this->generateUrl('catalog_catalogitem_edit', array('id' => $catalogitem->getId())),
            'token_storage' => $this->get('security.token_storage'),
        ));
    }

    /**
     * Deletes a CatalogItem entity.
     *
     */
    public function deleteAction(Request $request, CatalogItem $catalogitem)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $catalogitem->getAccount()) return $this->redirect($this->generateUrl('catalog_catalogitem_index'));

        $deleteForm = $this->createDeleteForm($catalogitem);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catalogitem);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'catalogitem.delete.flash' );
        }

        return $this->redirect($this->generateUrl('catalog_catalogitem_index'));
    }

    /**
     * Creates a form to delete a CatalogItem entity.
     *
     * @param CatalogItem $catalogitem The CatalogItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CatalogItem $catalogitem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catalog_catalogitem_delete', array('id' => $catalogitem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function searchcmAction(Request $request)
    {
        $cm = $request->query->get('cm');
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('UniAdminBundle:CatalogItem')->findByCm($cm);
        $response = new JsonResponse();
        $response->setData($cms);
        return $response;
    }
}
