<?php

namespace Modules\Cart\Services;

use Modules\Cart\Repositories\ICartRepository;
use Modules\Cart\Repositories\IDiscountCodeRepository;
use Illuminate\Support\Facades\Auth;
use Exception;
class CartService implements ICartService
{
    protected $cartRepository;
    protected $discountCodeRepository;

    public function __construct(ICartRepository $cartRepository,IDiscountCodeRepository $discountCodeRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->discountCodeRepository = $discountCodeRepository;
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
    public function updateCartItemQuantity($cartItemId, $quantity,$price)
    {
        // Kiểm tra điều kiện hợp lệ, ví dụ: số lượng phải lớn hơn 0
        if ($quantity <= 0) {
            throw new \Exception('Số lượng phải lớn hơn 0');
        }
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        return $this->cartRepository->updateItemQuantity($cartItemId, $quantity,$price);
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
    public function applyDiscountCode($userId, $discountCode)
    {
        // Tìm giỏ hàng của người dùng hiện tại
        $cart = $this->cartRepository->getCartByUserId($userId);
        if (!$cart) {
            throw new Exception('Cart not found for this user.');
        }

        $discount = $this->discountCodeRepository->findByCode($discountCode);
        if (!$discount) {
            throw new Exception('Invalid or expired discount code.');
        }

        // Kiểm tra điều kiện mã giảm giá (nếu cần)
        $totalAmount = $cart->cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        if ($totalAmount < $discount->min_purchase_amount) {
            throw new Exception('Cart total does not meet the minimum purchase amount for this discount.');
        }

        // Áp dụng mã giảm giá vào giỏ hàng
        $discountAmount = 0;

        if ($discount->discount_type == 'percentage') {
            // Giảm giá theo phần trăm
            $discountAmount = ($discount->discount_value / 100) * $totalAmount;
        } elseif ($discount->discount_type == 'fixed') {
            // Giảm giá theo số tiền cố định
            $discountAmount = $discount->discount_value;
        }

        // Cập nhật giỏ hàng với giá trị giảm giá
        $updatedCart = $this->cartRepository->updateDiscountCode($cart->id, $discount->discount_code_id, $discountAmount);

        return $updatedCart;
    }
}
