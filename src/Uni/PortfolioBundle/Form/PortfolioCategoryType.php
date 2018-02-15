<?php

namespace Uni\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Uni\AdminBundle\Entity\PortfolioCategory;

class PortfolioCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'portfoliocategory.form.name',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniPortfolioBundle',
            )) 
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PortfolioCategory::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_portfoliobundle_portfoliocategory';
    }


}
