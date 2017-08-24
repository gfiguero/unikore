<?php

namespace Uni\PageBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
//        $checker = $this->container->get('security.authorization_checker');
//        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $page = $options['page'];

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-nav-custom navbar-right');
        $topmenu->setChildrenAttribute('id', 'topmenu');

//        $topmenu->addChild('topmenu.home', array('route' => 'uni_page_index'))->setExtras(array('translation_domain' => 'UniPageBundle'))->setLinkAttribute('class', 'page-scroll');
        $aboutLink = 'Nosotros';
        if ($page->getAboutTitle()) $aboutLink = $page->getAboutTitle();
        $featureLink = 'Características';
        if ($page->getFeatureTitle()) $featureLink = $page->getFeatureTitle();
        $contactLink = 'Contacto';
        if ($page->getContactTitle()) $contactLink = $page->getContactTitle();

        $topmenu->addChild($aboutLink, array('uri' => '#about'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild($featureLink, array('uri' => '#feature'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild($contactLink, array('uri' => '#contact'))->setLinkAttribute('class', 'page-scroll');

/*
        if ($checker->isGranted('ROLE_USER')) {

            $topmenu->addChild('topmenu.user');
            $topmenu['topmenu.user']->setUri('#');
            $topmenu['topmenu.user']->setLabel($user->getEmail());
            $topmenu['topmenu.user']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $topmenu['topmenu.user']->setExtras(array('dropdown' => true, 'translation_domain' => 'UniPageBundle'));
            $topmenu['topmenu.user']->setChildrenAttributes(array('class' => 'dropdown-menu'));

            $topmenu['topmenu.user']->addChild('topmenu.profile', array('route' => 'fos_user_profile_show'));
            $topmenu['topmenu.user']['topmenu.profile']->setExtras(array('translation_domain' => 'UniPageBundle', 'icon' => 'user fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.feature', array('route' => 'controlpanel_feature_index'));
            $topmenu['topmenu.user']['topmenu.feature']->setExtras(array('translation_domain' => 'UniPageBundle'));

            $topmenu['topmenu.user']->addChild('topmenu.account', array('route' => 'controlpanel_account_edit'));
            $topmenu['topmenu.user']['topmenu.account']->setExtras(array('translation_domain' => 'UniPageBundle'));

            $topmenu['topmenu.user']->addChild('topmenu.change_password', array('route' => 'fos_user_change_password'));
            $topmenu['topmenu.user']['topmenu.change_password']->setExtras(array('translation_domain' => 'UniPageBundle', 'icon' => 'unlock-alt fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'));
            $topmenu['topmenu.user']['topmenu.logout']->setExtras(array('translation_domain' => 'UniPageBundle', 'icon' => 'sign-out fa-fw'));
        } else {
//            $topmenu->addChild('topmenu.register', array('route' => 'fos_user_registration_register'))->setExtras(array('translation_domain' => 'UniPageBundle'));
            $topmenu->addChild('topmenu.login', array('route' => 'fos_user_security_login'))->setExtras(array('translation_domain' => 'UniPageBundle'));
        }
*/
        return $topmenu;
    }

}