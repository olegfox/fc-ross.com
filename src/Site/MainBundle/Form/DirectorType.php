<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DirectorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'required' => true,
                'label' => 'backend.director.type.name',
                'choices' => array(
                    0 => 'backend.director.type.type_1',
                    1 => 'backend.director.type.type_2',
                    2 => 'backend.director.type.type_3',
                    3 => 'backend.director.type.type_4',
                    4 => 'backend.director.type.type_5'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('name', null, array(
                'required' => true,
                'label' => 'backend.director.name'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.player.img'
            ))
            ->add('status', null, array(
                'required' => true,
                'label' => 'backend.director.status'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Director',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_director';
    }
}
