<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
        $text = $request->get('text');
//      Если строка поиска не более 100, и не менее 3 символов
        if(strlen($text) >= 3 && strlen($text) < 100){
            $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
            $repository_player = $this->getDoctrine()->getRepository('SiteMainBundle:Player');

            $news = $repository_news->findSearch($text);
            $players = $repository_player->findSearch($text);

            return $this->render('SiteMainBundle:Frontend/Search:index.html.twig', array(
                'news' => $news,
                'players' => $players
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Search:not.valid.html.twig', array(
            'flashMessage' => 'Строка поиска должна быть не более 100 символов и не менее 3'
        ));
    }
}
