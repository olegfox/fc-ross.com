<?php
/**
 * Created by PhpStorm.
 * User: olegfox
 * Date: 27.03.15
 * Time: 15:51
 */

namespace Site\MainBundle\Instagram;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Site\MainBundle\Entity\Instagram as InstagramEntity;


class Instagram implements InstagramInterface
{
    protected $container;
    protected $em;

    /**
     * @param Container $container
     */
    public function __construct(
        Container $container,
        \Doctrine\ORM\EntityManager $em
    ) {
        $this->container = $container;
        $this->em = $em;
    }

    /**
     * @param $hashtag
     * @param $max_id
     * @return array
     */
    public function getMedia($hashtag, $max_id){

        $api = $this->container->get('instaphp');

        if($max_id > 0){
            $response = $api->Tags->Recent($hashtag, array(
                'max_id' => $max_id
            ));
        }else{
            $response = $api->Tags->Recent($hashtag);
        }


        $media = array();
        $i = 0;

        if (empty($response->error)) {
            foreach ($response->data as $item) {
                $media[$i]['link'] = $item['link'];
                $media[$i]['created_time'] = (new \DateTime())->setTimestamp($item['created_time']);
                $media[$i]['low_image_url'] = $item['images']['low_resolution']['url'];
                $media[$i]['standard_image_url'] = $item['images']['standard_resolution']['url'];
                $media[$i]['thumbnail_url'] = $item['images']['thumbnail']['url'];
                $media[$i]['caption_text'] = empty($item['caption']['text']) ? 'Untitled' : $item['caption']['text'];
                $i++;
            }
            $media['max_id'] = $response->pagination['next_max_id'];
        }

        return $media;
    }

    /**
     * @param $user_id
     * @param $count
     * @return bool
     */
    public function scanUserMedia($user_id, $count){

        $api = $this->container->get('instaphp');

        $max_id = 0;
        $media = array();
        $i = 0;

        if($max_id > 0){
            $response = $api->Users->Recent($user_id, array(
                'max_id' => $max_id,
                'count' => $count
            ));
        }else{
            $response = $api->Users->Recent($user_id, array(
                'count' => $count
            ));
        }

        while(count($response->data) > 0){
            if (empty($response->error)) {
                foreach ($response->data as $item) {
                    $media[$i]['link'] = $item['link'];
                    $media[$i]['created_time'] = (new \DateTime())->setTimestamp($item['created_time']);
                    $media[$i]['low_image_url'] = $item['images']['low_resolution']['url'];
                    $media[$i]['standard_image_url'] = $item['images']['standard_resolution']['url'];
                    $media[$i]['thumbnail_url'] = $item['images']['thumbnail']['url'];
                    $media[$i]['caption_text'] = empty($item['caption']['text']) ? 'Untitled' : $item['caption']['text'];
                    $max_id = $item['id'];
                    $i++;
                }
            }

            if($max_id > 0){
                $response = $api->Users->Recent($user_id, array(
                    'max_id' => $max_id,
                    'count' => $count
                ));
            }else{
                $response = $api->Users->Recent($user_id, array(
                    'count' => $count
                ));
            }
        }

        $em = $this->em;
        $repository = $em->getRepository('SiteMainBundle:Instagram');

        foreach($media as $m){
            if(!is_object($repository->findOneByLink($m['link']))){
                $instagram = new InstagramEntity();

                $instagram->setLink($m['link']);
                $instagram->setCreatedTime($m['created_time']);
                $instagram->setLowImageUrl($m['low_image_url']);
                $instagram->setStandardImageUrl($m['standard_image_url']);
                $instagram->setThumbnailUrl($m['thumbnail_url']);
                $instagram->setCaptionText($m['caption_text']);
                $instagram->setType(1);

                $em->persist($instagram);
                $em->flush();
            }
        }

        return true;
    }
} 