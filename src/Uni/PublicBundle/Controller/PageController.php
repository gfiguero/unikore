<?php

namespace Uni\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('UniPublicBundle:Page:index.html.twig', array(
            'features' => $features,
            'photographies' => $photographies,
            'socialmedialist' => $socialmedialist,
            'page' => $page,
        ));
    }
}
