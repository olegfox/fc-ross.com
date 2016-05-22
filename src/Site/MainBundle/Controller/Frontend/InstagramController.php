<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class InstagramController extends Controller
{
    /**
     * Сканирование фото в группе инстаграм
     *
     * @return Response
     */
    public function scanAction()
    {
        $this->get('instagram')->scanUserMedia(1409047006, 19);

        return new Response('', 200);
    }
}
