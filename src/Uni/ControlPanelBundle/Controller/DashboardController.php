<?php

namespace Uni\ControlPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('UniControlPanelBundle:Dashboard:index.html.twig');
    }
}
