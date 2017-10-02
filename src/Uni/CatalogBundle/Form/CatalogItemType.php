<?php

namespace Uni\CatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class CatalogItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();        
        $builder
            ->add('subcategory', null, array(
                'label' => 'catalogitem.form.subcategory',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('s')
                        ->where('s.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('product', null, array(
                'label' => 'catalogitem.form.product',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('p')
                        ->where('p.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))                  
            ->add('quantity', null, array(
                'label' => 'catalogitem.form.quantity',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('discount', null, array(
                'label' => 'catalogitem.form.discount',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            ))
            ->add('surcharge', null, array(
                'label' => 'catalogitem.form.surcharge',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniCatalogBundle',
            ))                        
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\CatalogItem',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_catalogbundle_catalogitem';
    }

}