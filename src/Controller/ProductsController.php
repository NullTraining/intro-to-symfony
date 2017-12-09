<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\FakeProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /** @var ProductRepository */
    private $repository;
    /** @var EntityManager */
    private $entityManager;

    public function __construct(ProductRepository $repository,
        EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/products")
     */
    public function listAction()
    {
        $product = new Product();
        $product->setTitle('zzz'.time());

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        $data = [ 'products' => $this->repository->findAll(),];

        return $this->render('products.html.twig', $data);
    }

    /** @Route("/products/{page}") */
    public function pagingAction($page)
    {
        $data = [ 'product' => $this->repository->findBy([], [], 1)[0],];

        return $this->render('product.html.twig', $data);
    }

    /** @Route("/product/{id}") */
    public function showAction($id)
    {
        $data = [ 'product' => $this->repository->find($id),];

        return $this->render('product.html.twig', $data);
    }

}

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
 */

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
 * @ORM\JoinColumn(nullable=true)
 */
