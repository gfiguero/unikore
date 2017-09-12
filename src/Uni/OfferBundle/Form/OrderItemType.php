<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class OrderItemType extends AbstractType
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
            ->add('product', null, array(
                'label' => false,
                'required' => true,
                'placeholder' => 'item.form.placeholder.product',
                'attr' => array( 'class' => 'multiselect' ),
                'choice_label' => function ($product) {
                    return $product->getName() . ' (' . $product->getProvider() . ')';
                },
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('p')
                        ->where('p.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('quantity', null, array(
                'label' => false,
                'required' => true,
                'empty_data' => 1
            ))
            ->add('discount', null, array(
                'label' => false,
                'required' => true,
                'empty_data' => 0
            ))
            ->add('surcharge', null, array(
                'label' => false,
                'required' => true,
                'empty_data' => 0
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\OrderItem'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_offerbundle_orderitem';
    }


}
