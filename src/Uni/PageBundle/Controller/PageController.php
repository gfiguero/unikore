<?php

namespace Uni\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uni\AdminBundle\Entity\Photography;
use Uni\AdminBundle\Entity\Header;
use Uni\AdminBundle\Entity\Contact;
use Uni\AdminBundle\Entity\Brand;
use Uni\AdminBundle\Entity\Feature;

class PageController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $photographies = $em->getRepository('UniAdminBundle:Photography')->findByPage($page);
        $features = $em->getRepository('UniAdminBundle:Feature')->findByPage($page);
        $socialmedialist = $em->getRepository('UniAdminBundle:Socialmedia')->findByPage($page);
        shuffle($photographies);
        return $this->render('UniPageBundle:Page:index.html.twig', array(
            'features' => $features,
            'photographies' => $photographies,
            'socialmedialist' => $socialmedialist,
            'page' => $page,
        ));
    }
}
