<?php

namespace Uni\AccountBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Uni\UserBundle\Form\Type\RoleType;

class GroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'group.form.name',
                'translation_domain' => 'UniAccountBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('roles', RoleType::class, array(
                'label' => 'group.form.roles',
                'translation_domain' => 'UniAccountBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Group'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_adminbundle_group';
    }


}
