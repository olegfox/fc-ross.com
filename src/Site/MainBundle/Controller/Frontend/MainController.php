<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_slider = $this->getDoctrine()->getRepository('SiteMainBundle:Slider');
        $repository_event = $this->getDoctrine()->getRepository('SiteMainBundle:Event');
        $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');
        $repository_instagram = $this->getDoctrine()->getRepository('SiteMainBundle:Instagram');
        $repository_cuboc = $this->getDoctrine()->getRepository('SiteMainBundle:Cuboc');
        $repository_video_main = $this->getDoctrine()->getRepository('SiteMainBundle:VideoMain');

        $page = $repository_page->findOneBySlug('glavnaia');
        $news = $repository_news->findAllForType();
        $newsSlider = $repository_news->findLast();
        $sliders = $repository_slider->findAll();
        $lastPastEvent = $repository_event->findLastPastEvent();
        $firstFutureEvent = $repository_event->findFirstFutureEvent();
        $calendarEvent = $repository_event->getCalendar();
        $teamsChiemp = $repository_team->findByEventType('chiempionat');
        $teamsMolodioz = $repository_team->findByEventType('dubliruiushchii-sostav-1');
        $instagram = $repository_instagram->findAllColumn();
        $cuboc = $repository_cuboc->findAll();
        $videoMain = $repository_video_main->findFirstVideo();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'news' => $news,
            'newsSlider' => $newsSlider,
            'page' => $page,
            'sliders' => $sliders,
            'lastPastEvent' => $lastPastEvent,
            'firstFutureEvent' => $firstFutureEvent,
            'calendarEvent' => $calendarEvent,
            'teamsChiemp' => $teamsChiemp,
            'teamsMolodioz' => $teamsMolodioz,
            'instagram' => $instagram,
            'cuboc' => $cuboc,
            'videoMain' => $videoMain
        ));
    }
}
