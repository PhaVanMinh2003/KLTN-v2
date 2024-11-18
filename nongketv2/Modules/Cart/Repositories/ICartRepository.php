<?php

namespace Modules\Cart\Repositories;

interface ICartRepository
{
    public function getCartByUserId($consumer_id);
    public function applyDiscount($cartId, $discountCode);
    public function updateItemQuantity($cartItemId, $quantity, $price);
    public function removeItem($cartItemId);
    public function clearCart($userId);
    public function createCart($userId);
    public function getCartItem($cartId, $productId);
    public function addItemToCart($cartId,$productId,$quantity,$price);
}
