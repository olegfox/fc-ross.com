<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class SliderRepository extends EntityRepository
{
    public function findAll(){
        return $this->findBy(array(), array('date' => 'ASC'));
    }
}
