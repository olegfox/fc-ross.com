<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class BackendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Страницы', array('route' => 'backend_page_index'));
        $menu->addChild('Партнеры', array('route' => 'backend_partners_index'));
        $menu->addChild('Слайдер', array('route' => 'backend_slider_index'));
        $menu->addChild('Новости', array('route' => 'backend_news_index'));
        $menu->addChild('Анонсы', array('route' => 'backend_announcement_index'));
        $menu->addChild('События', array('route' => 'backend_event_index'));
        $menu->addChild('Команды', array('route' => 'backend_team_index'));
        $menu->addChild('Игроки', array('route' => 'backend_player_index'));
        $menu->addChild('Руководство', array('route' => 'backend_director_index'));
        $menu->addChild('Медиа', array('route' => 'backend_media_index'));
        $menu->addChild('Реклама', array('route' => 'backend_baner_index'));
        $menu->addChild('Instagram', array('route' => 'backend_instagram_index'));
        $menu->addChild('Опросы', array('route' => 'PrismPollBundle_backend_poll_list'));
        $menu->addChild('Кубки', array('route' => 'backend_cuboc_index'));
        $menu->addChild('Видео на главной', array('route' => 'backend_videomain_index'));

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Выход', array('route' => 'fos_user_security_logout'));

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}