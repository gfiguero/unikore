<?php

namespace Uni\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UniPageBundle:Default:index.html.twig');
    }
}
