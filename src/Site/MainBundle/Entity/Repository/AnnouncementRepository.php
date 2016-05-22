<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class AnnouncementRepository extends EntityRepository
{

//  Поиск всех анонсов
    public function findAll(){
        $announcements = $this->getEntityManager()->createQuery('
            SELECT a FROM SiteMainBundle:Announcement a
            WHERE a.date >= :now
            ORDER BY a.date DESC
        ')
            ->setParameters(array(
                'now' => new \DateTime()
            ))
            ->getResult();

        return $announcements;
    }

//  Все анонсы за определённый день (анонсы и матчи)
    public function getAnnouncement($date_string){
        $date_begin = $date_string;
        $date_end = date('Y-m-d', strtotime($date_begin . ' + 1 days'));

        $events = $this->getEntityManager()->createQuery('
            SELECT e FROM SiteMainBundle:Event e
            WHERE e.datetime >= :date_begin AND e.datetime < :date_end
        ')
            ->setParameters(array(
                'date_begin' => new \DateTime($date_begin),
                'date_end' => new \DateTime($date_end)
            ))
            ->getResult();

        $announcements = $this->getEntityManager()->createQuery('
            SELECT a FROM SiteMainBundle:Announcement a
            WHERE a.date >= :date_begin AND a.date < :date_end
        ')
            ->setParameters(array(
                'date_begin' => new \DateTime($date_begin),
                'date_end' => new \DateTime($date_end)
            ))
            ->getResult();

        $result = array();

        foreach($events as $event){
            $result[] = $event;
        }

        foreach($announcements as $announcement){
            $result[] = $announcement;
        }

        return $result;
    }

}
