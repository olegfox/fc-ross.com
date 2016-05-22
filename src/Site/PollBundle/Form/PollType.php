<?php

namespace Site\PollBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Prism\PollBundle\Form\PollType as BasePollType;

/**
 * PollType
 */
class PollType extends BasePollType
{
    /**
     * Build Form
     *
     * @param FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'backend.poll.question'
            ))
            ->add('published', null, array(
                'label' => 'backend.poll.published'
            ))
            ->add('closed', null, array(
                'label' => 'backend.poll.closed'
            ))
            ->add('opinions', 'bootstrap_collection', array(
                'label' => 'backend.poll.choices',
                'type' => new $options['opinion_form'],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'add_button_text'    => 'backend.poll.add_choice',
                'delete_button_text' => 'backend.poll.delete_choice',
                'sub_widget_col'     => 3,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
            ->add('submit', 'submit', array('label' => 'backend.poll.submit'))
        ;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return 'poll';
    }

    /**
     * Set Default Options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'opinion_form' => 'Prism\PollBundle\Form\OpinionType',
            'cascade_validation' => true,
            'translation_domain' => 'poll'
        ));
    }
}
