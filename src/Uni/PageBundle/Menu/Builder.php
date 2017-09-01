<?php

namespace Uni\PageBundle\Menu;

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

        $sidemenu->addChild('sidemenu.page.root', array('route' => 'page_page_index'))->setExtras(array('translation_domain' => 'UniPageBundle', 'routes' => array(
            'page_page_index',
            'page_page_new',
            'page_page_show',
            'page_page_edit',
        )));
        $sidemenu->addChild('sidemenu.photography.root', array('route' => 'page_photography_index'))->setExtras(array('translation_domain' => 'UniPageBundle', 'routes' => array(
            'page_photography_index',
            'page_photography_new',
            'page_photography_show',
            'page_photography_edit',
        )));
        $sidemenu->addChild('sidemenu.feature.root', array('route' => 'page_feature_index'))->setExtras(array('translation_domain' => 'UniPageBundle', 'routes' => array(
            'page_feature_index',
            'page_feature_new',
            'page_feature_show',
            'page_feature_edit',
        )));
        $sidemenu->addChild('sidemenu.socialmedia.root', array('route' => 'page_socialmedia_index'))->setExtras(array('translation_domain' => 'UniPageBundle', 'routes' => array(
            'page_socialmedia_index',
            'page_socialmedia_new',
            'page_socialmedia_show',
            'page_socialmedia_edit',
        )));

        return $sidemenu;
    }

}