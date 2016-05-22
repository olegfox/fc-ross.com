<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function indexAction()
    {
        $repository_media = $this->getDoctrine()->getRepository('SiteMainBundle:Media');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $media = $repository_media->findAllLimits(15);
        $page = $repository_page->findOneBySlug('miedia');

        $columns = array();
        $i = 0;
        foreach ($media as $m) {
            $columns[$i % 3][] = $m;
            $i++;
        }

        $params = array(
            'media' => $columns,
            'mediaLength' => count($media),
            'lastSlug' => count($media) ? $media[count($media) - 1]->getSlug() : 0,
            'page' => $page
        );

        return $this->render('SiteMainBundle:Frontend/Media:index.html.twig', $params);
    }

    public function oneAction($slug)
    {
        $repository_media = $this->getDoctrine()->getRepository('SiteMainBundle:Media');

        $allMedia = $repository_media->findAllWithoutSlug($slug, 15);
        $media = $repository_media->findOneBySlug($slug);

        $columns = array();
        $i = 0;
        foreach ($allMedia as $m) {
            $columns[$i % 3][] = $m;
            $i++;
        }

        $params = array(
            'allMedia' => $columns,
            'mediaLength' => count($allMedia),
            'lastSlug' => count($allMedia) ? $allMedia[count($allMedia) - 1]->getSlug() : 0,
            'media' => $media
        );

        return $this->render('SiteMainBundle:Frontend/Media:one.html.twig', $params);
    }

    public function ajaxAction($slug)
    {
        $repository_media = $this->getDoctrine()->getRepository('SiteMainBundle:Media');

        $allMedia = $repository_media->findAllWithoutSlug($slug, 15);

        $columns = array();
        $i = 0;
        foreach ($allMedia as $m) {
            $columns[$i % 3][] = $m;
            $i++;
        }

        $params = array(
            'allMedia' => $columns,
            'mediaLength' => count($allMedia),
            'lastSlug' => count($allMedia) ? $allMedia[count($allMedia) - 1]->getSlug() : 0
        );

        return $this->render('SiteMainBundle:Frontend/Media:ajax.html.twig', $params);
    }
}
