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
        $checker = $this->container->get('security.authorization_checker');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

        if (!$checker->isGranted('ROLE_USER')) {
            $topmenu->addChild('topmenu.login', array('route' => 'fos_user_security_login'))->setExtras(array('icon' => 'sign-in fa-fw', 'translation_domain' => 'UniControlPanelBundle'));
            $topmenu->addChild('topmenu.reset', array('route' => 'fos_user_resetting_request'))->setExtras(array('icon' => 'repeat fa-fw', 'translation_domain' => 'UniControlPanelBundle'));
        }

        if ($checker->isGranted('ROLE_ADMIN')) {
            $topmenu->addChild('topmenu.admin', array('route' => 'admin_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle'));
            $topmenu->addChild('topmenu.adminaccount', array('route' => 'account_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle'));
        }

        if ($checker->isGranted('ROLE_OFFER')) {
            $topmenu->addChild('topmenu.offer', array('route' => 'offer_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle'));
        }

        if ($checker->isGranted('ROLE_PAGE')) {
            $topmenu->addChild('topmenu.page', array('route' => 'page_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
                'page_page_index',
                'page_page_new',
                'page_page_edit',
                'page_page_show',
            )));
        }

        if ($checker->isGranted('ROLE_CATALOG')) {
            $topmenu->addChild('topmenu.catalog', array('route' => 'catalog_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle'));
        }

        if ($checker->isGranted('ROLE_USER')) {
            $topmenu->addChild('topmenu.controlpanel', array('route' => 'controlpanel_root'))->setExtras(array('translation_domain' => 'UniControlPanelBundle'));
        }

//        if ($checker->isGranted('ROLE_LEADER')) {
//            $topmenu->addChild('topmenu.account');
//            $topmenu['topmenu.account']->setUri('#');
//            $topmenu['topmenu.account']->setLabel($user->getAccount());
//            $topmenu['topmenu.account']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
//            $topmenu['topmenu.account']->setExtras(array('dropdown' => true, 'translation_domain' => 'UniControlPanelBundle'));
//            $topmenu['topmenu.account']->setChildrenAttributes(array('class' => 'dropdown-menu'));
//
//            $topmenu['topmenu.account']->addChild('topmenu.settings', array('route' => 'offer_account_edit'));
//            $topmenu['topmenu.account']['topmenu.settings']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'gears fa-fw'));
//
//            $topmenu['topmenu.account']->addChild('topmenu.issuer', array('route' => 'offer_issuer_index'));
//            $topmenu['topmenu.account']['topmenu.issuer']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'flag fa-fw'));
//
//            $topmenu['topmenu.account']->addChild('topmenu.user', array('route' => 'offer_user_index'));
//            $topmenu['topmenu.account']['topmenu.user']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'users fa-fw'));
//        }

        if ($checker->isGranted('ROLE_USER')) {
            $topmenu->addChild('topmenu.user');
            $topmenu['topmenu.user']->setUri('#');
            $topmenu['topmenu.user']->setLabel($user->getName());
            $topmenu['topmenu.user']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $topmenu['topmenu.user']->setExtras(array('dropdown' => true, 'translation_domain' => 'UniControlPanelBundle'));
            $topmenu['topmenu.user']->setChildrenAttributes(array('class' => 'dropdown-menu'));

            $topmenu['topmenu.user']->addChild('topmenu.dashboard', array('route' => 'controlpanel_dashboard_index'));
            $topmenu['topmenu.user']['topmenu.dashboard']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'dashboard fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.profile', array('route' => 'fos_user_profile_edit'));
            $topmenu['topmenu.user']['topmenu.profile']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'user fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.password', array('route' => 'offer_user_change_password'));
            $topmenu['topmenu.user']['topmenu.password']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'unlock-alt fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.account', array('route' => 'controlpanel_account_edit'));
            $topmenu['topmenu.user']['topmenu.account']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'cloud fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'));
            $topmenu['topmenu.user']['topmenu.logout']->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'icon' => 'sign-out fa-fw'));

        }


