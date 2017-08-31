<?php

namespace Uni\AccountBundle\Menu;

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

        $sidemenu->addChild('sidemenu.account.root', array('route' => 'account_account_index'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
            'account_account_index',
            'account_account_new',
            'account_account_show',
            'account_account_edit',
        )));
        $sidemenu->addChild('sidemenu.user.root', array('route' => 'account_user_index'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
            'account_user_index',
            'account_user_new',
            'account_user_show',
            'account_user_edit',
        )));
        $sidemenu->addChild('sidemenu.group.root', array('route' => 'fos_user_group_list'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
            'fos_user_group_list',
            'fos_user_group_new',
            'fos_user_group_show',
            'fos_user_group_edit',
        )));

        return $sidemenu;
    }

}