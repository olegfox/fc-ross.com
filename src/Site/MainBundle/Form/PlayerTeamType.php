<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerTeamType extends AbstractType
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
                'label' => 'backend.player_team.type.name',
                'choices' => array(
                    false => 'backend.player_team.type.first',
                    true => 'backend.player_team.type.second'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('player', 'entity', array(
                'required' => true,
                'label' => 'backend.player_team.player',
                'class' => 'Site\MainBundle\Entity\Player'
//                'query_builder' => function (\Site\MainBundle\Entity\Repository\PlayerRepository $pr) {
//                        return $pr->getPlayerFirstTeam();
//                    }
            ))
            ->add('time', null, array(
                'required' => false,
                'label' => 'backend.punishment_event.time'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\PlayerTeam',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_event_player_team';
    }
}
