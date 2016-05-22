<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PunishmentEventType extends AbstractType
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
                'label' => 'backend.punishment_event.type.name',
                'choices' => array(
                    false => 'backend.punishment_event.type.first',
                    true => 'backend.punishment_event.type.second'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('typePunishment', 'choice', array(
                'required' => true,
                'label' => 'backend.punishment_event.type.name',
                'choices' => array(
                    0 => 'backend.punishment_event.type_punishment.first',
                    1 => 'backend.punishment_event.type_punishment.second'
                ),
                'translation_domain' => 'menu'
            ))
            ->add('player', 'entity', array(
                'required' => true,
                'label' => 'backend.punishment_event.player',
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
            'data_class' => 'Site\MainBundle\Entity\PunishmentEvent',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_punishment_event';
    }
}
