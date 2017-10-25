<?php

namespace Uni\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('domain', null, array(
                'label' => 'page.form.domain',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'page.form.imagefile',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'fileinput' ),
                'translation_domain' => 'UniAdminBundle',
                'required' => false,
            ))
            ->add('brand', null, array(
                'label' => 'page.form.brand',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('brand_primary_color', null, array(
                'label' => 'page.form.brand_primary_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('brand_secondary_color', null, array(
                'label' => 'page.form.brand_secondary_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('main_title', null, array(
                'label' => 'page.form.main_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('main_subtitle', null, array(
                'label' => 'page.form.main_subtitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('main_calltoaction', null, array(
                'label' => 'page.form.main_calltoaction',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('about_title', null, array(
                'label' => 'page.form.about_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('about_content', null, array(
                'label' => 'page.form.about_content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('feature_title', null, array(
                'label' => 'page.form.feature_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('feature_content', null, array(
                'label' => 'page.form.feature_content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('socialmedia_title', null, array(
                'label' => 'page.form.socialmedia_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_title', null, array(
                'label' => 'page.form.contact_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_content', null, array(
                'label' => 'page.form.contact_content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_phone', null, array(
                'label' => 'page.form.contact_phone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_email', null, array(
                'label' => 'page.form.contact_email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_address', null, array(
                'label' => 'page.form.contact_address',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('contact_schedule', null, array(
                'label' => 'page.form.contact_schedule',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('socialmedia_title', null, array(
                'label' => 'page.form.socialmedia_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('keywords', null, array(
                'label' => 'page.form.keywords',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('social_share_image', null, array(
                'label' => 'page.form.social_share_image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('social_share_title', null, array(
                'label' => 'page.form.social_share_title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('social_share_description', null, array(
                'label' => 'page.form.social_share_description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('fb_share_appid', null, array(
                'label' => 'page.form.fb_share_appid',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
            ))
            ->add('account', null, array(
                'label' => 'page.form.account',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'UniAdminBundle',
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
        return 'uni_adminbundle_page';
    }


}