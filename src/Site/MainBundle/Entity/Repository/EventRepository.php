<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Site\MainBundle\Entity\Event;

class EventRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('datetime' => 'ASC'));
    }

//  Поиск событий по типу (Календарь игр)
    public function findByType($type)
    {

        switch ($type) {
            case 'chiempionat':
            {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
            }
                break;
            case 'kubok':
            {
                $typeNumber = Event::NAME_CUP;
            }
                break;
            case 'ligha-ievropy':
            {
                $typeNumber = Event::NAME_EUROPA_LEAGUE;
            }
                break;
            case 'dubliruiushchii-sostav-1':
            {
                $typeNumber = Event::NAME_YOUTH_CHAMPIONSHIP;
            }
                break;
            default:
                {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
                }
                break;
        }

        $events = $this->getEntityManager()->createQuery('
            SELECT e FROM SiteMainBundle:Event e
            WHERE e.name = :typeNumber
            ORDER BY e.datetime ASC
        ')
            ->setParameters(array(
                'typeNumber' => $typeNumber
            ))
            ->getResult();

        return $events;
    }

//  Результат матчей по типу
    public function findByTypeResult($type)
    {

        $query = '
            SELECT e FROM Site\MainBundle\Entity\Event e
            LEFT JOIN e.eventTeam et
            LEFT JOIN et.team team
            WHERE e.name = :typeNumber AND e.datetime <= :now AND team.visible = 0
        ';

        $queryTeams = '
            SELECT t FROM Site\MainBundle\Entity\Team t
            WHERE t.visible = 0
        ';

        switch ($type) {
            case 'chiempionat':
            {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
            }
                break;
            case 'kubok':
            {
                $typeNumber = Event::NAME_CUP;
                $query = '
                    SELECT e FROM Site\MainBundle\Entity\Event e
                    WHERE e.name = :typeNumber and e.datetime <= :now
                ';
                $queryTeams = '
                    SELECT t FROM Site\MainBundle\Entity\Team t
                ';
            }
                break;
            case 'ligha-ievropy':
            {
                $typeNumber = Event::NAME_EUROPA_LEAGUE;
            }
                break;
            case 'dubliruiushchii-sostav-1':
            {
                $typeNumber = Event::NAME_YOUTH_CHAMPIONSHIP;
            }
                break;
            default:
                {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
                }
                break;
        }

        $em = $this->getEntityManager();

//      Все матчи определённого, которые уже прошли
        $events = $em->createQuery($query)
            ->setParameters(array(
                'typeNumber' => $typeNumber,
                'now' => new \DateTime()
            ))
            ->getResult();

//      Список всех команд
        $teams = $em->createQuery($queryTeams)
            ->getResult();

        $resultEvents = array();

        $i = 0;
        $j = 0;

//      Строки
        foreach ($teams as $t1) {
//          Столбцы
            foreach ($teams as $t2) {
//              Если команды разные
                if ($t1->getId() != $t2->getId()) {
                    $fl = 0;
                    $k = 0;
                    foreach ($events as $e) {
//                      Если в игре две команды
                        if (count($e->getEventTeam()) == 2) {
//                          Если для этих двух команд найдена игра
                            if ($e->getEventTeam()[0]->getTeam()->getId() == $t1->getId() && $e->getEventTeam()[1]->getTeam()->getId() == $t2->getId()) {
//                              Если в массиве такой записи ещё нет
                                if (!isset($resultEvents[$i][$j]['nameTeamRow'])) {
                                    $resultEvents[$i][$j]['nameTeamRow'] = $t1->getName();
                                    $resultEvents[$i][$j]['nameTeamCol'] = $t2->getName();
                                    $resultEvents[$i][$j]['img1'] = $t1->getWebPath();
                                    $resultEvents[$i][$j]['img2'] = $t2->getWebPath();
                                }
//                              Если такая запись уже есть, то добавляем только счет
                                $resultEvents[$i][$j]['score'][$k]['game'] = $e;
                                $resultEvents[$i][$j]['score'][$k]['score'] = $e->getScore();
                                $k++;
                                $fl = 1;
                            }
                        }
                    }
//                  Если игры для этих двух команд не найдено
                    if ($fl == 0) {
                        $resultEvents[$i][$j]['nameTeamRow'] = $t1->getName();
                        $resultEvents[$i][$j]['nameTeamCol'] = $t2->getName();
                        $resultEvents[$i][$j]['img1'] = $t1->getWebPath();
                        $resultEvents[$i][$j]['img2'] = $t2->getWebPath();
                        $resultEvents[$i][$j]['score'] = 0;
                    }
//              Если команды одинаковые
                } else {
                    $resultEvents[$i][$j]['nameTeamRow'] = $t1->getName();
                    $resultEvents[$i][$j]['nameTeamCol'] = $t2->getName();
                    $resultEvents[$i][$j]['img1'] = $t1->getWebPath();
                    $resultEvents[$i][$j]['img2'] = $t2->getWebPath();
                    $resultEvents[$i][$j]['score'] = -1;
                }
                $j++;
            }
            $i++;
        }

        return $resultEvents;
    }

//  Последний прошедший матч
    public function findLastPastEvent()
    {
        $event = $this->getEntityManager()->createQuery('
            SELECT e FROM SiteMainBundle:Event e
            LEFT JOIN e.eventTeam et
            LEFT JOIN et.team t
            WHERE e.datetime <= :now
            AND t.name LIKE :teamName
            AND e.name != 3
            ORDER BY e.datetime DESC
        ')
            ->setParameters(array(
                'now' => new \DateTime(),
                'teamName' => "Россиянка"
            ))
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getResult();

        return $event;
    }

//  Первый предстоящий матч
    public function findFirstFutureEvent()
    {
        $event = $this->getEntityManager()->createQuery('
            SELECT e FROM SiteMainBundle:Event e
            LEFT JOIN e.eventTeam et
            LEFT JOIN et.team t
            WHERE e.datetime > :now
            AND t.name LIKE :teamName
            AND e.name != 3
            ORDER BY e.datetime ASC
        ')
            ->setParameters(array(
                'now' => new \DateTime(),
                'teamName' => "Россиянка"
            ))
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getResult();

        return $event;
    }

//  Календарь событий
    public function getCalendar()
    {
        $calendar = array();

        $date_begin = (new \DateTime())->format('Y-m-d');
        $date_end = date('Y-m-d', strtotime($date_begin . ' + 14 days'));
        $i = 0;

        $date = $date_begin;

        $events = $this->getEntityManager()->createQuery('
            SELECT e FROM SiteMainBundle:Event e
            LEFT JOIN e.eventTeam et
            LEFT JOIN et.team t
            WHERE e.datetime >= :date_begin AND e.datetime <= :date_end
            AND t.name LIKE :teamName
        ')
            ->setParameters(array(
                'date_begin' => new \DateTime($date_begin),
                'date_end' => new \DateTime($date_end),
                'teamName' => "Россиянка"
            ))
            ->getResult();

        $announcements = $this->getEntityManager()->createQuery('
            SELECT a FROM SiteMainBundle:Announcement a
            WHERE a.date >= :date_begin AND a.date <= :date_end
        ')
            ->setParameters(array(
                'date_begin' => new \DateTime($date_begin),
                'date_end' => new \DateTime($date_end)
            ))
            ->getResult();

        while ($date <= $date_end) {
            $calendar[$i]['date'] = (new \DateTime())->setTimestamp(strtotime($date));
            foreach ($events as $event) {
                if ($calendar[$i]['date']->format('Y-m-d') == $event->getDatetime()->format('Y-m-d')) {
                    $calendar[$i]['events'][] = $event;
                    if($event->getName() == 3){
                        $calendar[$i]['events']['double'] = 1;
                    }
                }
            }
            foreach ($announcements as $announcement) {
                if ($calendar[$i]['date']->format('Y-m-d') == $announcement->getDate()->format('Y-m-d')) {
                    $calendar[$i]['events'][] = $announcement;
                    if($announcement->getBirthDay()){
                        $calendar[$i]['events']['birthDay'] = 1;
                    }
                }
            }
            $date = date('Y-m-d', strtotime($date . ' + 1 days'));
            $i++;
        }

        return $calendar;
    }

//  Турнирная таблица в Кубке
    public function getCuboc()
    {
        $em = $this->getEntityManager();

//      Все матчи кубка, которые уже прошли
        $events = $em->createQuery('
            SELECT e FROM Site\MainBundle\Entity\Event e
            WHERE e.name = :typeNumber
            ORDER BY e.datetime ASC
        ')
            ->setParameters(array(
                'typeNumber' => Event::NAME_CUP
            ))
            ->getResult();

        $cuboc = array(
            Event::FINAL_1 => array(
                'name' => 'backend.event.final.final_1',
                'events' => array()
            ),
            Event::FINAL_1_2 => array(
                'name' => 'backend.event.final.final_1_2',
                'events' => array()
            ),
            Event::FINAL_1_4 => array(
                'name' => 'backend.event.final.final_1_4',
                'events' => array()
            ),
            Event::FINAL_1_8 => array(
                'name' => 'backend.event.final.final_1_8',
                'events' => array()
            ),
            Event::FINAL_1_16 => array(
                'name' => 'backend.event.final.final_1_16',
                'events' => array()
            )
        );

        foreach ($events as $event) {
            switch ($event->getFinal()) {
                case Event::FINAL_1:
                {
                    $cuboc[Event::FINAL_1]['events'][] = $event;
                }
                    break;
                case Event::FINAL_1_2:
                {
                    $cuboc[Event::FINAL_1_2]['events'][] = $event;
                }
                    break;
                case Event::FINAL_1_4:
                {
                    $cuboc[Event::FINAL_1_4]['events'][] = $event;
                }
                    break;
                case Event::FINAL_1_8:
                {
                    $cuboc[Event::FINAL_1_8]['events'][] = $event;
                }
                    break;
                case Event::FINAL_1_16:
                {
                    $cuboc[Event::FINAL_1_16]['events'][] = $event;
                }
                    break;
            }
        }

        return $cuboc;
    }

    public function findByFilter($request)
    {
        if ($request->get('name') && $request->get('name') != 'any') {
            $events = $this->findBy(array('name' => (int)$request->get('name') - 1));
        } else {
            $events = $this->findAll();
        }

        return $events;
    }
}
