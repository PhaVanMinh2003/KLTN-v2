<?php

namespace Modules\Cart\Services;

use Modules\Cart\Repositories\ICartRepository;
use Illuminate\Support\Facades\Auth;
class CartService implements ICartService
{
    protected $cartRepository;

    public function __construct(ICartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function getCart($consumer_id)
    {
        return $this->cartRepository->getCartByUserId($consumer_id);
    }
    public function applyDiscount($cartId, $discountCode)
    {
        return $this->cartRepository->applyDiscount($cartId, $discountCode);
    }
    public function removeItem($cartItemId)
    {
        $cartItem = $this->cartRepository->removeItem($cartItemId);
        if ($cartItem) {
            return true;
        }

        return false;
    }
    public function updateCartItemQuantity($cartItemId, $quantity)
    {
        // Kiểm tra điều kiện hợp lệ, ví dụ: số lượng phải lớn hơn 0
        if ($quantity <= 0) {
            throw new \Exception('Số lượng phải lớn hơn 0');
        }
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        return $this->cartRepository->updateItemQuantity($cartItemId, $quantity);
    }
    public function clearCart($userId)
    {
        $cart = $this->cartRepository->clearCart($userId);

        if ($cart) {
            return true;
        }

        return false;
    }
    public function addProductToCart($productId, $quantity, $price)
    {
        $userId = Auth::id();

        $cart = $this->cartRepository->getCartByUserId($userId);
        if (!$cart) {
            $cart = $this->cartRepository->createCart($userId);
        }

        $cartItem = $this->cartRepository->getCartItem($cart->id, $productId);
        if ($cartItem) {
            // Cập nhật số lượng nếu sản phẩm đã có
            $cartItem = $this->cartRepository->updateItemQuantity($cartItem->id, $cartItem->quantity + $quantity,$price);
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cartItem = $this->cartRepository->addItemToCart($cart->id, $productId, $quantity, $price);
        }

        return $cartItem;
    }

}
