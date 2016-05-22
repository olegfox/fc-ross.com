<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\Instagram;

/**
 * Instagram controller.
 *
 */
class InstagramController extends Controller
{

    /**
     * Lists all Instagram entities.
     *
     */
    public function indexAction($tag)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:Instagram')->findAllArray();

        $media = $this->get('instagram')->getMedia($tag, 0);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            20/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/Instagram:index.html.twig', array(
            'entities' => $pagination,
            'media' => $media
        ));
    }

    /**
     * Подгрузка фотографий ajax.
     *
     */
    public function ajaxIndexAction(Request $request, $tag){
        $max_id = $request->get('max_id');

        if($max_id){
            $media = $this->get('instagram')->getMedia($tag, $max_id);

            return $this->render('SiteMainBundle:Backend/Instagram:ajax_index.html.twig', array(
                'media' => $media
            ));
        }

        return new Response('', 500);
    }

    /**
     * New a Instagram entity.
     *
     */
    public function newAction(Request $request)
    {
        $all_request = $request->request->all();

        if(count($all_request) > 0){

            $em = $this->getDoctrine()->getManager();
            $instagram = new Instagram();

            $instagram->setLink($all_request['link']);
            $instagram->setCreatedTime($all_request['created_time']);
            $instagram->setLowImageUrl($all_request['low_image_url']);
            $instagram->setStandardImageUrl($all_request['standard_image_url']);
            $instagram->setThumbnailUrl($all_request['thumbnail_url']);
            $instagram->setCaptionText($all_request['caption_text']);
            $instagram->setType(0);

            $em->persist($instagram);
            $em->flush();

            return new Response(json_encode(array(
                'route' => $this->generateUrl('backend_instagram_delete', array('id' => $instagram->getId())),
                'textButton' => $this->get('translator')->trans('backend.instagram.delete', array(), 'menu')
            )), 200);
        }

        return new Response('', 500);
    }

    /**
     * Deletes a Instagram entity.
     *
     */
    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Instagram');

        $instagram = $repository->find($id);

        if($instagram){

            $em = $this->getDoctrine()->getManager();
            $em->remove($instagram);
            $em->flush();

            return new Response('', 200);
        }

        return new Response('', 500);
    }

    /**
     * Change tag search for Instagram.
     *
     */
    public function changeAction(Request $request){
        $tag = $request->get('tag');

        return $this->redirect($this->generateUrl('backend_instagram_index', array('tag' => $tag)), 301);
    }
}
