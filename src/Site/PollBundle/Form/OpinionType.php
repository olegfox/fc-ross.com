<?php

namespace Site\PollBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Prism\PollBundle\Form\OpinionType as BaseOpinionType;

/**
 * OpinionType
 */
class OpinionType extends BaseOpinionType
{
    /**
     * Build Form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array(
            'label' => ''
        ));
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return 'opinion';
    }

    /**
     * Set Default Options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Prism\PollBundle\Entity\Opinion',
            'translation_domain' => 'poll'
        ));
    }
}