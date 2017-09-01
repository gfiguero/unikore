<?php

namespace Uni\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class FeatureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $account = $options['token_storage']->getToken()->getUser()->getAccount();
        $builder 
            ->add('page', null, array(
                'label' => 'feature.form.page',
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
                'label' => 'feature.form.name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('title', null, array(
                'label' => 'feature.form.title',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('description', null, array(
                'label' => 'feature.form.description',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'feature.form.imagefile',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'fileinput' ),
                'translation_domain' => 'UniPageBundle',
                'required' => false,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uni\AdminBundle\Entity\Feature',
            'token_storage' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_pagebundle_feature';
    }


}
