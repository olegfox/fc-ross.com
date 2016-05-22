<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnouncementType extends AbstractType
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
                'label' => 'backend.announcement.title'
            ))
            ->add('date', null, array(
                'required' => true,
                'label' => 'backend.announcement.date'
            ))
            ->add('birthDay', 'choice', array(
                'required' => true,
                'label' => 'backend.announcement.birthDay.label',
                'choices' => array(
                    false => 'backend.announcement.birthDay.no',
                    true => 'backend.announcement.birthDay.yes'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.announcement.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.announcement.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.announcement.metakeywords'
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'backend.announcement.description'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.announcement.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.announcement.img'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Announcement',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_announcement';
    }
}
