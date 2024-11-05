
    <div class="container">
        <h1>Kết quả tìm kiếm cho: "{{ $keyword }}"</h1>

        @if($products->isEmpty())
            <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
            <p>Tìm thấy {{ $products->count() }} sản phẩm phù hợp.</p> <!-- Sử dụng count() -->

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <!-- Thay thế đoạn này nếu không có description -->
                                <p class="card-text">Mô tả không có sẵn.</p> <!-- Hoặc bỏ đi nếu không cần -->
                                <p class="text-success">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                                <a href="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-primary btn-hover">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

