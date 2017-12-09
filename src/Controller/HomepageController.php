<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomepageController
{

    public function indexAction()
    {
        return new JsonResponse(['id' => 1, 'name' => 'John']);
    }

    /**
     * @Route("/hello/{name}/{days}",requirements={"days":"\d+"})
     */
    public function helloAction(int $days, $name)
    {
        return new Response('Hello '.$name.', we have not seen you for '.$days.' days!');
    }
}