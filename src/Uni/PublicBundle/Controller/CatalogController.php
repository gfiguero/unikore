<?php

namespace Uni\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uni\AdminBundle\Entity\Catalog;
use Uni\AdminBundle\Entity\Subcategory;

class CatalogController extends Controller
{
    public function showAction(Request $request, Catalog $catalog)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findByPage($page);
        $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('catalog' => $catalog));
        $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findByCatalog($catalog);

        return $this->render('UniPublicBundle:Catalog:show.html.twig', array(
            'catalog' => $catalog,
            'catalogs' => $catalogs,
            'categories' => $categories,
            'catalogitems' => $catalogitems,
            'page' => $page,
        ));
    }

    public function subcategoryAction(Request $request, SubCategory $subcategory)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findByPage($page);
        $catalog = $subcategory->getCategory()->getCatalog();
        $categories = $em->getRepository('UniAdminBundle:Category')->findBy(array('catalog' => $catalog));
        $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array('subcategory' => $subcategory));


        return $this->render('UniPublicBundle:Catalog:subcategory.html.twig', array(
            'catalogs' => $catalogs,
            'catalog' => $catalog,
            'categories' => $categories,
            'catalogitems' => $catalogitems,
            'page' => $page,
        ));
    }
}
