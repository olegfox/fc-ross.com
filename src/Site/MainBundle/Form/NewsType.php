<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.news.title'
            ))
            ->add('date', null, array(
                'required' => true,
                'label' => 'backend.news.date'
            ))
            ->add('type', 'choice', array(
                'required' => true,
                'label' => 'backend.news.type',
                'choices' => array(
                    0 => 'backend.news.type_choice.events',
                    1 => 'backend.news.type_choice.interviews',
                    2 => 'backend.news.type_choice.opinion',
                ),
                'translation_domain' => 'menu'
            ))
            ->add('typeEvent', 'choice', array(
                'required' => false,
                'label' => 'backend.news.type_event',
                'choices' => array(
                    0 => 'backend.event.name_choice.championship',
                    1 => 'backend.event.name_choice.cup',
                    2 => 'backend.event.name_choice.europa_league',
                    3 => 'backend.event.name_choice.youth_championship'
                ),
                'expanded' => true,
                'multiple' => false,
                'translation_domain' => 'menu'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.news.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.news.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.news.metakeywords'
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'backend.news.description'
            ))
            ->add('mainText', 'textarea', array(
                'required' => false,
                'label' => 'backend.news.mainText'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.news.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.news.img'
            ))
            ->add('gallery', 'file', array(
                'required' => false,
                'label' => 'backend.news.photos',
                'attr' => array(
                    'class' => 'uploadify',
                    'multiple' => true
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\News',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_news';
    }
}
