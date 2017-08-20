<?php

namespace Uni\AgentBundle\Controller;

use Uni\AdminBundle\Entity\Budget;
use Uni\AgentBundle\Form\BudgetType;
use Uni\AgentBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        $testForm = $this->createForm(new TestType());
        return $this->render('UniAgentBundle:Test:index.html.twig', array(
            'testForm' => $testForm->createView(),
        ));
    }

}
