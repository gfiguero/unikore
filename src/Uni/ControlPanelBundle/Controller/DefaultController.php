<?php

namespace Uni\ControlPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UniControlPanelBundle:Default:index.html.twig');
    }
}
