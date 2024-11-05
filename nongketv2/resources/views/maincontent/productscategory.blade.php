<div class="product-categories">
    <h3 class="category-title">Thể loại sản phẩm</h3>
    <div class="row">
        <!-- Trái cây Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-fruit">
                <img src="{{asset('img\saurieng.jpg')}}" class="card-img-top" alt="Trái cây">
                <div class="card-body">
                    <h5 class="card-title">Trái cây</h5>
                    <p class="card-text">Các loại trái cây tươi ngon và bổ dưỡng, mang lại nhiều lợi ích cho sức khỏe.</p>
                    <a href="/categories/fruit" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <!-- Rau củ Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-vegetable">
                <img src="{{asset('img\raucu.jpg')}}" class="card-img-top" alt="Rau củ">
                <div class="card-body">
                    <h5 class="card-title">Rau củ</h5>
                    <p class="card-text">Rau củ tươi xanh, giàu dinh dưỡng, giúp bữa ăn thêm phần lành mạnh.</p>
                    <a href="/categories/vegetables" class="btn btn-success">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <!-- Sản phẩm chế biến Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-processed">
                <img src="{{asset('img\sanpham.jpg')}}" class="card-img-top" alt="Sản phẩm chế biến">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm chế biến</h5>
                    <p class="card-text">Các sản phẩm chế biến sẵn tiện lợi, tiết kiệm thời gian và công sức.</p>
                    <a href="/categories/processed" class="btn btn-warning">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tiêu đề của danh mục sản phẩm */
.category-title {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 30px;
    background: linear-gradient(90deg, #ff6b6b, #28a745, #ffc107);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradient-animation 5s ease-in-out infinite;
    letter-spacing: 2px;
    text-transform: uppercase;
    position: relative;
}

/* Animation của gradient di chuyển */
@keyframes gradient-animation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Đường gạch chân di chuyển từ trái qua phải */
.category-title::after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: -10px;
    width: 0;
    height: 4px;
    background-color: #ff6b6b;
    transition: all 0.5s ease;
}

/* Hiệu ứng khi hover vào tiêu đề */
.category-title:hover::after {
    width: 100%;
    left: 0;
}

.category-title:hover {
    transform: scale(1.1);
    transition: transform 0.3s ease-in-out;
}

.product-categories {
    margin-top: 40px;
    padding: 20px;
    background-color: #f8f9fa;
}

.category-title {
    text-align: center;
    font-size: 28px;
    margin-bottom: 30px;
    font-weight: bold;
    color: #333;
}

.card {
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.card img {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    height: 200px;  /* Điều chỉnh kích thước ảnh lớn hơn */
    object-fit: cover;
}

.card .card-body {
    text-align: center;
}

.card-title {
    font-size: 24px;
    margin-bottom: 15px;
    font-weight: bold;
}

.card-text {
    font-size: 16px;
    margin-bottom: 20px;
    color: #666;
}

.btn {
    font-size: 16px;
    padding: 10px 20px;
}

/* Các kiểu riêng cho từng loại thẻ sản phẩm */
.card-fruit {
    background-color: #fff0f0;
    border: 1px solid #ff6b6b;
}

.card-fruit .btn {
    background-color: #ff6b6b;
    color: #fff;
}

.card-fruit .btn:hover {
    background-color: #ff4d4d;
}

.card-vegetable {
    background-color: #e6ffe6;
    border: 1px solid #28a745;
}

.card-vegetable .btn {
    background-color: #28a745;
    color: #fff;
}

.card-vegetable .btn:hover {
    background-color: #218838;
}

.card-processed {
    background-color: #fffbea;
    border: 1px solid #ffc107;
}

.card-processed .btn {
    background-color: #ffc107;
    color: #fff;
}

.card-processed .btn:hover {
    background-color: #e0a800;
}

</style>
