<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function indexAction($type)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:News');

        $news = $repository->findType($type);

//        if(!$news){
//            throw $this->createNotFoundException($this->get('translator')->trans('backend.news.not_found'));
//        }

        $params = array(
            'news' => $news
        );

        return $this->render('SiteMainBundle:Frontend/News:index.html.twig', $params);
    }

    public function oneAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:News');

        $news = $repository->findOneBySlug($slug);

        if(!$news){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.news.not_found'));
        }

        $params = array(
            'news' => $news
        );

        return $this->render('SiteMainBundle:Frontend/News:one.html.twig', $params);
    }
}
