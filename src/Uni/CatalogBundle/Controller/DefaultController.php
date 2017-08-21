<?php

namespace Uni\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UniCatalogBundle:Default:index.html.twig');
    }
}
