<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoMainType extends AbstractType
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
                'label' => 'backend.videomain.title'
            ))
            ->add('link', 'url', array(
                'required' => true,
                'label' => 'backend.videomain.link'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.videomain.preview_img'
            ))
            ->add('main', 'choice', array(
                'required' => true,
                'label' => 'backend.videomain.main.label',
                'choices' => array(
                    0 => 'backend.videomain.main.yes',
                    1 => 'backend.videomain.main.no'
                ),
                'translation_domain' => 'menu'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\VideoMain',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_videomain';
    }
}
