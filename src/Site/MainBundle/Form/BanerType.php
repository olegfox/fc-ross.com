<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BanerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', 'url', array(
                'required' => true,
                'label' => 'backend.baner.link',
                'attr' => array(
                    'placeholder' => 'http://'
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.baner.img'
            ))
            ->add('onMain', 'choice', array(
                'required' => true,
                'label' => 'backend.baner.on_main.head',
                'choices' => array(
                    0 => 'backend.baner.on_main.no',
                    1 => 'backend.baner.on_main.yes'
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
            'data_class' => 'Site\MainBundle\Entity\Baner',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_baner';
    }
}
