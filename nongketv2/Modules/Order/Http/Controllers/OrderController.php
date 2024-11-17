<?php
namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    // Hàm hiển thị trang nhập thông tin đơn hàng
    public function createOrder()
    {
        // Giả sử bạn có một phương thức lấy các sản phẩm trong giỏ hàng
        $cartItems = Cart::all(); // Hoặc lấy từ session nếu giỏ hàng lưu trong session
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        }); // Tổng tiền trong giỏ
        $shippingFee = 50000; // Phí vận chuyển mặc định

        return view('order::index', compact('cartItems', 'totalAmount', 'shippingFee'));
    }

    public function storeOrder(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
        ]);

        // Lấy các sản phẩm trong giỏ hàng
        $cartItems = Cart::all(); // Hoặc lấy từ session nếu giỏ hàng lưu trong session

        // Tính toán tổng giá trị đơn hàng
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Phí vận chuyển
        $shippingFee = 50000; // Có thể thay đổi tùy theo phương thức vận chuyển

        // Tính tổng số tiền đơn hàng (bao gồm phí vận chuyển)
        $finalAmount = $totalAmount + $shippingFee;

        // Tạo đơn hàng
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'shipping_method' => $request->shipping_method,
            'total_amount' => $finalAmount,
            'status' => 'pending', // Trạng thái mặc định
        ]);

        // Thêm các sản phẩm vào OrderItems
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đặt hàng
        Cart::truncate(); // Hoặc session()->forget('cart') nếu bạn dùng session để lưu trữ giỏ hàng

        // Chuyển hướng đến trang thành công
        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }

    // Trang thành công
    public function success()
    {
        return view('order::success');
    }
}
