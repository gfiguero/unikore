<?php

namespace Uni\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uni\AdminBundle\Entity\Portfolio;
use Uni\AdminBundle\Entity\PortfolioCategory;

class PortfolioController extends Controller
{
    public function showAction(Request $request, Portfolio $portfolio)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UniAdminBundle:Page')->findOneByDomain($this->getRequest()->getHost());
        $portfolios = $em->getRepository('UniAdminBundle:Portfolio')->findByPage($page);
        $portfoliocategories = $em->getRepository('UniAdminBundle:PortfolioCategory')->findBy(array('portfolio' => $portfolio));
        $portfolioitems = $em->getRepository('UniAdminBundle:PortfolioItem')->findByPortfolio($portfolio);

        return $this->render('UniPublicBundle:Portfolio:show.html.twig', array(
            'portfolio' => $portfolio,
            'portfolios' => $portfolios,
            'portfoliocategories' => $portfoliocategories,
            'portfolioitems' => $portfolioitems,
            'page' => $page,
        ));
    }
}
