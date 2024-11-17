<div class="container my-5">
    <!-- Tiêu đề giỏ hàng -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="custom-orange">Giỏ Hàng Của Bạn</h2>
            <p>Kiểm tra các sản phẩm trong giỏ hàng và thực hiện thanh toán.</p>
        </div>
    </div>

    <!-- Danh sách sản phẩm trong giỏ hàng -->
    <div class="row">
        <div class="col-12">
            <!-- Lặp qua các sản phẩm trong giỏ hàng -->
            @foreach($cart->cartItems as $item)
                <div class="card custom-card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <!-- Hiển thị ảnh sản phẩm -->
                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" alt="Sản phẩm" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <!-- Hiển thị tên và mô tả sản phẩm -->
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="card-text">{{ $item->product->description ?? 'Mô tả sản phẩm chi tiết' }}</p>
                                <a href="#" class="btn btn-outline-danger btn-sm">Xoá</a>
                            </div>
                            <div class="col-md-2">
                                <!-- Số lượng sản phẩm trong giỏ -->
                                <input type="number" class="form-control" value="{{ $item->quantity }}" min="1" max="10">
                            </div>
                            <div class="col-md-2 text-center">
                                <!-- Giá sản phẩm -->
                                <p class="price">{{ number_format($item->price) }}₫</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tổng giá trị giỏ hàng và các thao tác -->
    <div class="row mt-5">
        <div class="col-md-8">
            <!-- Các tùy chọn khác như mã giảm giá -->
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Mã Giảm Giá</h5>
                    <input type="text" class="form-control mb-3" placeholder="Nhập mã giảm giá">
                    <button class="btn custom-button">Áp Dụng</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Thông tin giỏ hàng -->
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title custom-header">Tổng Giỏ Hàng</h5>
                    <div class="row">
                        <div class="col-6">Tổng cộng</div>
                        <div class="col-6 text-right"><span class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; })) }}₫</span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Phí vận chuyển</div>
                        <div class="col-6 text-right"><span class="custom-price">30,000₫</span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Giảm giá</div>
                        <div class="col-6 text-right"><span class="custom-price">-50,000₫</span></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6"><strong>Tổng Cộng</strong></div>
                        <div class="col-6 text-right"><strong class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) + 30000 - 50000) }}₫</strong></div>
                    </div>
                    <a href="#" class="btn custom-button btn-block mt-4">Tiến Hành Thanh Toán</a>
                    <a href="#" class="btn btn-outline-secondary btn-block mt-2">Cập Nhật Giỏ Hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tùy chỉnh màu cam */
    .custom-orange {
        background-color: #FF7A00;
        color: white;
    }

    .custom-button {
        background-color: #FF7A00;
        border-color: #FF7A00;
        color: white;
    }

    .custom-button:hover {
        background-color: #FF5A00;
        border-color: #FF5A00;
        color: white;
    }

    .custom-card {
        border: 1px solid #FF7A00;
        border-radius: 8px;
    }

    .custom-header {
        font-size: 24px;
        font-weight: bold;
    }

    .custom-price {
        color: #FF7A00;
        font-weight: bold;
    }

    .price {
        font-size: 18px;
        font-weight: 600;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .card-title {
        font-size: 18px;
    }
</style>
