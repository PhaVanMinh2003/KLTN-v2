<?php

namespace Modules\Cart\Services;

interface ICartService
{
    public function getCart($consumer_id);
    public function applyDiscount($cartId, $discountCode);
    public function updateCartItemQuantity($cartItemId, $quantity);
    public function removeItem($cartItemId);
    public function clearCart($userId);
    public function addProductToCart($productId, $quantity, $price);
}
