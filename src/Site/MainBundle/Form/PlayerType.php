<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, array(
                'required' => true,
                'label' => 'backend.player.firstname'
            ))
            ->add('secondname', null, array(
                'required' => false,
                'label' => 'backend.player.secondname'
            ))
            ->add('patronymic', null, array(
                'required' => false,
                'label' => 'backend.player.patronymic'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.player.img'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.player.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.player.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.player.metakeywords'
            ))
            ->add('teams', 'entity', array(
                'required' => false,
                'label' => 'backend.player.teams',
                'class' => 'Site\MainBundle\Entity\Team',
                'multiple' => true
            ))
            ->add('birthday', null, array(
                'required' => false,
                'label' => 'backend.player.birthday',
                'years' => range(1900, date('Y'))
            ))
            ->add('birthPlace', null, array(
                'required' => false,
                'label' => 'backend.player.birth_place'
            ))
            ->add('nationality', null, array(
                'required' => false,
                'label' => 'backend.player.nationality'
            ))
            ->add('amplua', 'entity', array(
                'required' => true,
                'label' => 'backend.player.amplua',
                'class' => 'Site\MainBundle\Entity\Amplua'
            ))
            ->add('height', null, array(
                'required' => false,
                'label' => 'backend.player.height'
            ))
            ->add('weight', null, array(
                'required' => false,
                'label' => 'backend.player.weight'
            ))
            ->add('firstCoach', null, array(
                'required' => false,
                'label' => 'backend.player.firstCoach'
            ))
            ->add('progress', null, array(
                'required' => false,
                'label' => 'backend.player.progress'
            ))
            ->add('title', null, array(
                'required' => false,
                'label' => 'backend.player.title'
            ))
            ->add('previousTeams', null, array(
                'required' => false,
                'label' => 'backend.player.previous_teams'
            ))
            ->add('favoritePlace', null, array(
                'required' => false,
                'label' => 'backend.player.favorite_place'
            ))
            ->add('favoriteDish', null, array(
                'required' => false,
                'label' => 'backend.player.favorite_dish'
            ))
            ->add('favoriteMusic', null, array(
                'required' => false,
                'label' => 'backend.player.favorite_music'
            ))
            ->add('favoriteBook', null, array(
                'required' => false,
                'label' => 'backend.player.favorite_book'
            ))
            ->add('anySport', null, array(
                'required' => false,
                'label' => 'backend.player.any_sport'
            ))
            ->add('hobby', null, array(
                'required' => false,
                'label' => 'backend.player.hobby'
            ))
            ->add('favoritePhrase', null, array(
                'required' => false,
                'label' => 'backend.player.favorite_phrase'
            ))
            ->add('status', 'choice', array(
                'required' => true,
                'label' => 'backend.player.status',
                'choices' => array(
                    0 => 'backend.player.status_choice.main',
                    1 => 'backend.player.status_choice.yorth',
                    2 => 'backend.player.status_choice.dop',
                    3 => 'backend.player.status_choice.archive',
                ),
                'translation_domain' => 'menu'
            ))
//            ->add('teams')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Player',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_player';
    }
}
