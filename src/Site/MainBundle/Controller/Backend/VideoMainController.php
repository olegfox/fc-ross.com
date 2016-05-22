<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\VideoMain;
use Site\MainBundle\Form\VideoMainType;
use Site\MainBundle\VideoParser\VideoParser;

/**
 * VideoMain controller.
 *
 */
class VideoMainController extends Controller
{

    /**
     * Lists all VideoMain entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:VideoMain')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/VideoMain:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
    /**
     * Creates a new VideoMain entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VideoMain();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

//          Добавляеем видео
            if($entity->getLink()){

                $video = VideoParser::getVideo($entity->getLink(), 595, 355, 0);

                if(count($entity->getTitle()) == 0){
                    $entity->setTitle($video->title);
                }
                $entity->setPreviewImageUrl($video->thumbnail_url);
                $entity->setHtml($video->html);

            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_videomain_show', array('id' => $entity->getId())));
        }

        return $this->render('SiteMainBundle:Backend/VideoMain:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VideoMain entity.
     *
     * @param VideoMain $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VideoMain $entity)
    {
        $form = $this->createForm(new VideoMainType(), $entity, array(
            'action' => $this->generateUrl('backend_videomain_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new VideoMain entity.
     *
     */
    public function newAction()
    {
        $entity = new VideoMain();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiteMainBundle:Backend/VideoMain:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VideoMain entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:VideoMain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.videomain.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/VideoMain:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VideoMain entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:VideoMain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.videomain.not_found'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/VideoMain:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VideoMain entity.
    *
    * @param VideoMain $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VideoMain $entity)
    {
        $form = $this->createForm(new VideoMainType(), $entity, array(
            'action' => $this->generateUrl('backend_videomain_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing VideoMain entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:VideoMain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.videomain.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

//          Редактируем видео

//          Если строка с видео не пустая
            if($entity->getLink()){

                $video = VideoParser::getVideo($entity->getLink(), 595, 355, 0);

                if(count($entity->getTitle()) == 0){
                    $entity->setTitle($video->title);
                }
                $entity->setPreviewImageUrl($video->thumbnail_url);
                $entity->setHtml($video->html);

            }

            $em->flush();

            return $this->redirect($this->generateUrl('backend_videomain_edit', array('id' => $id)));
        }

        return $this->render('SiteMainBundle:Backend/VideoMain:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VideoMain entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:VideoMain')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.videomain.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_videomain_index'));
    }

    /**
     * Creates a form to delete a VideoMain entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_videomain_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'backend.delete',
                'translation_domain' => 'menu',
                'attr' => array(
                    'class' => 'btn-danger'
                )
            ))
            ->getForm()
        ;
    }
}
