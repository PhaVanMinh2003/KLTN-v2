<?php

namespace Modules\Cart\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
class CartController extends Controller
{
    protected $cartService;

    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        $cart = $this->cartService->getCart(auth()->id());
        if (!$cart) {
            Log::info('Giỏ hàng trống cho người dùng ID: ' . auth()->id());
            return view('cart::index', ['message' => 'Giỏ hàng của bạn hiện tại trống!']);
        }

        Log::info('Giỏ hàng của người dùng ID: ' . auth()->id() . ' đã được lấy thành công.');

        // Truyền cartId vào view
        $cartId = $cart->id;

        return view('cart::index', compact('cart', 'cartId'));
    }

    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            Log::info('Cập nhật số lượng sản phẩm cho người dùng ID: ' . auth()->id() . ', Item ID: ' . $itemId . ', Số lượng: ' . $validated['quantity']);
            $this->cartService->updateCartItemQuantity($itemId, $validated['quantity']);
            return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật giỏ hàng cho người dùng ID: ' . auth()->id() . '. Lỗi: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }


    public function clear(Request $request)
    {
        try {
            $userId = auth()->id();
            Log::info('Xóa giỏ hàng của người dùng ID: ' . $userId);
            $isCleared = $this->cartService->clearCart($userId);

            if ($isCleared) {
                return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được xóa.');
            } else {
                return redirect()->route('cart.index')->with('error', 'Không thể xóa giỏ hàng.');
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa giỏ hàng cho người dùng ID: ' . auth()->id() . '. Lỗi: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }


public function removeItem(Request $request, $cartItemId)
{
    try {
        Log::info('Xóa sản phẩm khỏi giỏ hàng, cartItemId: ' . $cartItemId);
        $isRemoved = $this->cartService->removeItem($cartItemId);

        if ($isRemoved) {
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Không thể xóa sản phẩm.');
        }
    } catch (\Exception $e) {
        Log::error('Lỗi khi xóa sản phẩm khỏi giỏ hàng. Lỗi: ' . $e->getMessage());
        return redirect()->route('cart.index')->with('error', $e->getMessage());
    }
}

public function applyDiscount(Request $request, $cartId)
{
    $request->validate([
        'discount_code' => 'required|string|max:255',
    ]);

    $discountCode = $request->input('discount_code');

    try {
        Log::info('Áp dụng mã giảm giá cho giỏ hàng ID: ' . $cartId . ', Mã giảm giá: ' . $discountCode);
        $discountedTotal = $this->cartService->applyDiscount($cartId, $discountCode);

        if ($discountedTotal === null) {
            return redirect()->route('cart.index')->with('error', 'Mã giảm giá không hợp lệ hoặc không thể áp dụng.');
        }

        return redirect()->route('cart.index')->with('success', 'Mã giảm giá đã được áp dụng. Tổng cộng sau giảm giá là: ' . number_format($discountedTotal, 0, ',', '.') . ' VND');
    } catch (\Exception $e) {
        Log::error('Lỗi khi áp dụng mã giảm giá cho giỏ hàng ID: ' . $cartId . '. Lỗi: ' . $e->getMessage());
        return redirect()->route('cart.index')->with('error', $e->getMessage());
    }
}

}
