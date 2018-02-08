<?php

namespace Uni\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        return $this->render('UniPortfolioBundle:Dashboard:index.html.twig', array(
        ));
    }

}
