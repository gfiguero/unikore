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
        $sidemenu->addChild('sidemenu.group.root', array('route' => 'account_group_index'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
            'account_group_index',
            'account_group_new',
            'account_group_show',
            'account_group_edit',
        )));
        $sidemenu->addChild('sidemenu.accountpayment.root', array('route' => 'account_accountpayment_index'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
            'account_accountpayment_index',
            'account_accountpayment_new',
            'account_accountpayment_show',
            'account_accountpayment_edit',
        )));
//        $sidemenu->addChild('sidemenu.group.root', array('route' => 'fos_user_group_list'))->setExtras(array('translation_domain' => 'UniAccountBundle', 'routes' => array(
//            'fos_user_group_list',
//            'fos_user_group_new',
//            'fos_user_group_show',
//            'fos_user_group_edit',
//        )));

        return $sidemenu;
    }

}