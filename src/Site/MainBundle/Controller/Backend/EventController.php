<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

use Site\MainBundle\Entity\Event;
use Site\MainBundle\Form\EventType;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:Event')->findByFilter($request);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/Event:index.html.twig', array(
            'entities' => $pagination,
        ));
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
//          Команды
            foreach ($entity->getEventTeam() as $eventTeam) {
                $eventTeam->setEvent($entity);
            }
//          Тренера
            foreach ($entity->getBenchCoach() as $benchCoach) {
                $benchCoach->setEvent($entity);
            }
//          Состав команд
            foreach ($entity->getPlayerTeam() as $playerTeam) {
                $playerTeam->setEvent($entity);
            }
//          Запасные
            foreach ($entity->getBenchPlayerTeam() as $benchPlayerTeam) {
                $benchPlayerTeam->setEvent($entity);
            }
//          Наказания в игре
            foreach ($entity->getPunishmentEvent() as $punishmentEvent) {
                $punishmentEvent->setEvent($entity);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
//          Голы в игре
            foreach ($entity->getGoalEvent() as $goalEvent) {
                $goalEvent->setEvent($entity);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_event_show', array('id' => $entity->getId())));
        }

        return $this->render('SiteMainBundle:Backend/Event:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Event entity.
     *
     * @param Event $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Event $entity)
    {
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('backend_event_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->remove('score');
        $form->remove('numberGoals');
        $form->remove('numberYellowCards');
        return $this->render('SiteMainBundle:Backend/Event:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.event.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Event:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.event.not_found'));
        }

        $editForm = $this->createEditForm($entity);
        if ($entity->getDatetime() > new \DateTime()) {
            $editForm->remove('score');
            $editForm->remove('numberGoals');
            $editForm->remove('numberYellowCards');
        }
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Event:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Event entity.
     *
     * @param Event $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Event $entity)
    {

        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('backend_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }

    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.event.not_found'));
        }

//      Команды
        $originalEventTeam = new ArrayCollection();

        foreach ($entity->getEventTeam() as $eventTeam) {
            $originalEventTeam->add($eventTeam);
        }

//      Тренера
        $originalBenchCoach = new ArrayCollection();

        foreach ($entity->getBenchCoach() as $benchCoach) {
            $originalBenchCoach->add($benchCoach);
        }

//      Состав команд
        $originalPlayerTeam = new ArrayCollection();

        foreach ($entity->getPlayerTeam() as $playerTeam) {
            $originalPlayerTeam->add($playerTeam);
        }

//      Запасные
        $originalBenchPlayerTeam = new ArrayCollection();

        foreach ($entity->getBenchPlayerTeam() as $benchPlayerTeam) {
            $originalBenchPlayerTeam->add($benchPlayerTeam);
        }

//      Наказания игроков
        $originalPunishmentEvent = new ArrayCollection();

        foreach ($entity->getPunishmentEvent() as $punishmentEvent) {
            $originalPunishmentEvent->add($punishmentEvent);
        }

//      Голы игроков
        $originalGoalEvent = new ArrayCollection();

        foreach ($entity->getGoalEvent() as $goalEvent) {
            $originalGoalEvent->add($goalEvent);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

//          Команды
            foreach ($originalEventTeam as $eventTeam) {

                if (false === $entity->getEventTeam()->contains($eventTeam)) {

                    $entity->getEventTeam()->removeElement($eventTeam);

                    $em->remove($eventTeam);

                }

            }

            foreach ($entity->getEventTeam() as $eventTeam) {
                $eventTeam->setEvent($entity);
            }

//          Тренера
            foreach ($originalBenchCoach as $benchCoach) {

                if (false === $entity->getBenchCoach()->contains($benchCoach)) {

                    $entity->getBenchCoach()->removeElement($benchCoach);

                    $em->remove($benchCoach);

                }

            }

            foreach ($entity->getBenchCoach() as $benchCoach) {
                $benchCoach->setEvent($entity);
            }

//          Состав команд
            foreach ($originalPlayerTeam as $playerTeam) {

                if (false === $entity->getPlayerTeam()->contains($playerTeam)) {

                    $entity->getPlayerTeam()->removeElement($playerTeam);

                    $em->remove($playerTeam);

                }

            }

            foreach ($entity->getPlayerTeam() as $playerTeam) {
                $playerTeam->setEvent($entity);
            }

//          Запасные
            foreach ($originalBenchPlayerTeam as $benchPlayerTeam) {

                if (false === $entity->getBenchPlayerTeam()->contains($benchPlayerTeam)) {

                    $entity->getBenchPlayerTeam()->removeElement($benchPlayerTeam);

                    $em->remove($benchPlayerTeam);

                }

            }

            foreach ($entity->getBenchPlayerTeam() as $benchPlayerTeam) {
                $benchPlayerTeam->setEvent($entity);
            }

//          Наказания игроков
            foreach ($originalPunishmentEvent as $punishmentEvent) {

                if (false === $entity->getPunishmentEvent()->contains($punishmentEvent)) {

                    $entity->getPunishmentEvent()->removeElement($punishmentEvent);

                    $em->remove($punishmentEvent);

                }

            }

            foreach ($entity->getPunishmentEvent() as $punishmentEvent) {
                $punishmentEvent->setEvent($entity);
            }

//          Голы игроков
            foreach ($originalGoalEvent as $goalEvent) {

                if (false === $entity->getGoalEvent()->contains($goalEvent)) {

                    $entity->getGoalEvent()->removeElement($goalEvent);

                    $em->remove($goalEvent);

                }

            }

            foreach ($entity->getGoalEvent() as $goalEvent) {
                $goalEvent->setEvent($entity);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('backend_event_edit', array('id' => $id)));
        }

        return $this->render('SiteMainBundle:Backend/Event:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.event.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_event_index'));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_event_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'backend.delete',
                'translation_domain' => 'menu',
                'attr' => array(
                    'class' => 'btn-danger'
                )
            ))
            ->getForm();
    }
}
