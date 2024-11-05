<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all()
    {
        return Product::all();
    }
    public function searchByName(string $keyword, int $limit=null){
        $query = Product::where('name', 'LIKE', "%{$keyword}%");

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }


    public function updateProductQuantity($productId, $quantity)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->quantity = $quantity;
            $product->save();
            return $product;
        }
        return null;
    }

    public function getFeaturedProducts($limit = 4)
    {
        return Product::where('quantity', '>', 10)->take($limit)->get();
    }

    public function findProductById($id)
    {
        return Product::findOrFail($id);
    }
}
