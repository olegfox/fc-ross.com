<?php

namespace Site\PollBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Choice;

use Prism\PollBundle\Form\VoteType as BaseVoteType;

/**
 * VoteType
 */
class VoteType extends BaseVoteType
{
    /**
     * Build Form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opinions', 'choice', array(
                'multiple' => false,
                'expanded' => true,
                'choices' => $options['opinionsChoices'],
                'constraints' => array(
                    new NotNull(array('message' => "Пожалуйста выберите из списка.")),
                    new Choice(array('choices' => array_keys($options['opinionsChoices'])))
                ))
            );
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return "vote";
    }

    /**
     * Set Default Options
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array('opinionsChoices'));
    }
}