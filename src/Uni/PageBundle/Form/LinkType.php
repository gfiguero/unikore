<?php

namespace Uni\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class LinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder 
            ->add('page', null, array(
                'label' => 'link.form.page',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('p')
                        ->where('p.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('name', null, array(
                'label' => 'link.form.name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('title', null, array(
                'label' => 'link.form.title',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('url', null, array(
                'label' => 'link.form.url',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Link',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_pagebundle_link';
    }


}
