<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GoalEventType extends AbstractType
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
                'label' => 'backend.goal_event.type.name',
                'choices' => array(
                    false => 'backend.goal_event.type.first',
                    true => 'backend.goal_event.type.second'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('score', null, array(
                'required' => false,
                'label' => 'backend.goal_event.score'
            ))
            ->add('player', 'entity', array(
                'required' => true,
                'label' => 'backend.goal_event.player',
                'class' => 'Site\MainBundle\Entity\Player'
//                'query_builder' => function (\Site\MainBundle\Entity\Repository\PlayerRepository $pr) {
//                        return $pr->getPlayerFirstTeam();
//                    }
            ))
            ->add('time', null, array(
                'required' => false,
                'label' => 'backend.goal_event.time'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\GoalEvent',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_goal_event';
    }
}
