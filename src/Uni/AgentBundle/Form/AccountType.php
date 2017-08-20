<?php

namespace Uni\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'account.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAgentBundle',
            ))
            ->add('budget_note', null, array(
                'label' => 'account.form.budget_note',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniAgentBundle',
            ))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Account'
        ));
    }

    public function getBlockPrefix()
    {
        return 'uni_agentbundle_account';
    }


}
