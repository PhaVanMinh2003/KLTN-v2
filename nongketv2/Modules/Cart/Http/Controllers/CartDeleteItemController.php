<?php

namespace Modules\Cart\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
use Illuminate\Support\Facades\Response;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;



class CartDeleteItemController extends Controller
{
    public function removeItem($itemId)
{
    try {
        // Lấy giỏ hàng của người tiêu dùng (consumer) dựa trên consumer_id thay vì user_id
        $cart = Cart::where('consumer_id', auth()->id())->first();  // auth()->id() lấy ID người tiêu dùng hiện tại

        // Kiểm tra nếu giỏ hàng không tồn tại
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại'], 404);
        }

        // Tìm sản phẩm trong giỏ hàng
        $item = $cart->cartItems()->find($itemId);

        // Kiểm tra nếu sản phẩm không tồn tại trong giỏ hàng
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $item->delete();

        // Lấy lại danh sách sản phẩm trong giỏ hàng sau khi xóa
        $cartItems = $cart->cartItems;

        // Tính toán lại subtotal (tổng tiền các sản phẩm trong giỏ hàng)
        $subtotal = $cartItems->sum(fn ($item) => $item->price * $item->quantity);

        // Lấy giá trị giảm giá (nếu có)
        $discount = $cart->discount_amount ?? 0;

        // Tính toán tổng giá trị giỏ hàng sau giảm giá
        $total = $subtotal - $discount;

        // Trả về thông tin sau khi xóa sản phẩm
        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng',
            'subtotal' => number_format($subtotal, 0, ',', '.') . ' đ',
            'total' => number_format($total, 0, ',', '.') . ' đ',
            'cartItemsCount' => $cartItems->count(), // Cập nhật số lượng sản phẩm trong giỏ hàng
        ]);
    } catch (\Exception $e) {
        // Nếu có lỗi xảy ra, trả về thông báo lỗi
        return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
    }
}

}


