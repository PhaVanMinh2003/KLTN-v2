<?php

namespace App\Http\Controllers;
use App\Services\IProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productService;
    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('app', compact('products'))->with('homeContent', $this->homeContent()->render());
    }
    public function homeContent()
{
    $products = $this->productService->getAllProducts();
    $featuredProducts = $this->productService->getFeaturedProducts();
    return view('home', compact('products', 'featuredProducts'));
}

    public function productlist()
    {
        $products = $this->productService->getAllProducts();
        return view('maincontent.productlist', compact('products'));
    }

    public function updateProductQuantity(Request $request)
    {
        $productId = $request->product_id;
        $newQuantity = $request->quantity;

        // Cập nhật số lượng thông qua ProductService
        $product = $this->productService->updateProductQuantity($productId, $newQuantity);

        // Trả về số lượng mới để cập nhật giao diện
        return response()->json(['new_quantity' => $product ? $product->quantity : null]);
    }

    public function FeaturedProducts()
    {
        $featuredProducts = $this->productService->getFeaturedProducts();
        $homeContent = view('home', compact('featuredProducts'))->render();
        return view('app', ['homeContent' => $homeContent]);
    }

    public function showProductDetail($product_id)
    {
        $product = $this->productService->getProductDetail($product_id);
        return view('maincontent.showProductDetail', compact('product'));
    }
    public function search(Request $request)
{
    $keyword = $request->input('query');

    // Giả sử bạn có một service để lấy sản phẩm
    $products = $this->productService->search($keyword);

    // Nếu là AJAX request, trả về view tổng quát
    if ($request->ajax()) {
        return view('maincontent.search_results', ['products' => $products, 'keyword' => $keyword]);
    }

    // Ngược lại, trả về view tổng quát
    return view('maincontent.search_results', ['products' => $products, 'keyword' => $keyword]);
}

    public function autocomplete(Request $request)
    {
        $keyword = $request->input('query');

        if ($request->ajax() && $keyword) {
            $products = $this->productService->autocomplete($keyword);
            return response()->json($products);
        }
    }
}
