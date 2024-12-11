<?php
namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\ICartService;
use App\Models\Product;
class CartAddItemController extends Controller
{
    protected $cartService;

    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        if (!$price) {
            $product = Product::findOrFail($productId);
            $price = $product->price;
        }
        $cartItem = $this->cartService->addProductToCart($productId, $quantity, $price);

        return response()->json([
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
            'cartItem' => $cartItem,
        ]);
    }

}
