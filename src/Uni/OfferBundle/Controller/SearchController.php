<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends Controller
{
    public function productCmAction(Request $request)
    {
        $cm = $request->query->get('value');
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('UniAdminBundle:Product')->findByCm($cm);
        $response = new JsonResponse();
        $response->setData($products);
        return $response;
    }

    public function productNameAction(Request $request)
    {
        $name = $request->query->get('value');
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('UniAdminBundle:Product')->findByName($name);
        $response = new JsonResponse();
        $response->setData($products);
        return $response;
    }
}
