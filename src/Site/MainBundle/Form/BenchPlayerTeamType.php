<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BenchPlayerTeamType extends AbstractType
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
                'label' => 'backend.bench_player_team.type.name',
                'choices' => array(
                    false => 'backend.bench_player_team.type.first',
                    true => 'backend.bench_player_team.type.second'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('player', 'entity', array(
                'required' => true,
                'label' => 'backend.bench_player_team.player',
                'class' => 'Site\MainBundle\Entity\Player'
//                'query_builder' => function (\Site\MainBundle\Entity\Repository\PlayerRepository $pr) {
//                        return $pr->getPlayerFirstTeam();
//                    }
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\BenchPlayerTeam',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_bench_player_team';
    }
}
