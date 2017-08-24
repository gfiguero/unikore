<?php

namespace Uni\OfferBundle\Controller;

use Uni\AdminBundle\Entity\Budget;
use Uni\OfferBundle\Form\BudgetType;
use Uni\OfferBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        $testForm = $this->createForm(new TestType());
        return $this->render('UniOfferBundle:Test:index.html.twig', array(
            'testForm' => $testForm->createView(),
        ));
    }

}
