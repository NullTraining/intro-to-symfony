<?php

namespace App\Repository;

use App\Entity\Product;

class FakeProductRepository
{

    private $products;

    public function __construct()
    {
        $product1 = new Product();
        $product1->setId(1);
        $product1->setTitle('Mac Book Air');

        $product2 = new Product();
        $product2->setId(2);
        $product2->setTitle('Getriba');

        $this->products = [
            $product1,
            $product2,
        ];
    }

    public function findAll()
    {
        return $this->products;

    }

    public function find($id)
    {

        foreach ($this->products as $product) {
            if ($product->getId() == $id) {
                return $product;
            }
        }
        die('IN PAIN!');
    }

    public function findBy($filter, $sortBy, $limit) : array
    {
        $data = [];

        foreach ($this->products as $key => $product) {
            if ($limit == $key) {
                break;
            }
            $data[] = $product;
        }

        return $data;

    }
}