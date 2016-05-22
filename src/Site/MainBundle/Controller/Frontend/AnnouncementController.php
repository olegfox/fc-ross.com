<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnouncementController extends Controller
{
    public function indexAction($date)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Announcement');

        $announcements = $repository->getAnnouncement($date);

        $params = array(
            'announcements' => $announcements
        );

        return $this->render('SiteMainBundle:Frontend/Announcement:index.html.twig', $params);
    }

    public function oneAction($date, $slug)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Announcement');

        $announcement = $repository->findOneBySlug($slug);

        if (!$announcement) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.announcement.not_found'));
        }

        $params = array(
            'announcement' => $announcement
        );

        return $this->render('SiteMainBundle:Frontend/Announcement:one.html.twig', $params);
    }
}
