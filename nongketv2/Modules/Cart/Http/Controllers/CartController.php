<?php

namespace Modules\Cart\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\DiscountCode;
class CartController extends Controller
{
    protected $cartService;

    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        // Giả sử user hiện tại đã đăng nhập
        $user = auth()->user();

        // Lấy giỏ hàng của user
        $cart = Cart::with('cartItems.product')->where('consumer_id', $user->id)->first();

        // Tính tổng tạm tính
        $subtotal = $cart ? $cart->cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        }) : 0;

        // Lấy mã giảm giá từ session
        $discount = session('discount_amount', 0);
        $total = $subtotal - $discount;

        return view('cart::index', compact('cart', 'subtotal', 'discount', 'total'));
    }

    public function applyDiscount(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'discount_code' => 'required|string',
        ]);

        $user = auth()->user();

        // Lấy mã giảm giá từ input
        $code = $request->input('discount_code');

        // Kiểm tra mã giảm giá có tồn tại và hợp lệ
        $discountCode = DiscountCode::where('code', $code)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('status', 1) // Đảm bảo mã giảm giá đang hoạt động
            ->first();

        if (!$discountCode) {
            return redirect()->back()->withErrors(['discount_code' => 'Mã giảm giá không hợp lệ.']);
        }

        // Lưu mã giảm giá vào session
        session([
            'discount_code' => $code,
            'discount_amount' => $discountCode->discount_value,
        ]);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }




















    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            // Retrieve the cart item to get the price
            $cartItem = CartItem::find($itemId);

            // Check if the cart item exists
            if (!$cartItem) {
                throw new \Exception('Không tìm thấy sản phẩm trong giỏ hàng.');
            }

            // Update the cart item quantity
            $this->cartService->updateCartItemQuantity($itemId, $validated['quantity'], $cartItem->price);

            return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');
        } catch (\Exception $e) {
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
    public function applyDiscountCode(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string|exists:discount_codes,code',
        ]);

        $userId = Auth::id();
        $discountCode = $request->input('discount_code');

        try {
            // Áp dụng giảm giá vào giỏ hàng thông qua service
            $updatedCart = $this->cartService->applyDiscountCode($userId, $discountCode);

            // Gửi phản hồi thành công
            return response()->json([
                'success' => true,
                'message' => 'Mã giảm giá đã được áp dụng.',
                'discount_amount' => number_format($updatedCart->discount_amount),
                'cart' => $updatedCart,
            ]);
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về phản hồi lỗi
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
