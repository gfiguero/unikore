<?php

namespace Uni\ControlPanelBundle\Form;

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
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('short', null, array(
                'label' => 'product.form.short',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('description', null, array(
                'label' => 'product.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('image', null, array(
                'label' => 'product.form.image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('cost', null, array(
                'label' => 'product.form.cost',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('price', null, array(
                'label' => 'product.form.price',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('code', null, array(
                'label' => 'product.form.code',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('cm_code', null, array(
                'label' => 'product.form.cm_code',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('height', null, array(
                'label' => 'product.form.height',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('width', null, array(
                'label' => 'product.form.width',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('length', null, array(
                'label' => 'product.form.length',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('weight', null, array(
                'label' => 'product.form.weight',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('thickness', null, array(
                'label' => 'product.form.thickness',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('diameter', null, array(
                'label' => 'product.form.diameter',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('brand', null, array(
                'label' => 'product.form.brand',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('origin', null, array(
                'label' => 'product.form.origin',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('resistance', null, array(
                'label' => 'product.form.resistance',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('warranty', null, array(
                'label' => 'product.form.warranty',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('certification', null, array(
                'label' => 'product.form.certification',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('consumer_name', null, array(
                'label' => 'product.form.consumer_name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('consumer_age', null, array(
                'label' => 'product.form.consumer_age',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('consumer_capacity', null, array(
                'label' => 'product.form.consumer_capacity',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('consumer_traffic', null, array(
                'label' => 'product.form.consumer_traffic',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_main', null, array(
                'label' => 'product.form.structure_main',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_side', null, array(
                'label' => 'product.form.structure_side',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_instalation', null, array(
                'label' => 'product.form.structure_instalation',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_anchorage', null, array(
                'label' => 'product.form.structure_anchorage',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_assembly', null, array(
                'label' => 'product.form.structure_assembly',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_protection', null, array(
                'label' => 'product.form.structure_protection',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_termination', null, array(
                'label' => 'product.form.structure_termination',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_color', null, array(
                'label' => 'product.form.structure_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('structure_size', null, array(
                'label' => 'product.form.structure_size',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('provider', null, array(
                'label' => 'product.form.provider',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('user', null, array(
                'label' => 'product.form.user',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('account', null, array(
                'label' => 'product.form.account',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('subcategory', null, array(
                'label' => 'product.form.subcategory',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
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
        return 'uni_controlpanelbundle_product';
    }


}
