<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('budget_note', null, array(
                'label' => 'account.form.budget_note',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniOfferBundle',
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
        return 'uni_offerbundle_account';
    }


}