//        $topmenu->addChild('topmenu.header', array('route' => 'admin_header_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'UniAdminBundle'));
//        $topmenu->addChild('topmenu.logout', array('route' => 'front_logout'))->setAttributes(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'UniFrontBundle'));
//        $topmenu->addChild('topmenu.account.root', array('route' => 'controlpanel_account_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_account_index',
//            'controlpanel_account_new',
//            'controlpanel_account_show',
//            'controlpanel_account_edit',
//        )));
//        $topmenu->addChild('topmenu.user.root', array('route' => 'controlpanel_user_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_user_index',
//            'controlpanel_user_new',
//            'controlpanel_user_show',
//            'controlpanel_user_edit',
//        )));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.dashboard.root', array('route' => 'controlpanel_dashboard_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_dashboard_index',
        )));
        $sidemenu->addChild('sidemenu.password.root', array('route' => 'fos_user_change_password'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'fos_user_change_password',
        )));
        $sidemenu->addChild('sidemenu.profile.root', array('route' => 'fos_user_profile_edit'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'fos_user_profile_edit',
        )));
        $sidemenu->addChild('sidemenu.account.root', array('route' => 'controlpanel_account_edit'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
            'controlpanel_account_edit',
        )));


//        $sidemenu->addChild('sidemenu.commune.root', array('route' => 'admin_commune_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
//            'admin_commune_index',
//            'admin_commune_new',
//            'admin_commune_show',
//            'admin_commune_edit',
//        )));
//        $sidemenu->addChild('sidemenu.province.root', array('route' => 'admin_province_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
//            'admin_province_index',
//            'admin_province_new',
//            'admin_province_show',
//            'admin_province_edit',
//        )));
//        $sidemenu->addChild('sidemenu.region.root', array('route' => 'admin_region_index'))->setExtras(array('translation_domain' => 'UniAdminBundle', 'routes' => array(
//            'admin_region_index',
//            'admin_region_new',
//            'admin_region_show',
//            'admin_region_edit',
//        )));
//        $sidemenu->addChild('sidemenu.product.root', array('route' => 'controlpanel_product_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_product_index',
//            'controlpanel_product_new',
//            'controlpanel_product_show',
//            'controlpanel_product_edit',
//        )));
//        $sidemenu->addChild('sidemenu.feature.root', array('route' => 'controlpanel_feature_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_feature_index',
//            'controlpanel_feature_new',
//            'controlpanel_feature_show',
//            'controlpanel_feature_edit',
//        )));
//        $sidemenu->addChild('sidemenu.photography.root', array('route' => 'controlpanel_photography_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_photography_index',
//            'controlpanel_photography_new',
//            'controlpanel_photography_show',
//            'controlpanel_photography_edit',
//        )));
//        $sidemenu->addChild('sidemenu.category.root', array('route' => 'controlpanel_category_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_category_index',
//            'controlpanel_category_new',
//            'controlpanel_category_show',
//            'controlpanel_category_edit',
//        )));
//        $sidemenu->addChild('sidemenu.subcategory.root', array('route' => 'controlpanel_subcategory_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_subcategory_index',
//            'controlpanel_subcategory_new',
//            'controlpanel_subcategory_show',
//            'controlpanel_subcategory_edit',
//        )));
//        $sidemenu->addChild('sidemenu.catalog.root', array('route' => 'controlpanel_catalog_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_catalog_index',
//            'controlpanel_catalog_new',
//            'controlpanel_catalog_show',
//            'controlpanel_catalog_edit',
//        )));
//        $sidemenu->addChild('sidemenu.page.root', array('route' => 'controlpanel_page_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_page_index',
//            'controlpanel_page_new',
//            'controlpanel_page_show',
//            'controlpanel_page_edit',
//        )));
//        $sidemenu->addChild('sidemenu.socialnetwork.root', array('route' => 'controlpanel_socialnetwork_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_socialnetwork_index',
//            'controlpanel_socialnetwork_new',
//            'controlpanel_socialnetwork_show',
//            'controlpanel_socialnetwork_edit',
//        )));
//        $sidemenu->addChild('sidemenu.socialmedia.root', array('route' => 'controlpanel_socialmedia_index'))->setExtras(array('translation_domain' => 'UniControlPanelBundle', 'routes' => array(
//            'controlpanel_socialmedia_index',
//            'controlpanel_socialmedia_new',
//            'controlpanel_socialmedia_show',
//            'controlpanel_socialmedia_edit',
//        )));

        return $sidemenu;
    }

}