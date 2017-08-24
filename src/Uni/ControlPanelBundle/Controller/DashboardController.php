<?php

namespace Uni\ControlPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        return $this->render('UniControlPanelBundle:Dashboard:index.html.twig', array(
            'user' => $user,
            'account' => $account,
        ));
    }
}
