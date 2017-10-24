<?php

namespace Uni\PublicBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class CatalogBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /*public function topMenu(FactoryInterface $factory, array $options)
    {
        $catalogs = $options['catalogs'];

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav');
        $topmenu->setChildrenAttribute('id', 'topmenu');

        foreach ($catalogs as $catalog) {
            $topmenu->addChild('topmenu.catalog.'.$catalog->getId(), array('route' => 'public_catalog_show', 'routeParameters' => array('id' => $catalog->getId())));
            $topmenu['topmenu.catalog.'.$catalog->getId()]->setLabel($catalog->getName());
        }

        return $topmenu;
    }*/

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $categories = $options['categories'];

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'sidemenu');

        foreach ($categories as $category) {
//            $sidemenu->addChild('sidemenu.category.'.$category->getId(), array('route' => 'public_category_show', 'routeParameters' => array('id' => $category->getId())));
            $sidemenu->addChild('sidemenu.category.'.$category->getId(), array('uri' => '#'));
            $sidemenu['sidemenu.category.'.$category->getId()]->setLabel($category->getName());
            $sidemenu['sidemenu.category.'.$category->getId()]->setExtras(array('dropdown' => true));
            $sidemenu['sidemenu.category.'.$category->getId()]->setAttributes(array('class' => 'dropdown'));
            $sidemenu['sidemenu.category.'.$category->getId()]->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
            $sidemenu['sidemenu.category.'.$category->getId()]->setChildrenAttribute('class', 'dropdown-menu');

            foreach ($category->getSubcategories() as $subcategory) {
                $sidemenu['sidemenu.category.'.$category->getId()]->addChild('sidemenu.subcategory.'.$subcategory->getId(), array('route' => 'public_catalog_subcategory', 'routeParameters' => array('id' => $subcategory->getId())));
                $sidemenu['sidemenu.category.'.$category->getId()]['sidemenu.subcategory.'.$subcategory->getId()]->setLabel($subcategory->getName());
            }
        }


        return $sidemenu;

    }
}