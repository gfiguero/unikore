<?php

namespace Uni\ControlPanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Uni\AdminBundle\Entity\Category;
use Uni\ControlPanelBundle\Form\SubcategoryType;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'category.form.name',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('subcategories', 'bootstrap_collection', array(
                'label' => 'category.form.subcategories',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniAgentBundle',
                'entry_type' => SubcategoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text'    => 'category.form.addcategory',
                'delete_button_text' => 'category.form.deletecategory',
                'prototype_name' => 'subcategories_collection',
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
            'data_class' => Category::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_controlpanelbundle_category';
    }


}
