<?php

namespace Uni\PortfolioBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.dashboard.root', array('route' => 'portfolio_dashboard_index'))->setExtras(array('translation_domain' => 'UniPortfolioBundle', 'routes' => array(
            'portfolio_dashboard_index',
        )));
        $sidemenu->addChild('sidemenu.portfolio.root', array('route' => 'portfolio_portfolio_index'))->setExtras(array('translation_domain' => 'UniPortfolioBundle', 'routes' => array(
            'portfolio_portfolio_index',
            'portfolio_portfolio_new',
            'portfolio_portfolio_show',
            'portfolio_portfolio_edit',
        )));
        $sidemenu->addChild('sidemenu.document.root', array('route' => 'portfolio_document_index'))->setExtras(array('translation_domain' => 'UniPortfolioBundle', 'routes' => array(
            'portfolio_document_index',
            'portfolio_document_new',
            'portfolio_document_show',
            'portfolio_document_edit',
        )));
        $sidemenu->addChild('sidemenu.portfolioitem.root', array('route' => 'portfolio_portfolioitem_index'))->setExtras(array('translation_domain' => 'UniPortfolioBundle', 'routes' => array(
            'portfolio_portfolioitem_index',
            'portfolio_portfolioitem_new',
            'portfolio_portfolioitem_show',
            'portfolio_portfolioitem_edit',
        )));

        return $sidemenu;
    }

}