<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BanerController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Baner');

        $baner = $repository->findRandom();

        $params = array(
            'baner' => $baner
        );

        return $this->render('SiteMainBundle:Frontend/Baner:index.html.twig', $params);
    }
}
