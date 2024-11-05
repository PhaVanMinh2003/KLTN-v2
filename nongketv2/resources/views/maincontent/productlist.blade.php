<div class="banner">
    <div class="banner-content">
        <h2>Khám Phá Thế Giới Sản Phẩm Tươi Ngon</h2>
        <p>Các sản phẩm từ nông trại đến bàn ăn của bạn.</p>
    </div>
</div>

<div class="mt-3 row">
    @foreach ($products as $product)
    <div class="col-md-3 mb-4 mt-3">
        <div class="card product-card">
            <img src="{{ asset($product->image_url) }}" class="card-img-top img-hover" alt="{{ $product->name }}">
            <div class="card-body text-center">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Giá: <span class="price">{{ number_format($product->price, 0) }} VNĐ</span></p>
                <a href="#" data-url="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-success load-content">Xem chi tiết</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <style>
        /* Phông chữ từ Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif; /* Sử dụng phông chữ mới */
            background-color: #f9f9f9; /* Màu nền nhẹ nhàng */
            color: #333; /* Màu chữ cơ bản */
        }

        /* Thiết kế Banner */
        .banner {
            background: #d6c77a; /* Màu cát vàng sậm hơn */
            height: 150px; /* Chiều cao cho banner */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px; /* Khoảng cách dưới cho banner */
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3); /* Đổ bóng cho banner */
            position: relative; /* Để tạo hiệu ứng 3D */
        }

        .banner:before {
            content: "";
            position: absolute;
            top: 10px; /* Điều chỉnh độ cao bóng */
            left: 10px; /* Điều chỉnh độ rộng bóng */
            right: 0;
            bottom: 0;
            background: inherit; /* Sử dụng màu nền giống banner */
            z-index: -1; /* Để bóng nằm dưới nội dung */
            filter: blur(15px); /* Hiệu ứng làm mờ cho bóng */
            opacity: 0.5; /* Độ trong suốt cho bóng */
        }

        .banner-content h2 {
            font-size: 2.5rem; /* Kích thước chữ tiêu đề trong banner */
            font-weight: bold; /* Đậm tiêu đề */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Hiệu ứng đổ bóng cho chữ */
        }

        .banner-content p {
            font-size: 1.2rem; /* Kích thước chữ mô tả trong banner */
            margin-top: 10px; /* Khoảng cách trên mô tả */
        }

        /* Thiết kế card sản phẩm */
        .product-card {
            border: none; /* Bỏ viền card */
            border-radius: 10px; /* Bo tròn góc cho card */
            overflow: hidden; /* Ẩn phần thừa */
            background: #fff; /* Nền trắng cho card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng cho card */
            transition: transform 0.3s, box-shadow 0.3s; /* Hiệu ứng khi hover */
        }

        .product-card:hover {
            transform: translateY(-5px); /* Dịch lên khi hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Đổ bóng rõ hơn khi hover */
        }

        /* Đảm bảo tất cả các hình ảnh có cùng kích thước */
        .product-card img {
            object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng */
            width: 100%; /* Chiều rộng toàn bộ */
            height: 200px; /* Chiều cao cố định */
            transition: transform 0.3s; /* Hiệu ứng khi hover */
        }

        .product-card img:hover {
            transform: scale(1.05); /* Phóng to hình ảnh khi hover */
        }

        /* Đảm bảo nội dung trong card căn giữa và gọn gàng */
        .card-body {
            text-align: center; /* Căn giữa nội dung */
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 500; /* Tăng độ đậm cho tiêu đề sản phẩm */
            margin-bottom: 10px;
        }

        .price {
            color: #28a745; /* Màu xanh cho giá */
            font-weight: bold; /* Làm nổi bật giá */
        }

        /* Các nút trong card có cùng kích thước */
        .btn-hover {
            position: relative;
            overflow: hidden;
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Hiệu ứng chuyển màu nền và shadow */
            width: 100%; /* Đảm bảo nút chiếm toàn bộ chiều rộng */
            border-radius: 5px; /* Bo tròn góc cho nút */
        }

        .btn-hover:hover {
            color: #fff; /* Đổi màu chữ khi hover */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2); /* Thêm bóng khi hover */
            background-color: #218838; /* Đổi màu nền khi hover */
        }

        /* Đảm bảo bố cục lưới đều đặn */
        .mt-3.row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Khoảng cách đều giữa các phần tử */
        }

        .col-md-3 {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px; /* Khoảng cách dưới giữa các card */
        }
    </style>

    <script>
        // Sử dụng AJAX để tải danh sách sản phẩm
        function loadProducts() {
            $.ajax({
                url: '{{ route("productlist") }}',
                method: 'GET',
                success: function(data) {
                    $('#product-list').html(data);
                },
                error: function(xhr) {
                    console.log("Lỗi khi tải sản phẩm: ", xhr);
                }
            });
        }

        // Tải danh sách sản phẩm khi trang sẵn sàng
        $(document).ready(function() {
            loadProducts();

            // Hiệu ứng cho nút khi click
            $(document).on('click', '.btn-hover', function() {
                $(this).addClass('clicked');
                setTimeout(() => {
                    $(this).removeClass('clicked');
                }, 300);
            });
        });
    </script>

