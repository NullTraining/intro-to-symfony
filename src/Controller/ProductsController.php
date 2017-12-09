<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\FakeProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController
{
    /** @var ProductRepository */
    private $repository;
    /** @var EntityManager */
    private $entityManager;
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(
        ProductRepository $repository,
        CategoryRepository $categoryRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/products")
     * @Template()
     */
    public function listAction()
    {
        return ['products' => $this->repository->findAll(),];
    }

    /**
     * @Route("/products/{page}")
     * @Template()
     */
    public function pagingAction($page)
    {
        return ['product' => $this->repository->findBy([], [], 1)[0],];
    }

    /**
     * @Route("/product/{id}")
     * @Template()
     */
    public function showAction(Product $product)
    {
        return ['product' => $product];
    }

}
