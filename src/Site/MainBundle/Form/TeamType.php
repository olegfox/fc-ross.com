<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', null, array(
                'required' => false,
                'label' => 'backend.team.position'
            ))
            ->add('positionM', null, array(
                'required' => false,
                'label' => 'backend.team.positionM'
            ))
            ->add('name', null, array(
                'required' => true,
                'label' => 'backend.team.name'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.team.img'
            ))
            ->add('visible', 'choice', array(
                'required' => true,
                'label' => 'backend.team.visible.name',
                'choices' => array(
                    0 => 'backend.team.visible.all',
                    1 => 'backend.team.visible.cuboc'
                ),
                'expanded' => false,
                'multiple' => false,
                'translation_domain' => 'menu'
            ))
            ->add('games', null, array(
                'required' => false,
                'label' => 'backend.team.games'
            ))
            ->add('wins', null, array(
                'required' => false,
                'label' => 'backend.team.wins'
            ))
            ->add('standoff', null, array(
                'required' => false,
                'label' => 'backend.team.standoff'
            ))
            ->add('defeat', null, array(
                'required' => false,
                'label' => 'backend.team.defeat'
            ))
            ->add('balls', null, array(
                'required' => false,
                'label' => 'backend.team.balls'
            ))
            ->add('points', null, array(
                'required' => false,
                'label' => 'backend.team.points'
            ))
            ->add('gamesM', null, array(
                'required' => false,
                'label' => 'backend.team.gamesM'
            ))
            ->add('winsM', null, array(
                'required' => false,
                'label' => 'backend.team.winsM'
            ))
            ->add('standoffM', null, array(
                'required' => false,
                'label' => 'backend.team.standoffM'
            ))
            ->add('defeatM', null, array(
                'required' => false,
                'label' => 'backend.team.defeatM'
            ))
            ->add('ballsM', null, array(
                'required' => false,
                'label' => 'backend.team.ballsM'
            ))
            ->add('pointsM', null, array(
                'required' => false,
                'label' => 'backend.team.pointsM'
            ))
//            ->add('event', 'entity', array(
//                'label'=>'backend.team.event',
//                'class'=>'SiteMainBundle:Event',
//                'multiple'=>true,
//                'expanded'=>true
//            ))
            ->add('players', 'entity', array(
                'label'=>'backend.team.players',
                'class'=>'SiteMainBundle:Player',
                'multiple'=>true,
                'expanded'=>true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Team',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_team';
    }
}
