<div class="banner">
    <div class="snowfall"></div>
    <div class="banner-content">
        <h2>Khám Phá Thế Giới Sản Phẩm Tươi Ngon</h2>
        <p>Các sản phẩm từ nông trại đến bàn ăn của bạn.</p>
        <a href="#products" class="btn-explore">Khám Phá Ngay</a>
    </div>
</div>

<!-- Thanh hiển thị danh mục -->
<div class="category-bar mt-4">
    <ul class="categories">
        <li><a href="?category=all" class="category-item active">Tất cả</a></li>
        <li><a href="?category=fruits" class="category-item">Trái cây</a></li>
        <li><a href="?category=vegetables" class="category-item">Rau củ</a></li>
        <li><a href="?category=organic" class="category-item">Hữu cơ</a></li>
        <li><a href="?category=dairy" class="category-item">Sữa</a></li>
    </ul>
</div>

<!-- Thanh lọc sản phẩm -->
<div class="filter-bar mt-3">
    <form action="#" method="GET" class="filter-form">
        <div class="row">
            <div class="col-md-3">
                <label for="price-range" class="form-label">Khoảng giá:</label>
                <select name="price-range" id="price-range" class="form-select">
                    <option value="all">Tất cả</option>
                    <option value="under-100">Dưới 100,000 VNĐ</option>
                    <option value="100-500">100,000 - 500,000 VNĐ</option>
                    <option value="over-500">Trên 500,000 VNĐ</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="sort-by" class="form-label">Sắp xếp theo:</label>
                <select name="sort-by" id="sort-by" class="form-select">
                    <option value="latest">Mới nhất</option>
                    <option value="price-asc">Giá tăng dần</option>
                    <option value="price-desc">Giá giảm dần</option>
                    <option value="rating">Đánh giá cao</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="rating" class="form-label">Xếp hạng:</label>
                <select name="rating" id="rating" class="form-select">
                    <option value="all">Tất cả</option>
                    <option value="4-star-up">4 sao trở lên</option>
                    <option value="3-star-up">3 sao trở lên</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Áp dụng</button>
            </div>
        </div>
    </form>
</div>

<!-- Phần danh sách sản phẩm -->
<div class="mt-3 row" id="products">
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
        font-family: 'Roboto', sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }
/* Danh mục */
.category-bar {
    background-color: #ffa500; /* Màu nền cam nổi bật */
    padding: 10px 0;
    border-radius: 8px;
    text-align: center;
}

.categories {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 15px;
}

.category-item {
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.category-item.active,
.category-item:hover {
    background-color: #ff6f00; /* Đổi màu khi active hoặc hover */
    color: #fff;
}

/* Thanh lọc */
.filter-bar {
    background-color: #f9f9f9;
    padding: 15px 20px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.filter-form .form-label {
    font-weight: bold;
    color: #333;
}

.filter-form .form-select {
    border-radius: 8px;
    border: 1px solid #ddd;
    color: #555;
    transition: all 0.3s ease;
}

.filter-form .form-select:focus {
    border-color: #ffa500;
    box-shadow: 0 0 5px rgba(255, 165, 0, 0.5);
}

.filter-form .btn {
    background-color: #ffa500;
    color: #fff;
    font-weight: bold;
    transition: all 0.3s ease;
}

.filter-form .btn:hover {
    background-color: #ff6f00;
}

/* Thiết lập cho tuyết rơi */
.snowfall {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
    z-index: 1; /* Hiển thị tuyết dưới nội dung banner */
}

.banner-content {
    z-index: 2; /* Đảm bảo nội dung banner hiển thị phía trên */
}

.snowflake {
    position: absolute;
    top: 10px; /* Bắt đầu phía trên */
    background-color: #fff;
    width: 8px; /* Kích thước bông tuyết */
    height: 8px;
    border-radius: 50%;
    opacity: 0.9; /* Tăng độ rõ của bông tuyết */
    animation: fall 10s linear infinite;
}

/* Hiệu ứng tuyết rơi */
@keyframes fall {
    0% {
        transform: translateY(-10px);
        opacity: 1;
    }
    100% {
        transform: translateY(120vh);
        opacity: 0.7;
    }
}

/* Hiệu ứng lệch hướng tuyết */
@keyframes drift {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(20px); /* Dao động ngang lớn hơn */
    }
}

/* Thiết lập banner */
.banner {
    background: linear-gradient(135deg, rgba(40, 167, 69, 1) 0%, rgba(0, 123, 255, 1) 100%);
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
    padding: 20px;
    margin-bottom: 30px;
    position: relative; /* Quan trọng để giới hạn hiệu ứng trong banner */
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    border-radius: 15px;
    overflow: hidden; /* Chặn các phần tử thoát ra ngoài vùng banner */
}

.banner-content h2 {
    font-size: 2.5rem;
    font-weight: bold;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
    margin-bottom: 10px;
}

.banner-content p {
    font-size: 1.3rem;
    margin-top: 10px;
    font-weight: 300;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
}

.btn-explore {
    display: inline-block;
    padding: 12px 30px;
    margin-top: 15px;
    font-size: 1.1rem;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 30px;
    text-transform: uppercase;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.btn-explore:hover {
    background-color: #218838;
    transform: scale(1.1);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
}

    /* Thiết kế card sản phẩm */
    .product-card {
        border: none; /* Bỏ viền card */
        border-radius: 10px; /* Bo tròn góc cho card */
        overflow: hidden; /* Ẩn phần thừa */
        background: #fff; /* Nền trắng cho card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng cho card */
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.05);
        cursor: pointer;
        background-color: #FFA500;
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
    (function createSnowflakes() {
    const snowContainer = document.querySelector('.banner .snowfall'); // Chỉ chọn container tuyết trong banner
    const snowflakesCount = 50; // Số lượng tuyết trong banner

    for (let i = 0; i < snowflakesCount; i++) {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');

        // Kích thước ngẫu nhiên cho bông tuyết
        const size = Math.random() * 10 + 5;
        snowflake.style.width = `${size}px`;
        snowflake.style.height = `${size}px`;

        // Vị trí bắt đầu ngẫu nhiên trong banner
        snowflake.style.left = `${Math.random() * 100}%`; // Trong giới hạn chiều ngang banner
        snowflake.style.animationDuration = `${Math.random() * 5 + 5}s`; // Tốc độ rơi ngẫu nhiên
        snowflake.style.animationDelay = `${Math.random() * 3}s`; // Độ trễ ngẫu nhiên

        // Thêm bông tuyết vào container
        snowContainer.appendChild(snowflake);
    }
})();
    </script>
