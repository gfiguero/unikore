<?php

namespace Uni\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uni\AdminBundle\Entity\Photography;
use Uni\AdminBundle\Entity\Header;
use Uni\AdminBundle\Entity\Contact;
use Uni\AdminBundle\Entity\Brand;
use Uni\AdminBundle\Entity\Feature;

class FrontController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
//        $header = $em->getRepository('UniAdminBundle:Header')->findOneById(1);
        $photographies = $em->getRepository('UniAdminBundle:Photography')->findAll();
        $contacts = $em->getRepository('UniAdminBundle:Contact')->findAll();
        $brands = $em->getRepository('UniAdminBundle:Brand')->findAll();
        $features = $em->getRepository('UniAdminBundle:Feature')->findAll();
        return $this->render('UniFrontBundle:Front:index.html.twig', array(
            'photographies' => $photographies,
            'contacts'      => $contacts,
            'brands'        => $brands,
            'features'      => $features,
        ));
    }
    
    public function productAction()
    {
        return $this->render('UniFrontBundle:Front:product.html.twig');
    }

}
