<?php

namespace Uni\CatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Uni\AdminBundle\Entity\Catalog;
use Uni\CatalogBundle\Form\CategoryType;

class CatalogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', null, array(
                'label' => 'catalog.form.page',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniCatalogBundle',
            )) 
            ->add('name', null, array(
                'label' => 'catalog.form.name',
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
            'data_class' => Catalog::class,
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
