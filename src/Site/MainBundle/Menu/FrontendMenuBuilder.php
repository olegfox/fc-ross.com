<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');

        $routeName = $request->get('_route');

        $em = $this->container->get('doctrine.orm.entity_manager');

        $repository = $em->getRepository('SiteMainBundle:Page');

        $menus = $repository->findBy(array('parent' => null, 'hide' => false), array('position' => 'asc'));

        $menu = $factory->createItem('root');

        foreach ($menus as $m) {

            if ($m->getSlug() == 'main') {

//                $menu->addChild($m->getTitle(), array(
//                    'route' => 'frontend_homepage'
//                ));

//          Меню Медиа
            } elseif ($m->getSlug() == 'media') {
                $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_media_index'
                ));
//          Меню новостей
            } elseif ($m->getSlug() == 'news') {

                $newsMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events'),
                    'attributes' => array('class' => 'children')
                ));

//              Подменю
                $newsMenu->addChild('events', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events')
                ));
                $newsMenu->addChild('interview', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'interviews')
                ));
                $newsMenu->addChild('opinions', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'opinion')
                ));
//          Меню турниров
            } elseif ($m->getSlug() == 'competitions') {

//              Если это турниры, то сразу попадаем на чемпионаты
                $eventMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_event_sub_index',
                    'routeParameters' => array('type' => $m->getChildren()[0]->getSlug(), 'subtype' => 'standings'),
                    'attributes' => array('class' => 'children')
                ));

//              Подменю турниров
                foreach ($m->getChildren() as $c) {
                    if (!$c->getHide()) {
                        $subEventMenu = $eventMenu->addChild($c->getTitle(), array(
                            'route' => 'frontend_event_sub_index',
                            'routeParameters' => array('type' => $c->getSlug(), 'subtype' => 'standings')
                        ));
                        if(($routeName == 'frontend_event_sub_index' && $request->get('type') == $c->getSlug()) ||
                           ($routeName == 'frontend_event_game_index' && $request->get('type') == $c->getSlug())){
                            $subEventMenu->setCurrent(true);
                        }
                    }    
                }

//          Меню текстовых страниц
            } else {
                $mainMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_page',
                    'routeParameters' => array('slug' => $m->getSlug())
                ));

                if($m->getSlug() == 'team' || $m->getSlug() == 'club'){
                    if(is_object($m->getChildren()[0])){
                        $mainMenu = $menu->addChild($m->getTitle(), array(
                            'route' => 'frontend_page_child',
                            'routeParameters' => array('parent' => $m->getSlug(), 'slug' => $m->getChildren()[0]->getSlug())
                        ));
                    }
                }

                if(count($m->getChildren()) > 0){
                    $mainMenu->setAttributes(array(
                        'class' => 'children'
                    ));
                }

//              Подменю
                foreach ($m->getChildren() as $c) {
                    if (!$c->getHide()) {
                        $mainMenu->addChild($c->getTitle(), array(
                            'route' => 'frontend_page_child',
                            'routeParameters' => array('parent' => $c->getParent()->getSlug(), 'slug' => $c->getSlug())
                        ));
                    }
                }

            }

        }

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}