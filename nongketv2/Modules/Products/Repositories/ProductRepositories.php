<?php
namespace Modules\Products\Repositories;

use App\Models\Product;

class ProductRepositories implements ProductRepositoriesInterface
{
    /**
     * Lấy tất cả sản phẩm
     */
    public function getAll()
    {
        return Product::with(['productType', 'farmer'])->get();
    }

    /**
     * Tìm sản phẩm theo ID
     */
    public function findById($id)
    {
        return Product::with(['productType', 'farmer'])->findOrFail($id);
    }

    /**
     * Tạo sản phẩm mới
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update($id, array $data)
    {
        $product = $this->findById($id);
        $product->update($data);

        return $product;
    }

    /**
     * Xóa sản phẩm
     */
    public function delete($id)
    {
        $product = $this->findById($id);
        $product->delete();

        return true;
    }
}
