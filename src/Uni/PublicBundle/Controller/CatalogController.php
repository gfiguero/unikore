<?php

namespace Uni\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uni\AdminBundle\Entity\Catalog;
use Uni\AdminBundle\Entity\Subcategory;

class CatalogController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findAll();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());

        return $this->render('UniPublicBundle:Catalog:index.html.twig', array(
            'catalogs' => $catalogs,
            'page' => $page,
        ));
    }

    public function showAction(Request $request, Catalog $catalog)
    {
        $em = $this->getDoctrine()->getManager();
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findAll();
        $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('catalog' => $catalog));
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());

        return $this->render('UniPublicBundle:Catalog:show.html.twig', array(
            'catalog' => $catalog,
            'catalogs' => $catalogs,
            'categories' => $categories,
            'page' => $page,
        ));
    }

    public function subcategoryAction(Request $request, SubCategory $subcategory)
    {
        $em = $this->getDoctrine()->getManager();
        $catalog = $subcategory->getCategory()->getCatalog();
        $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('catalog' => $catalog));
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findAll();
        $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array('subcategory' => $subcategory));
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());

        return $this->render('UniPublicBundle:Catalog:subcategory.html.twig', array(
            'catalogs' => $catalogs,
            'categories' => $categories,
            'catalogitems' => $catalogitems,
            'page' => $page,
        ));
    }
}
