<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\Subcategory;
use Uni\CatalogBundle\Form\SubcategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * CatalogSubcategoryTest controller.
 *
 */
class CatalogSubcategoryTestController extends Controller
{

    /**
     * Lists all CatalogSubcategoryTest entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $subcategories = $em->getRepository('UniAdminBundle:Subcategory')->findBy(array('account' => $account), array($sort => $direction));
        else $subcategories = $em->getRepository('UniAdminBundle:Subcategory')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $subcategories = $paginator->paginate($subcategories, $request->query->getInt('page', 1), 100);

        return $this->render('UniCatalogBundle:CatalogSubcategoryTest:index.html.twig', array(
            'subcategories' => $subcategories,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}