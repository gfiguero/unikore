<?php

namespace Uni\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'security.form.invalid_current_password',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder
            ->add('current_password', PasswordType::class, array(
                'label' => 'security.form.current_password',
                'translation_domain' => 'UniUserBundle',
                'mapped' => false,
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'constraints' => new UserPassword($constraintsOptions),
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => 'security.form.username',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('email', EmailType::class, array(
                'label' => 'security.form.email',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('name', null, array(
                'label' => 'security.form.name',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('rut', null, array(
                'label' => 'security.form.rut',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => false,
            ))
            ->add('address_street', null, array(
                'label' => 'security.form.address_street',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => false,
            ))
            ->add('address_number', null, array(
                'label' => 'security.form.address_number',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => false,
            ))
            ->add('address_commune', null, array(
                'label' => 'security.form.address_commune',
                'translation_domain' => 'UniUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => false,
            ))
        ;
    }

    public function getBlockPrefix()
    {
        return 'uni_user_profile';
    }
}
