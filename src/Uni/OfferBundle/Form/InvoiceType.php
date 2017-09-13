<?php

namespace Uni\OfferBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        $invoice = $options['data'];
        $builder
            ->add('name', null, array(
                'label' => 'invoice.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('number', null, array(
                'label' => 'invoice.form.number',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('amount', null, array(
                'label' => 'invoice.form.amount',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
            ))
            ->add('file', 'file', array(
                'label' => 'invoice.form.file',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'fileinput' ),
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
            ->add('paymentstatus', null, array(
                'label' => 'invoice.form.paymentstatus',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniOfferBundle',
                'choice_label' => 'name',
                'required' => true,
            ))
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
