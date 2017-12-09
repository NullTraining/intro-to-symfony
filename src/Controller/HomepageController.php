<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{

    public function indexAction()
    {
        return new JsonResponse(['id' => 1, 'name' => 'John']);
    }

    /**
     * @Route("/hello/{name}/{days}",requirements={"days":"\d+"})
     */
    public function helloAction(Request $request)
    {
        $data = [
            'name'     => $request->get('name'),
            'days'     => $request->get('days'),
            'products' => [
                'bmw'      => [
                    'model'  => '3',
                    'engine' => 'diesel',
                ],
                'mazda'    => [
                    'model'  => '636',
                    'engine' => 'gasoline',
                ],
                'mercedes' => new Car(),
                'mercedes2' => new Car2(),
            ],
        ];

        return $this->render('hello.html.twig', $data);

    }

    /**
     * @Route("/google-analytics-code/{url}")
     */
    public function googleAnalyticsAction($url)
    {
        return $this->render('google-analytics-code.html.twig', ['url' => $url]);
    }
}

class Car
{
    public function getModel()
    {
        return 'C class';
    }

    public function hasEngine()
    {
        return 'diesel';
    }
}

class Car2
{
    public $model = 'C class';
    public $engine = 'diesel';
}