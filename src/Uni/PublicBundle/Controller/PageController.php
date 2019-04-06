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
        $teams = $em->getRepository('UniAdminBundle:Team')->findByPage($page);
        $features = $em->getRepository('UniAdminBundle:Feature')->findByPage($page);
        $links = $em->getRepository('UniAdminBundle:Link')->findByPage($page);
        $catalogs = $em->getRepository('UniAdminBundle:Catalog')->findByPage($page);
        $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findByPage($page);
        $socialmedialist = $em->getRepository('UniAdminBundle:Socialmedia')->findByPage($page);
        shuffle($photographies);
        $backgrounds = array();

        if(!empty($photographies)) {
            // conteo de secciones
            $sections = 0;
            if($page) $sections += 4; // (main, about, location, contact) = 4
            if(!empty($teams)) $sections += 1;
            if(!empty($features)) $sections += 1;
            if(!empty($links)) $sections += 1;
            if(!empty($catalogs)) $sections += count($catalogs);
            if(!empty($portfolios)) $sections += count($portfolios);
            if(!empty($socialmedialist)) $sections += 1;

            $currentPhotography = 0;
            for ($section=0; $section < $sections; $section++) {
                if (array_key_exists($currentPhotography, $photographies)) {
                    array_push($backgrounds, $photographies[$currentPhotography]);
                    $currentPhotography++;
                } else {
                    $currentPhotography = 0;
                    array_push($backgrounds, $photographies[$currentPhotography]);
                }
            }
        }

        return $this->render('UniPublicBundle:Page:index.html.twig', array(
            'page' => $page,
            'photographies' => $photographies,
            'teams' => $teams,
            'features' => $features,
            'links' => $links,
            'catalogs' => $catalogs,
            'portfolios' => $portfolios,
            'socialmedialist' => $socialmedialist,
            'backgrounds' => $backgrounds,
        ));
    }
}