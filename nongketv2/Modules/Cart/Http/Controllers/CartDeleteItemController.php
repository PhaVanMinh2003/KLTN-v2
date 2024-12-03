<?php

namespace Modules\Cart\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
use Illuminate\Support\Facades\Response;
use App\Models\Cart;
use App\Models\CartItem;


class CartDeleteItemController extends Controller
{
    public function removeItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer', // Xác thực ID của item
        ]);

        $user = auth()->user();

        // Tìm cart item dựa vào user và item ID
        $cartItem = CartItem::where('id', $request->item_id)
            ->whereHas('cart', function ($query) use ($user) {
                $query->where('consumer_id', $user->id);
            })
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem->delete();

        // Tính lại tổng tạm tính và tổng tiền
        $cart = Cart::with('cartItems')->where('consumer_id', $user->id)->first();
        $subtotal = $cart ? $cart->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        }) : 0;
        $discount = session('discount_amount', 0);
        $total = $subtotal - $discount;

        return response()->json([
            'success' => 'Xóa sản phẩm thành công',
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

}


