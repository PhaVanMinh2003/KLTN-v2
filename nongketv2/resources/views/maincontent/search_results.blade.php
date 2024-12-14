@extends('app')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="custom-container" id="search-results">
    <h1 class="mt-4">
        <i class="bi bi-search"></i> Kết quả tìm kiếm cho: "{{ $keyword }}"
    </h1>

    @if($products->isEmpty())
        <p>Không tìm thấy sản phẩm nào phù hợp.</p>
    @else
        <p>Tìm thấy {{ $products->count() }} sản phẩm phù hợp.</p>

        <!-- Các sản phẩm hiển thị ngang -->
        <div class="products-list d-flex overflow-x-auto mt-3">
            @foreach($products as $product)
                <div class="product-card mr-3">
                    <div class="card shadow-sm border-0 rounded" style="background-color: #f9f7e8;">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top img-fluid rounded" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: #2f6f39;">{{ $product->name }}</h5>
                            <p class="card-text text-center text-success">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                            <div class="d-flex justify-content-center">
                                <a href="#" data-url="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-warning btn-sm text-white load-content">
                                    <i class="bi bi-info-circle"></i> Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Quảng cáo -->
    <div class="advertisement mt-5 text-center">
        <div class="card p-4" style="background-color: #ffeb99; border-radius: 10px;">
            <i class="bi bi-broadcast text-warning" style="font-size: 30px;"></i>
            <h3 class="mt-3" style="color: #2f6f39;">Khám phá các sản phẩm ưu đãi lớn!</h3>
            <p>Nhận ngay giảm giá cho đơn hàng tiếp theo. Tham gia chương trình khuyến mãi của chúng tôi ngay hôm nay!</p>
            <a href="#" class="btn btn-success btn-lg">Xem thêm</a>
        </div>
    </div>
</div>
<style>
/* Đảm bảo CSS chỉ áp dụng trong custom-container */
.custom-container {
    background-color: #f9f7e8; /* Màu vàng nhạt */
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    font-family: 'Roboto', sans-serif;
}

.custom-container:hover {
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

/* Tiêu đề */
.custom-container h1 {
    color: #2f6f39; /* Màu xanh cây */
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
}

.custom-container h1 i {
    color: #2f6f39;
}

/* Thông báo kết quả */
.custom-container p {
    color: #4a4a4a;
    font-size: 18px;
    margin-bottom: 20px;
    font-style: italic;
    text-align: center;
}

/* Card sản phẩm */
.custom-container .product-card {
    flex-shrink: 0;
    width: 250px;
    margin-right: 20px;
}

.custom-container .card {
    background-color: #f9f7e8;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.custom-container .card:hover {
    transform: translateY(-5px);
}

.custom-container .card-title {
    color: #2f6f39;
}

.custom-container .card-text {
    color: #28a745;
}

/* Quảng cáo */
.custom-container .advertisement .card {
    border-radius: 15px;
    background-color: #ffeb99;
    padding: 20px;
}

.custom-container .advertisement .card i {
    color: #f39c12;
}

.custom-container .advertisement .card h3 {
    color: #2f6f39;
}

/* Nút hành động */
.custom-container .btn-warning {
    background-color: #b2760c;
    border: none;
    color: white;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.custom-container .btn-warning:hover {
    background-color: #935c09;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.custom-container .btn-success {
    background-color: #2f6f39;
    border: none;
    color: white;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 25px;
}

.custom-container .btn-success:hover {
    background-color: #235c2e;
}

@media (max-width: 768px) {
    .custom-container {
        padding: 20px;
    }

    .custom-container h1 {
        font-size: 24px;
    }

    .custom-container .card-body {
        padding: 15px;
    }

    .custom-container .products-list {
        flex-wrap: wrap;
        justify-content: center;
    }

    .custom-container .product-card {
        width: 200px;
    }
}
.custom-container {
    background-color: #f9f7e8;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    font-family: 'Roboto', sans-serif;

    &:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    h1 {
        color: #2f6f39;
        font-size: 30px;
        text-align: center;
    }

    .card {
        background-color: #f9f7e8;
        border-radius: 15px;
    }

    .btn-success {
        background-color: #2f6f39;
    }
}


</style>
@endsection
