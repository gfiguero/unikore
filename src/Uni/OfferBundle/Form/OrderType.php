<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class OrderType extends AbstractType
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
            ->add('budget', null, array(
                'label' => 'order.form.budget',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniOfferBundle',
                'required' => false,
                'placeholder' => 'order.form.placeholder.budget',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('b')
                        ->where('b.account = :account')
                        ->andWhere('b.expired_at > :now')
                        ->setParameters(array('account' => $account, 'now' => new \DateTime('now')))
                    ;
                },
                'choice_label' => function ($budget) {
                    return $budget->getDisplayName();
                }
            ))
            ->add('name', null, array(
                'label' => 'order.form.name',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('number', null, array(
                'label' => 'order.form.number',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('amount', null, array(
                'label' => 'order.form.amount',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('file', 'file', array(
                'label' => 'order.form.file',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10, 'class' => 'fileinput'  ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('note', null, array(
                'label' => 'order.form.note',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
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
            'data_class' => 'Uni\AdminBundle\Entity\Order'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_order';
    }

}
