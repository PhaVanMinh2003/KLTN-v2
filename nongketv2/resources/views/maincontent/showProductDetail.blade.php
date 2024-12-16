<div class="container mt-5">
    <!-- Phần động: Chi tiết sản phẩm -->
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="product-image">
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <div class="product-info">
                <h1 class="product-title fw-bold">{{ $product->name }}</h1>
                <p class="product-price text-success fs-4">
                    <i class="fas fa-tags me-2"></i> {{ number_format($product->price, 2) }} VNĐ
                </p>
                <p class="product-quantity text-muted">
                    <i class="fas fa-box-open me-2"></i> Số lượng: {{ $product->quantity }}
                </p>
                <p class="product-farmer">
                    <i class="fas fa-user-farmer me-2"></i> Farmers: <strong>{{ $product->farmer->name }}</strong>
                </p>

                <!-- Nút thêm vào giỏ hàng và số lượng -->
                <div class="d-flex align-items-center my-4">
                    <!-- Nút thêm vào giỏ hàng -->
                    <a href="#" id="add-to-cart" data-product-id="{{ $product->product_id }}" class="btn btn-success btn-lg me-3">
                        <i class="fas fa-shopping-cart me-2"></i> Thêm vào giỏ hàng
                    </a>

                    <!-- Điều chỉnh số lượng -->
                    <div class="input-group" style="max-width: 140px;">
                        <button id="decrease" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input id="quantity" type="number" class="form-control text-center" value="1" min="1" max="{{ $product->quantity }}">
                        <button id="increase" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Nút yêu thích -->
                <button class="btn btn-outline-danger btn-lg">
                    <i class="fas fa-heart me-2"></i> Yêu thích
                </button>
            </div>
        </div>
    </div>

    <!-- Phần tĩnh: Đánh giá và bình luận -->
    <div class="row mt-5">
        <!-- Đánh giá sản phẩm -->
        <div class="col-md-8">
            <h3 class="mb-4"><i class="fas fa-star me-2 text-warning"></i> Đánh giá và bình luận</h3>
            <!-- Một bình luận -->
            <div class="review bg-light p-3 rounded mb-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                    <strong>Nguyễn Văn A</strong>
                </div>
                <p>Sản phẩm chất lượng, giao hàng nhanh.</p>
                <small class="text-muted">Ngày: 2024-12-14</small>
            </div>

            <!-- Một bình luận khác -->
            <div class="review bg-light p-3 rounded mb-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                    <strong>Trần Thị B</strong>
                </div>
                <p>Hàng đúng mô tả, đóng gói cẩn thận. Rất hài lòng!</p>
                <small class="text-muted">Ngày: 2024-12-13</small>
            </div>
        </div>

        <!-- Phần tĩnh: Quảng cáo -->
        <div class="col-md-4">
            <h3 class="mb-4"><i class="fas fa-bullhorn me-2 text-info"></i> Thông tin quảng cáo</h3>
            <!-- Một quảng cáo -->
            <div class="ad mb-3 p-3 bg-white shadow rounded text-center">
                <img src="/images/ads/ad1.jpg" alt="Quảng cáo 1" class="img-fluid mb-2 rounded">
                <p class="text-muted">Giảm giá 10% cho đơn hàng đầu tiên.</p>
            </div>
            <!-- Quảng cáo khác -->
            <div class="ad mb-3 p-3 bg-white shadow rounded text-center">
                <img src="/images/ads/ad2.jpg" alt="Quảng cáo 2" class="img-fluid mb-2 rounded">
                <p class="text-muted">Miễn phí vận chuyển toàn quốc trong tháng này.</p>
            </div>
        </div>
    </div>
</div>

<script>
   document.getElementById('add-to-cart').addEventListener('click', function(e) {
    e.preventDefault();  // Ngừng reload trang khi nhấn nút

    var productId = this.getAttribute('data-product-id');
    var quantity = document.getElementById('quantity').value;
    var price = {{ $product->price }};  // Truyền giá sản phẩm từ backend vào JavaScript

    // Tính tổng giá
    var totalPrice = price * quantity;

    // Gửi yêu cầu AJAX để thêm vào giỏ hàng
    axios.post('/cart/add', {
        product_id: productId,
        quantity: quantity,
        price: price,  // Truyền giá từ frontend nếu cần
        total_price: totalPrice,  // Truyền tổng giá vào giỏ hàng
        _token: '{{ csrf_token() }}'  // CSRF Token
    })
    .then((response) => {
        alert(response.data.message);  // Hiển thị thông báo thành công
        // Bạn có thể cập nhật giỏ hàng trên giao diện nếu cần
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!');
    });
});

// Tăng số lượng sản phẩm
document.getElementById('increase').addEventListener('click', function() {
    var quantity = document.getElementById('quantity');
    var price = {{ $product->price }};  // Truyền giá sản phẩm từ backend vào JavaScript

    if (parseInt(quantity.value) < quantity.max) {
        quantity.value = parseInt(quantity.value) + 1;
        var totalPrice = price * quantity.value;  // Tính tổng giá lại sau khi thay đổi số lượng
        document.getElementById('total-price').textContent = totalPrice;  // Hiển thị tổng giá
    }
});

// Giảm số lượng sản phẩm
document.getElementById('decrease').addEventListener('click', function() {
    var quantity = document.getElementById('quantity');
    var price = {{ $product->price }};  // Truyền giá sản phẩm từ backend vào JavaScript

    if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;
        var totalPrice = price * quantity.value;  // Tính tổng giá lại sau khi thay đổi số lượng
        document.getElementById('total-price').textContent = totalPrice;  // Hiển thị tổng giá
    }
});


</script>
