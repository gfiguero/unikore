<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class InvoiceType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $this->tokenStorage->getToken()->getUser()->getAccount();
        $builder 
            ->add('issuer', null, array(
                'label' => 'invoice.form.issuer',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('i')
                        ->where('i.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('client', null, array(
                'label' => 'invoice.form.client',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('c')
                        ->where('c.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('name', null, array(
                'label' => 'invoice.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('code', null, array(
                'label' => 'invoice.form.code',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('amount', null, array(
                'label' => 'invoice.form.amount',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('note', null, array(
                'label' => 'invoice.form.note',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('pay_in', DateType::class, array(
                'label' => 'invoice.form.pay_in',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
/*
            ->add('actions', 'bootstrap_collection', array(
                'label' => false,
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
                'entry_type' => 'Uni\OfferBundle\Form\InvoiceActionType',
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text'    => 'invoice.form.addaction',
                'delete_button_text' => 'invoice.form.deleteaction',
                'delete_empty' => true,
                'by_reference' => false,                
            ))
*/
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Invoice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_invoice';
    }


}
