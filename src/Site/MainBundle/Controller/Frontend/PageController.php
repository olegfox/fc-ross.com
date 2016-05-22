<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Entity\Player;

class PageController extends Controller
{
    public function indexAction($parent, $slug)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository->findOneBySlug($slug);

        if(!$page){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $params = array(
            'page' => $page
        );

        if($slug == 'osnovnoi-sostav' || $slug == 'dubliruiushchii-sostav'){
            $repository_player = $this->getDoctrine()->getRepository('SiteMainBundle:Player');

            if($slug == 'osnovnoi-sostav'){
                $players = $repository_player->findOneByTeamWithStatus('Россиянка', Player::STATUS_MAIN);
            }else{
                $players = $repository_player->findOneByTeamWithStatus('Россиянка', Player::STATUS_DOP);
            }

            $params = array_merge($params, array(
                'players' => $players
            ));

        }elseif($slug == "rukovodstvo"){
            $repository_director = $this->getDoctrine()->getRepository('SiteMainBundle:Director');

            $directors = $repository_director->findAllArray();

            $params = array_merge($params, array(
                'directors' => $directors
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
