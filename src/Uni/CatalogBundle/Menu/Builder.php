<?php

namespace Uni\CatalogBundle\Menu;

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
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.dashboard.root', array('route' => 'catalog_dashboard_index'))->setExtras(array('translation_domain' => 'UniCatalogBundle', 'routes' => array(
            'catalog_dashboard_index',
        )));
        $sidemenu->addChild('sidemenu.catalog.root', array('route' => 'catalog_catalog_index'))->setExtras(array('translation_domain' => 'UniCatalogBundle', 'routes' => array(
            'catalog_catalog_index',
            'catalog_catalog_new',
            'catalog_catalog_show',
            'catalog_catalog_edit',
        )));
        $sidemenu->addChild('sidemenu.product.root', array('route' => 'catalog_product_index'))->setExtras(array('translation_domain' => 'UniCatalogBundle', 'routes' => array(
            'catalog_product_index',
            'catalog_product_new',
            'catalog_product_show',
            'catalog_product_edit',
        )));

        return $sidemenu;
    }

}