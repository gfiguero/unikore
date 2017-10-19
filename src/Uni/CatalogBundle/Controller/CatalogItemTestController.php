<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\CatalogItem;
use Uni\CatalogBundle\Form\CatalogItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * CatalogItemTest controller.
 *
 */
class CatalogItemTestController extends Controller
{

    /**
     * Lists all CatalogItemTest entities.
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

        return $this->render('UniCatalogBundle:CatalogItemTest:index.html.twig', array(
            'catalogitems' => $catalogitems,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}
