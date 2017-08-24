<?php

namespace Uni\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'page.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('domain', null, array(
                'label' => 'page.form.domain',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('brand', null, array(
                'label' => 'page.form.brand',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('brand_primary_color', null, array(
                'label' => 'page.form.brand_primary_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('brand_secondary_color', null, array(
                'label' => 'page.form.brand_secondary_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('maintitle', null, array(
                'label' => 'page.form.maintitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('mainsubtitle', null, array(
                'label' => 'page.form.mainsubtitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('maincalltoaction', null, array(
                'label' => 'page.form.maincalltoaction',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('abouttitle', null, array(
                'label' => 'page.form.abouttitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('aboutcontent', null, array(
                'label' => 'page.form.aboutcontent',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('featuretitle', null, array(
                'label' => 'page.form.featuretitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('featurecontent', null, array(
                'label' => 'page.form.featurecontent',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contacttitle', null, array(
                'label' => 'page.form.contacttitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contactcontent', null, array(
                'label' => 'page.form.contactcontent',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'wysiwyg' ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contactphone', null, array(
                'label' => 'page.form.contactphone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contactemail', null, array(
                'label' => 'page.form.contactemail',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contactaddress', null, array(
                'label' => 'page.form.contactaddress',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniPageBundle',
            ))
            ->add('contactschedule', null, array(
                'label' => 'page.form.contactschedule',
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
            'data_class' => 'Uni\AdminBundle\Entity\Page'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'uni_pagebundle_page';
    }


}
