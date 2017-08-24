<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'client.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('rut', null, array(
                'label' => 'client.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('contactname', null, array(
                'label' => 'client.form.contactname',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('phone', null, array(
                'label' => 'client.form.phone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('email', null, array(
                'label' => 'client.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('address_street', null, array(
                'label' => 'client.form.address_street',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('address_number', null, array(
                'label' => 'client.form.address_number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('commune', null, array(
                'label' => 'client.form.commune',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('comment', null, array(
                'label' => 'client.form.comment',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_client';
    }


}
