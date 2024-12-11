<?php
namespace App\Services;

use App\Repositories\IProductRepository;

class ProductService implements IProductService
{
    protected $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }
    public function search($keyword)
    {
        return $this->productRepository->searchByName($keyword);
    }

    public function autocomplete($keyword)
    {
        return $this->productRepository->searchByName($keyword, 5);
    }

    public function updateProductQuantity($productId, $quantity)
    {
        return $this->productRepository->updateProductQuantity($productId, $quantity);
    }

    public function getFeaturedProducts($limit = 4)
    {
        return $this->productRepository->getFeaturedProducts($limit);
    }

    public function getProductDetail($id)
    {
        return $this->productRepository->findProductById($id);
    }
}
