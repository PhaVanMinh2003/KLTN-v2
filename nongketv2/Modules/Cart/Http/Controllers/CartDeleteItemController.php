<?php

namespace Modules\Cart\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
use Illuminate\Support\Facades\Response;
use App\Models\Cart;


class CartDeleteItemController extends Controller
{
    public function removeCartItem($cartItemId)
{
    // Tìm giỏ hàng của người dùng hiện tại
    $cart = Cart::where('user_id', auth()->id())->first();

    if (!$cart) {
        return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại'], 404);
    }

    // Tìm cart item trong giỏ hàng
    $cartItem = $cart->cartItems()->find($cartItemId);

    if (!$cartItem) {
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    $cartItem->delete();

    return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng'], 200);
}


}


