<?php

namespace Uni\ControlPanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('title', null, array(
                'label' => 'feature.form.title',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('description', null, array(
                'label' => 'feature.form.description',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniControlPanelBundle',
            )) 
            ->add('imagefile', 'file', array(
                'label' => 'feature.form.imagefile',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'fileinput' ),
                'translation_domain' => 'UniControlPanelBundle',
                'required' => false,
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
