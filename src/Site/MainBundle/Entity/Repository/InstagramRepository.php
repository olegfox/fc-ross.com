<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * InstagramRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InstagramRepository extends EntityRepository
{
    /**
     * Поиск всех фоток
     */
    public function findAllArray(){
        $all = $this->findAll();
        $media = array();
        $i = 0;

        foreach ($all as $item) {
            $media[$i]['id'] = $item->getId();
            $media[$i]['low_image_url'] = $item->getLowImageUrl();
            $media[$i]['standard_image_url'] = $item->getStandardImageUrl();
            $media[$i]['thumbnail_url'] = $item->getThumbnailUrl();
            $media[$i]['caption_text'] = $item->getCaptionText();
            $i++;
        }

        return $media;
    }

    public function findAllColumn(){
        $all = $this->findAll();
        $column = array();
        $i = 0;

        foreach($all as $key => $item){
            $column[$i][] = $item;
            if($key % 3 == 0){
                $i++;
            }
        }

        return $column;
    }
}
