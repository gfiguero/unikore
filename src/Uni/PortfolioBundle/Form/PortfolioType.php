<?php

namespace Uni\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

use Uni\AdminBundle\Entity\Portfolio;
use Uni\PortfolioBundle\Form\PortfolioCategoryType;

class PortfolioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder
            ->add('page', null, array(
                'label' => 'portfolio.form.page',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPortfolioBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('s')
                        ->where('s.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('name', null, array(
                'label' => 'portfolio.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPortfolioBundle',
            ))
            ->add('portfolio_content', null, array(
                'label' => 'portfolio.form.portfolio_content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPortfolioBundle',
            ))
            ->add('portfolio_calltoaction', null, array(
                'label' => 'portfolio.form.portfolio_calltoaction',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPortfolioBundle',
            ))
            ->add('portfoliocategories', 'bootstrap_collection', array(
                'label' => 'portfolio.form.portfoliocategories',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPortfolioBundle',
                'entry_type' => PortfolioCategoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text'    => 'portfolio.form.addportfoliocategory',
                'delete_button_text' => 'portfolio.form.deleteportfoliocategory',
                'prototype_name' => 'portfoliocategories_collection',
                'delete_empty' => true,
                'by_reference' => false,
                'sub_widget_col' => 11,
                'button_col' => 1,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Portfolio',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_portfoliobundle_portfolio';
    }


}
