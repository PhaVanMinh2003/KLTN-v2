<?php

namespace Modules\Products\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Repositories\ProductRepositoriesInterface;
use App\Models\ProductType;
use App\Models\Product;
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
        $farmerId = auth()->user()->id ?? null;

        return view('products::index', compact('productTypes', 'farmerId'));
    }

public function store(Request $request)
{
    // Ghi log dữ liệu yêu cầu ban đầu
    Log::info('Dữ liệu nhận từ request:', $request->all());

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

    // Ghi log dữ liệu sau khi xác thực
    Log::info('Dữ liệu sau khi xác thực:', $data);

    if ($request->hasFile('image')) {
        // Lấy tên tệp
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();  // Tạo tên tệp duy nhất

        // Di chuyển tệp vào thư mục public/uploads/products
        $image->move(public_path('uploads/products'), $imageName);

        // Đặt đường dẫn ảnh vào cơ sở dữ liệu
        $data['image_url'] = 'uploads/products/' . $imageName; // Đường dẫn tương đối đến ảnh trong public

        // Ghi log đường dẫn ảnh
        Log::info('Đường dẫn ảnh được upload:', ['image_url' => $data['image_url']]);
    }



    // Tạo sản phẩm mới
    Product::create($data);

    // Ghi log thông báo khi tạo thành công
    Log::info('Sản phẩm đã được tạo:', $data);

    // Chuyển hướng về danh sách sản phẩm với thông báo thành công
    return redirect()->route('productlist')->with('success', 'Sản phẩm đã được thêm thành công!');
}

}
