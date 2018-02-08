<?php

namespace Uni\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class PortfolioItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder
            ->add('portfoliocategory', null, array(
                'label' => 'portfolioitem.form.portfoliocategory',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPortfolioBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('pc')
                        ->where('pc.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('document', null, array(
                'label' => 'portfolioitem.form.document',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPortfolioBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('d')
                        ->where('d.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\PortfolioItem',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_portfoliobundle_portfolioitem';
    }

}