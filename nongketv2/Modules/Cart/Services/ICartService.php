<?php

namespace Modules\Cart\Services;

interface ICartService
{
    public function getCart($consumer_id);
    public function createCart();
    public function updateCart($cartId, array $data);
    public function deleteCart($cartId);
}
