<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\FakeProductRepository;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * @var FakeProductRepository
     */
    private $repository;

    public function __construct(FakeProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/products")
     */
    public function listAction()
    {
        $data = [
            'products' => $this->repository->findAll(),
        ];

        return $this->render('products.html.twig', $data);
    }

    /**
     * @Route("/products/{page}")
     */
    public function pagingAction($page)
    {

        $data = [
            'product' => $this->repository->findBy([], [], 1)[0],
        ];

        return $this->render('product.html.twig', $data);
    }

    /**
     * @Route("/product/{id}")
     */
    public function showAction($id)
    {
        $data = [
            'product' => $this->repository->find($id),
        ];

        return $this->render('product.html.twig', $data);
    }

}
