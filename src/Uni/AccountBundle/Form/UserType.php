<?php

namespace Uni\AccountBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => 'user.form.username',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('email', null, array(
                'label' => 'user.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('account', null, array(
                'label' => 'user.form.account',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('groups', null, array(
                'label' => 'user.form.groups',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('name', null, array(
                'label' => 'user.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('rut', null, array(
                'label' => 'user.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('phone_number', null, array(
                'label' => 'user.form.phone_number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('address_street', null, array(
                'label' => 'user.form.address_street',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('address_number', null, array(
                'label' => 'user.form.address_number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
            ->add('address_commune', null, array(
                'label' => 'user.form.address_commune',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAccountBundle',
            )) 
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_adminbundle_user';
    }


}
