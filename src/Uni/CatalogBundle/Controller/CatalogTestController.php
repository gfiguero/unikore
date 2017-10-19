<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\Catalog;
use Uni\CatalogBundle\Form\CatalogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * CatalogTest controller.
 *
 */
class CatalogTestController extends Controller
{

    /**
     * Lists all CatalogTest entities.
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

        return $this->render('UniCatalogBundle:CatalogTest:index.html.twig', array(
            'catalogs' => $catalogs,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}