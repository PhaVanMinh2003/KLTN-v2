<?php
namespace App\Services;

interface IProductService
{
    public function getAllProducts();
    public function search($keyword);
    public function autocomplete($keyword);

    public function updateProductQuantity($productId, $quantity);

    public function getFeaturedProducts($limit = 4);
    public function getProductDetail($id);
}
