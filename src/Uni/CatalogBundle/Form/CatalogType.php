<?php

namespace Uni\CatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

use Uni\AdminBundle\Entity\Catalog;
use Uni\CatalogBundle\Form\CategoryType;

class CatalogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder
            ->add('page', null, array(
                'label' => 'catalog.form.page',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('s')
                        ->where('s.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('name', null, array(
                'label' => 'catalog.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('catalog_content', null, array(
                'label' => 'catalog.form.catalog_content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('catalog_calltoaction', null, array(
                'label' => 'catalog.form.catalog_calltoaction',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('categories', 'bootstrap_collection', array(
                'label' => 'catalog.form.categories',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
                'entry_type' => CategoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text'    => 'catalog.form.addcategory',
                'delete_button_text' => 'catalog.form.deletecategory',
                'prototype_name' => 'categories_collection',
                'delete_empty' => true,
                'by_reference' => false,
                'sub_widget_col' => 11,
                'button_col' => 1,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Catalog',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_catalogbundle_catalog';
    }


}
