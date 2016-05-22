<?php
/**
 * Created by PhpStorm.
 * User: olegfox
 * Date: 27.03.15
 * Time: 15:47
 */

namespace Site\MainBundle\Instagram;


interface InstagramInterface
{
    /**
     * Метод для получения фоток с инстаграма по hashtag
     *
     * @param $hashtag
     *
     * @return array
     */
    public function getMedia($hashtag, $max_id);
} 