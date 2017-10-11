<?php

namespace Uni\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('UniAdminBundle:Product')->findBy(array('account' => $account));
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $catalogitems = $em->getRepository('UniAdminBundle:CatalogItem')->findBy(array());

        return $this->render('UniPublicBundle:Catalog:catalog.html.twig', array(
            'products' => $products,
            'page' => $page,
            'catalogitems' => $catalogitems,
        ));
    }
}
