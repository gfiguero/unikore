<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssuerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'issuer.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'issuer.form.image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'fileinput' ),
                'required' => false,
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('rut', null, array(
                'label' => 'issuer.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('address_street', null, array(
                'label' => 'issuer.form.address_street',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('address_number', null, array(
                'label' => 'issuer.form.address_number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('commune', null, array(
                'label' => 'issuer.form.commune',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'multiselect' ),
                'translation_domain' => 'UniOfferBundle',
                'required' => true,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Issuer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_issuer';
    }


}
