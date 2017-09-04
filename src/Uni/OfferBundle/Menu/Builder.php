<?php

namespace Uni\OfferBundle\Menu;

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

        $sidemenu->addChild('sidemenu.dashboard.root', array('route' => 'offer_dashboard_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_dashboard_index',
        )));
        $sidemenu->addChild('sidemenu.account.root', array('route' => 'offer_account_edit'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_account_edit',
        )));
        $sidemenu->addChild('sidemenu.issuer.root', array('route' => 'offer_issuer_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_issuer_index',
            'offer_issuer_new',
            'offer_issuer_show',
            'offer_issuer_edit',
        )));
        $sidemenu->addChild('sidemenu.provider.root', array('route' => 'offer_provider_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_provider_index',
            'offer_provider_new',
            'offer_provider_show',
            'offer_provider_edit',
        )));
        $sidemenu->addChild('sidemenu.client.root', array('route' => 'offer_client_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_client_index',
            'offer_client_new',
            'offer_client_show',
            'offer_client_edit',
        )));
        $sidemenu->addChild('sidemenu.seller.root', array('route' => 'offer_seller_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_seller_index',
            'offer_seller_new',
            'offer_seller_show',
            'offer_seller_edit',
        )));
        $sidemenu->addChild('sidemenu.product.root', array('route' => 'offer_product_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_product_index',
            'offer_product_new',
            'offer_product_show',
            'offer_product_edit',
        )));
        $sidemenu->addChild('sidemenu.note.root', array('route' => 'offer_note_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_note_index',
            'offer_note_new',
            'offer_note_show',
            'offer_note_edit',
        )));
        $sidemenu->addChild('sidemenu.budget.root', array('route' => 'offer_budget_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_budget_index',
            'offer_budget_new',
            'offer_budget_show',
            'offer_budget_edit',
        )));
        $sidemenu->addChild('sidemenu.invoice.root', array('route' => 'offer_invoice_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_invoice_index',
            'offer_invoice_new',
            'offer_invoice_show',
            'offer_invoice_edit',
        )));
/*
        $sidemenu->addChild('sidemenu.item.root', array('route' => 'offer_item_index'))->setExtras(array('translation_domain' => 'UniOfferBundle', 'routes' => array(
            'offer_item_index',
            'offer_item_new',
            'offer_item_show',
            'offer_item_edit',
        )));
*/

        return $sidemenu;
    }

}