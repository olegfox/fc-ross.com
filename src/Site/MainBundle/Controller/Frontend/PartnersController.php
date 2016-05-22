<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartnersController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Partners');

        $partners = $repository->findAll();

        return $this->render('SiteMainBundle:Frontend/Partners:index.html.twig', array(
            'partners' => $partners
        ));
    }
}
