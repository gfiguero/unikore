<?php

namespace Uni\AgentBundle\Form;

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
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'issuer.form.image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'fileinput' ),
                'required' => false,
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('rut', null, array(
                'label' => 'issuer.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('address_street', null, array(
                'label' => 'issuer.form.address_street',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('address_number', null, array(
                'label' => 'issuer.form.address_number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('commune', null, array(
                'label' => 'issuer.form.commune',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'multiselect' ),
                'translation_domain' => 'UniAgentBundle',
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
        return 'uni_agentbundle_issuer';
    }


}
