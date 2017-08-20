<?php

namespace Uni\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Uni\UserBundle\Form\Type\RoleType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'group.form.name',
                'translation_domain' => 'UniUserBundle'
            ))
            ->add('roles', RoleType::class, array(
                'label' => 'group.form.roles',
                'translation_domain' => 'UniUserBundle',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\GroupFormType';
    }

    public function getBlockPrefix()
    {
        return 'uni_user_group';
    }
}
