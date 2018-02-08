<?php

namespace Uni\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'document.form.name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPortfolioBundle',
            )) 
            ->add('short', null, array(
                'label' => 'document.form.short',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'UniPortfolioBundle',
            )) 
            ->add('description', null, array(
                'label' => 'document.form.description',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniPortfolioBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'document.form.imagefile',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'fileinput' ),
                'translation_domain' => 'UniPortfolioBundle',
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
            'data_class' => 'Uni\AdminBundle\Entity\Document'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_portfoliobundle_document';
    }

}
