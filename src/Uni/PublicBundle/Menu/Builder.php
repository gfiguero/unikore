<?php

namespace Uni\PublicBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {

        $page = $options['page'];

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-nav-custom navbar-right');
        $topmenu->setChildrenAttribute('id', 'topmenu');

        $aboutLink = 'Nosotros';
        if ($page->getAboutTitle()) $aboutLink = $page->getAboutTitle();
        $featureLink = 'Características';
        if ($page->getFeatureTitle()) $featureLink = $page->getFeatureTitle();
        $socialLink = 'Social';
        if ($page->getSocialmediaTitle()) $socialLink = $page->getSocialmediaTitle();
        $contactLink = 'Contacto';
        if ($page->getContactTitle()) $contactLink = $page->getContactTitle();

        $topmenu->addChild($aboutLink, array('uri' => '#about'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild($featureLink, array('uri' => '#feature'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild($socialLink, array('uri' => '#socialmedia'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild($contactLink, array('uri' => '#contact'))->setLinkAttribute('class', 'page-scroll');

        return $topmenu;
    }

}