<?php

namespace Uni\ControlPanelBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

//        $topmenu->addChild('topmenu.header', array('route' => 'admin_header_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'UniAdminBundle'));
//        $topmenu->addChild('topmenu.logout', array('route' => 'front_logout'))->setAttributes(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'UniFrontBundle'));
        $topmenu->addChild('topmenu.account.root', array('route' => 'controlpanel_account_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_account_index',
            'controlpanel_account_new',
            'controlpanel_account_show',
            'controlpanel_account_edit',
        )));
        $topmenu->addChild('topmenu.user.root', array('route' => 'controlpanel_user_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_user_index',
            'controlpanel_user_new',
            'controlpanel_user_show',
            'controlpanel_user_edit',
        )));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

/*
        $sidemenu->addChild('sidemenu.commune.root', array('route' => 'admin_commune_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
            'admin_commune_index',
            'admin_commune_new',
            'admin_commune_show',
            'admin_commune_edit',
        )));
        $sidemenu->addChild('sidemenu.province.root', array('route' => 'admin_province_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
            'admin_province_index',
            'admin_province_new',
            'admin_province_show',
            'admin_province_edit',
        )));
        $sidemenu->addChild('sidemenu.region.root', array('route' => 'admin_region_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
            'admin_region_index',
            'admin_region_new',
            'admin_region_show',
            'admin_region_edit',
        )));
*/
        $sidemenu->addChild('sidemenu.product.root', array('route' => 'controlpanel_product_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_product_index',
            'controlpanel_product_new',
            'controlpanel_product_show',
            'controlpanel_product_edit',
        )));
        $sidemenu->addChild('sidemenu.feature.root', array('route' => 'controlpanel_feature_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_feature_index',
            'controlpanel_feature_new',
            'controlpanel_feature_show',
            'controlpanel_feature_edit',
        )));
        $sidemenu->addChild('sidemenu.photography.root', array('route' => 'controlpanel_photography_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_photography_index',
            'controlpanel_photography_new',
            'controlpanel_photography_show',
            'controlpanel_photography_edit',
        )));
        $sidemenu->addChild('sidemenu.category.root', array('route' => 'controlpanel_category_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_category_index',
            'controlpanel_category_new',
            'controlpanel_category_show',
            'controlpanel_category_edit',
        )));
        $sidemenu->addChild('sidemenu.subcategory.root', array('route' => 'controlpanel_subcategory_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_subcategory_index',
            'controlpanel_subcategory_new',
            'controlpanel_subcategory_show',
            'controlpanel_subcategory_edit',
        )));
        $sidemenu->addChild('sidemenu.catalog.root', array('route' => 'controlpanel_catalog_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_catalog_index',
            'controlpanel_catalog_new',
            'controlpanel_catalog_show',
            'controlpanel_catalog_edit',
        )));
        $sidemenu->addChild('sidemenu.page.root', array('route' => 'controlpanel_page_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_page_index',
            'controlpanel_page_new',
            'controlpanel_page_show',
            'controlpanel_page_edit',
        )));

        return $sidemenu;
    }

}