<?php

namespace Uni\ControlPanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'feature.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('title', null, array(
                'label' => 'feature.form.title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('description', null, array(
                'label' => 'feature.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('image', null, array(
                'label' => 'feature.form.image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('account', null, array(
                'label' => 'feature.form.account',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('page', null, array(
                'label' => 'feature.form.page',
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
            'data_class' => 'Uni\AdminBundle\Entity\Feature'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_controlpanelbundle_feature';
    }


}
