<?php

namespace Uni\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class SocialmediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder 
            ->add('page', null, array(
                'label' => 'socialmedia.form.page',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
                'required' => true,
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('p')
                        ->where('p.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('socialnetwork', null, array(
                'label' => 'socialmedia.form.socialnetwork',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
                'required' => true,
            ))
            ->add('url', null, array(
                'label' => 'socialmedia.form.url',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
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
            'data_class' => 'Uni\AdminBundle\Entity\Socialmedia',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_pagebundle_socialmedia';
    }


}
