<?php

namespace Uni\CatalogBundle\Controller;

use Uni\AdminBundle\Entity\Category;
use Uni\CatalogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * CatalogCategoryTest controller.
 *
 */
class CatalogCategoryTestController extends Controller
{

    /**
     * Lists all CatalogCategoryTest entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('account' => $account), array($sort => $direction));
        else $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $categories = $paginator->paginate($categories, $request->query->getInt('page', 1), 100);

        return $this->render('UniCatalogBundle:CatalogCategoryTest:index.html.twig', array(
            'categories' => $categories,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}