<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Repositories\ProductRepositoriesInterface;
use App\Models\ProductType;
class ProductsController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepositoriesInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $productTypes = ProductType::all();

        return view('products::index', compact('productTypes'));
    }


    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $data = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'product_type_id' => 'required|exists:product_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'origin' => 'nullable|string|max:255',
            'history' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image_url'] = $imagePath;  // Lưu đường dẫn ảnh vào mảng dữ liệu
        }

        $this->productRepository->create($data);

        return redirect()->route('productlist')->with('success', 'Product added successfully!');
    }


}
