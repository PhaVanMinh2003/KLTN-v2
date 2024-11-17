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
        return view('cart::index', compact('cart'));
    }


    public function update(Request $request)
    {
        $this->cartService->updateCart($request->cart_id, $request->all());
        return redirect()->route('cart.index');
    }
}
