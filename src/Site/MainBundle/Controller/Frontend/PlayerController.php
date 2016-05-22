<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function indexAction($slug)
    {
        $repository_player = $this->getDoctrine()->getRepository('SiteMainBundle:Player');

        $player = $repository_player->findOneBySlug($slug);

        if(!$player){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.player.not_found'));
        }

        $params = array(
            'player' => $player
        );

        return $this->render('SiteMainBundle:Frontend/Player:index.html.twig', $params);
    }
}
