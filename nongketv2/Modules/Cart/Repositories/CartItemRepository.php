<?php

namespace Modules\Cart\Repositories;

use App\Models\CartItem;

class CartItemRepository implements ICartItemRepository
{
    protected $model;

    public function __construct(CartItem $cartItem)
    {
        $this->model = $cartItem;
    }

    public function addItem($cartId, array $data)
    {
        $data['cart_id'] = $cartId;
        return $this->model->create($data);
    }

    public function updateItem($itemId, array $data)
    {
        $item = $this->model->find($itemId);
        if ($item) {
            $item->update($data);
        }
        return $item;
    }

    public function deleteItem($itemId)
    {
        return $this->model->destroy($itemId);
    }
}
