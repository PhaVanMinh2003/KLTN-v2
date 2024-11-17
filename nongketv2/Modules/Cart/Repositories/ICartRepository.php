<?php

namespace Modules\Cart\Repositories;

interface ICartRepository
{
    public function getCartByUserId($consumer_id);
    public function createCart();
    public function updateCart($cartId, array $data);
    public function deleteCart($cartId);
}
