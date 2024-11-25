<?php

namespace Modules\Cart\Repositories;
use Illuminate\Support\Facades\Log;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCode;

class CartRepository implements ICartRepository
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }
    public function getCartByUserId($consumer_id)
    {
        $query = Cart::with('cartItems.product')
                    ->where('consumer_id', $consumer_id);
        logger($query->toSql());

        $cart = $query->first();

        if (!$cart) {
            return response()->json(['message' => 'No cart found for the specified user'], 404);
        }
        // Kiểm tra và giới hạn số lượng sản phẩm theo tồn kho
        foreach ($cart->cartItems as $cartItem) {
            $availableStock = $cartItem->product->quantity;

            // Nếu số lượng trong giỏ hàng lớn hơn tồn kho, giới hạn lại
            if ($cartItem->quantity > $availableStock) {
                $cartItem->quantity = $availableStock;
            }
        }

        return $cart;
    }
    public function applyDiscount($cartId, $discountCode)
    {
        $discount = DiscountCode::where('code', $discountCode)->first();

        if (!$discount) {
            Log::info('Discount code not found', ['cartId' => $cartId, 'discountCode' => $discountCode]);
            return null;
        }

        $cart = Cart::find($cartId);
        if (!$cart) {
            Log::info('Cart not found', ['cartId' => $cartId]);
            return null;
        }

        $totalAmount = $cart->cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $discountAmount = $totalAmount * ($discount->percentage / 100);
        $discountedTotal = $totalAmount - $discountAmount;

        $cart->update(['discount_code' => $discountCode, 'discount_amount' => $discountAmount]);

        Log::info('Discount applied', [
            'cartId' => $cartId,
            'discountCode' => $discountCode,
            'totalAmount' => $totalAmount,
            'discountAmount' => $discountAmount,
            'discountedTotal' => $discountedTotal
        ]);

        return $discountedTotal;
    }
    public function removeItem($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            Log::info('Cart item removed', ['cartItemId' => $cartItemId]);
        } else {
            Log::info('Cart item not found', ['cartItemId' => $cartItemId]);
        }

        return $cartItem;
    }
    public function updateItemQuantity($cartItemId, $quantity, $price)
    {
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->price = $quantity * $price;
            $cartItem->save();
        }

    return $cartItem;
}
    public function clearCart($userId)
    {
        $cart = Cart::where('consumer_id', $userId)->first();

        if ($cart) {
            $cart->cartItems()->delete();
            Log::info('Cart cleared', ['userId' => $userId]);
        } else {
            Log::info('Cart not found for user', ['userId' => $userId]);
        }

        return $cart;
    }
    public function createCart($userId){
        return Cart::create(['consumer_id' =>$userId]);
    }
    public function addItemToCart($cartId,$productId,$quantity,$price){
        return CartItem::create([
            'cart_id'=>$cartId,
            'product_id'=>$productId,
            'quantity'=>$quantity,
            'price'=>$price
        ]);
    }
    public function getCartItem($cartId, $productId)
    {
        return CartItem::where('cart_id', $cartId)->where('product_id', $productId)->first();
    }
    public function updateDiscountCode($cartId, $discountCodeId, $discountAmount)
    {
        // Tìm giỏ hàng và cập nhật thông tin
        $cart = Cart::find($cartId);
        $cart->discount_code_id = $discountCodeId;
        $cart->discount_amount = $discountAmount;
        $cart->final_total = $cart->total_amount - $discountAmount;
        $cart->save();

        return $cart;
    }
}

