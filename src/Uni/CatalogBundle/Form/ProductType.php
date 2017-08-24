<?php

namespace Uni\CatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'product.form.name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            )) 
            ->add('short', null, array(
                'label' => 'product.form.short',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            )) 
            ->add('description', null, array(
                'label' => 'product.form.description',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'product.form.imagefile',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'fileinput' ),
                'translation_domain' => 'UniCatalogBundle',
                'required' => false,
            ))
            ->add('cost', null, array(
                'label' => 'product.form.cost',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            )) 
            ->add('price', null, array(
                'label' => 'product.form.price',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            )) 
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_catalogbundle_product';
    }

}
