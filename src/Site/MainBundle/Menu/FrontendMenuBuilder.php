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

        $menus = $repository->findBy(array('parent' => null), array('position' => 'asc'));

        $menu = $factory->createItem('root');

        foreach ($menus as $m) {

            if ($m->getSlug() == 'glavnaia') {

//                $menu->addChild($m->getTitle(), array(
//                    'route' => 'frontend_homepage'
//                ));

//          Меню Медиа
            } elseif ($m->getSlug() == 'miedia') {
                $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_media_index'
                ));
//          Меню новостей
            } elseif ($m->getSlug() == 'novosti') {

                $newsMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events'),
                    'attributes' => array('class' => 'children')
                ));

//              Подменю
                $newsMenu->addChild('события', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events')
                ));
                $newsMenu->addChild('интервью', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'interviews')
                ));
                $newsMenu->addChild('мнения', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'opinion')
                ));
//          Меню турниров
            } elseif ($m->getSlug() == 'turniry') {

//              Если это турниры, то сразу попадаем на чемпионаты
                $eventMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_event_sub_index',
                    'routeParameters' => array('type' => $m->getChildren()[0]->getSlug(), 'subtype' => 'novosti'),
                    'attributes' => array('class' => 'children')
                ));

//              Подменю турниров
                foreach ($m->getChildren() as $c) {
                    $subEventMenu = $eventMenu->addChild($c->getTitle(), array(
                        'route' => 'frontend_event_sub_index',
                        'routeParameters' => array('type' => $c->getSlug(), 'subtype' => 'novosti')
                    ));
                    if($routeName == 'frontend_event_sub_index' && $request->get('type') == $c->getSlug()){
                        $subEventMenu->setCurrent(true);
                    }
                }


//          Меню текстовых страниц
            } else {
                $mainMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_page',
                    'routeParameters' => array('slug' => $m->getSlug())
                ));

                if($m->getSlug() == 'komanda'){
                    $mainMenu = $menu->addChild($m->getTitle(), array(
                        'route' => 'frontend_page_child',
                        'routeParameters' => array('parent' => $m->getSlug(), 'slug' => $m->getChildren()[0]->getSlug())
                    ));
                }

                if(count($m->getChildren()) > 0){
                    $mainMenu->setAttributes(array(
                        'class' => 'children'
                    ));
                }

//              Подменю
                foreach ($m->getChildren() as $c) {
                    $mainMenu->addChild($c->getTitle(), array(
                        'route' => 'frontend_page_child',
                        'routeParameters' => array('parent' => $c->getParent()->getSlug(), 'slug' => $c->getSlug())
                    ));
                }

            }

        }

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}