<?php

namespace Site\MainBundle\Form;

use Site\MainBundle\Entity\BenchCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'choice', array(
                'required' => true,
                'label' => 'backend.event.name',
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
            ->add('final', 'choice', array(
                'required' => false,
                'label' => 'backend.event.final.name',
                'choices' => array(
                    0 => 'backend.event.final.final_1',
                    1 => 'backend.event.final.final_1_2',
                    2 => 'backend.event.final.final_1_4',
                    3 => 'backend.event.final.final_1_8',
                    4 => 'backend.event.final.final_1_16'
                ),
                'expanded' => false,
                'multiple' => false,
                'translation_domain' => 'menu'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.event.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.event.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.event.metakeywords'
            ))
            ->add('tour', null, array(
                'required' => false,
                'label' => 'backend.event.tour'
            ))
            ->add('datetime', null, array(
                'required' => true,
                'label' => 'backend.event.datetime'
            ))
            ->add('score', null, array(
                'required' => false,
                'label' => 'backend.event.score'
            ))
            ->add('numberGoals', null, array(
                'required' => false,
                'label' => 'backend.event.number_goals',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('numberYellowCards', null, array(
                'required' => false,
                'label' => 'backend.event.number_yellow_cards',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('stadium', null, array(
                'required' => false,
                'label' => 'backend.event.stadium'
            ))
            ->add('eventTeam', 'bootstrap_collection', array(
                'label'=>'backend.event.teams',
                'type' => new EventTeamType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.event_team.add_team',
                'delete_button_text' => 'backend.event_team.delete_team',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
            ->add('benchCoach', 'bootstrap_collection', array(
                'label'=>'backend.event.bench_coach',
                'type' => new BenchCoachType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.bench_coach.add',
                'delete_button_text' => 'backend.bench_coach.delete',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
            ->add('playerTeam', 'bootstrap_collection', array(
                'label'=>'backend.event.player_team',
                'type' => new PlayerTeamType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.player_team.add',
                'delete_button_text' => 'backend.player_team.delete',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
//            ->add('benchPlayerTeam', 'bootstrap_collection', array(
//                'label'=>'backend.event.bench_player_team',
//                'type' => new BenchPlayerTeamType(),
//                'allow_add'          => true,
//                'allow_delete'       => true,
//                'add_button_text'    => 'backend.bench_player_team.add',
//                'delete_button_text' => 'backend.bench_player_team.delete',
//                'sub_widget_col'     => 9,
//                'button_col'         => 3,
//                'prototype_name'     => 'inlinep',
//                'options'            => array(
//                    'attr' => array('style' => 'inline')
//                )
//            ))
            ->add('punishmentEvent', 'bootstrap_collection', array(
                'label'=>'backend.event.punishment_event',
                'type' => new PunishmentEventType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.punishment_event.add',
                'delete_button_text' => 'backend.punishment_event.delete',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
            ->add('goalEvent', 'bootstrap_collection', array(
                'label'=>'backend.event.goal_event',
                'type' => new GoalEventType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.goal_event.add',
                'delete_button_text' => 'backend.goal_event.delete',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
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
            'data_class' => 'Site\MainBundle\Entity\Event',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_event';
    }
}
