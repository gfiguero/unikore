<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class ShipmentType extends AbstractType
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
            ->add('invoice', null, array(
                'label' => 'shipment.form.invoice',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('i')
                        ->where('i.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('description', null, array(
                'label' => 'shipment.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('amount', null, array(
                'label' => 'shipment.form.amount',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('file', 'file', array(
                'label' => 'shipment.form.file',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'fileinput'  ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('code', null, array(
                'label' => 'shipment.form.code',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Shipment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_shipment';
    }


}
