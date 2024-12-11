<div class="featured-section">
    <h3 class="featured-title">Sản phẩm nổi bật</h3>
</div>
<div class="mt-3 row g-0">
    @foreach ($featuredProducts as $product)
    <div class="col-md-3 mb-3 mt-4">
        <div class="card product-card">
            <div class="img-container">
                <img src="{{ asset($product->image_url) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Giá: {{ number_format($product->price, 2) }} VNĐ</p>
                <a href="#" data-url="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-primary load-content">Xem chi tiết</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
     /* Bao bọc phần tiêu đề với nền */
    .featured-section {
        background-color: #f8f9fa; /* Màu nền nhẹ */
        padding: 20px; /* Khoảng cách xung quanh tiêu đề */
        border-radius: 8px; /* Bo góc để mềm mại */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
        margin-bottom: 20px; /* Khoảng cách với phần bên dưới */
        text-align: center;
    }

    /* Styling cho tiêu đề */
    .featured-title {
        font-size: 24px;
        font-weight: bold;
        color: #ff5733;
        position: relative;
        padding-bottom: 10px;
        margin: 0;
    }

    .featured-title:after {
        content: "";
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 60px;
        height: 3px;
        background-color: #ff5733;
        border-radius: 5px;
    }

    .featured-title:hover {
        text-shadow: 0 0 8px rgba(255, 87, 51, 0.8);
    }
    /* Căn chỉnh tất cả các card có cùng chiều cao */
    .product-card {
        display: flex;
        flex-direction: column;
        height: 100%; /* Đảm bảo card chiếm đầy đủ chiều cao của cột */
        margin: 10px;
    }

    .img-container {
        height: 200px; /* Đặt chiều cao cố định cho ảnh */
        overflow: hidden; /* Ẩn các phần vượt quá khung */
    }

    .img-container img {
        width: 100%; /* Đảm bảo ảnh luôn chiếm đầy đủ chiều ngang */
        height: 100%; /* Đảm bảo ảnh luôn chiếm đầy đủ chiều cao */
        object-fit: cover; /* Cắt ảnh theo kích thước khung mà không bị biến dạng */
    }

    /* Hiệu ứng hover cho ảnh */
    .img-container img {
        transition: transform 0.3s ease; /* Hiệu ứng khi phóng to ảnh */
    }

    .img-container img:hover {
        transform: scale(1.1); /* Phóng to ảnh khi hover */
    }

    /* Hiệu ứng cho nút */
    .btn-hover {
        position: relative;
        overflow: hidden;
        transition: background-color 0.3s ease, transform 0.3s ease; /* Hiệu ứng chuyển màu và phóng to */
    }

    .btn-hover:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300%;
        height: 300%;
        background: rgba(255, 255, 255, 0.5);
        transition: transform 0.5s ease;
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0); /* Bắt đầu với kích thước 0 */
        z-index: 0;
    }

    .btn-hover:hover:before {
        transform: translate(-50%, -50%) scale(1); /* Mở rộng khi hover */
    }

    .btn-hover:hover {
        color: #fff; /* Đổi màu chữ khi hover */
    }

    .btn-hover {
        color: #0d47a1; /* Màu chữ mặc định */
    }

    /* Đảm bảo các cột có cùng kích thước */
    .row.g-0 > .col-md-4 {
        display: flex;
    }

    /* Căn chỉnh các card có cùng chiều cao */
    .product-card {
        flex-grow: 1;
    }
</style>
