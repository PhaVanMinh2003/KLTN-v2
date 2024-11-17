<?php

namespace Modules\Cart\Repositories;

use App\Models\Cart;
use App\Models\CartItem;

class CartRepository implements ICartRepository
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function getCartByUserId($consumer_id)
{
    // Truy vấn Cart với eager loading cartItems và sản phẩm liên quan
    $query = Cart::with('cartItems.product')
                 ->where('consumer_id', $consumer_id);

    // Kiểm tra câu lệnh SQL để debug
    // Sử dụng toSql() để kiểm tra câu lệnh SQL được thực thi
    // Cùng với get() để xem kết quả của truy vấn nếu cần
    logger($query->toSql()); // In câu lệnh SQL vào log file
    $cart = $query->first(); // Lấy bản ghi đầu tiên

    // Nếu không tìm thấy cart cho consumer_id
    if (!$cart) {
        return response()->json(['message' => 'No cart found for the specified user'], 404);
    }

    // Trả về dữ liệu giỏ hàng
    return $cart;
}




    public function createCart()
    {
        return $this->model->create();
    }

    public function updateCart($cartId, array $data)
    {
        $cart = $this->model->find($cartId);
        if ($cart) {
            $cart->update($data);
        }
        return $cart;
    }

    public function deleteCart($cartId)
    {
        return $this->model->destroy($cartId);
    }
}
