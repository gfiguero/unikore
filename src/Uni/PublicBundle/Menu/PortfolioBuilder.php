<?php

namespace Uni\PublicBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class PortfolioBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $portfoliocategories = $options['portfoliocategories'];

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'sidemenu');

        foreach ($portfoliocategories as $portfoliocategory) {
            $sidemenu->addChild('sidemenu.portfoliocategory.'.$portfoliocategory->getId(), array('route' => 'public_portfolio_portfoliocategory', 'routeParameters' => array('id' => $portfoliocategory->getId())));
            $sidemenu['sidemenu.portfoliocategory.'.$portfoliocategory->getId()]->setLabel($portfoliocategory->getName());

        }

        return $sidemenu;

    }
}