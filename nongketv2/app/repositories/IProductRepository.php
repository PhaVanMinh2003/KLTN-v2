<?php
namespace App\Repositories;

interface IProductRepository
{
    public function all();
        /*search*/
    public function searchByName(string $keyword, int $limit=null);
        /**/
    public function updateProductQuantity($productId, $quantity);

    public function getFeaturedProducts($limit = 4);

    public function findProductById($id);

}
