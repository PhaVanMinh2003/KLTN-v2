<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h1 class="text-success">{{ $product->name }}</h1>
            <p>Giá: <strong class="text-danger">{{ number_format($product->price, 0) }} VNĐ</strong></p>
            <p>Số lượng: <strong>{{ $product->quantity }}</strong></p>
            <p>Farmers: <strong>{{ $product->farmer->name }}</strong></p> <!-- Giả sử có quan hệ với Farmer -->

            <!-- Nút thêm vào giỏ hàng, số lượng và nút yêu thích -->
            <div class="d-flex align-items-center mb-4">
                <!-- Thêm vào giỏ hàng -->
                <a href="#" id="add-to-cart" data-product-id="{{ $product->product_id }}" class="btn btn-success me-3">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                </a>

                <!-- Số lượng -->
                <div class="input-group me-3" style="max-width: 140px;">
                    <button id="decrease" class="btn btn-outline-secondary" type="button">-</button>
                    <input id="quantity" type="number" class="form-control text-center" value="1" min="1" max="{{ $product->quantity }}">
                    <button id="increase" class="btn btn-outline-secondary" type="button">+</button>
                </div>

                <!-- Nút yêu thích -->
                <button class="btn btn-outline-danger">
                    <i class="fas fa-heart"></i>
                </button>
            </div>

            <!-- Mô tả sản phẩm -->
            <h5>Mô tả sản phẩm</h5>
            <p>{{ $product->description }}</p> <!-- Giả sử có trường mô tả -->
        </div>
    </div>

    <!-- Đánh giá sản phẩm -->
    <div class="mt-5">
        <h3 class="text-warning">Đánh giá sản phẩm</h3>
        <div class="d-flex align-items-center mb-3">
            <!-- Điểm đánh giá trung bình -->
            <span class="me-3" style="font-size: 24px; color: #FFD700;">4.5</span>
            <!-- Ngôi sao -->
            <div>
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < 4) <!-- 4 ngôi sao đầy -->
                        <i class="fas fa-star text-warning"></i>
                    @else <!-- 1 ngôi sao nửa -->
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @endif
                @endfor
            </div>
            <span class="ms-3">120 đánh giá</span>
        </div>
    </div>

    <!-- Phần bình luận -->
    <div class="mt-5">
        <h3 class="text-info">Bình luận</h3>

        <!-- Form gửi bình luận -->
        <form action="#" method="post" class="mb-4">
            <div class="mb-3">
                <label for="comment" class="form-label">Để lại bình luận của bạn:</label>
                <textarea id="comment" class="form-control" rows="4" placeholder="Viết bình luận của bạn tại đây..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Gửi
            </button>
        </form>

        <!-- Danh sách bình luận tĩnh -->
        <div class="comment">
            <div class="d-flex mb-3">
                <div class="me-3">
                    <img src="https://via.placeholder.com/50" alt="User avatar" class="rounded-circle">
                </div>
                <div>
                    <h6 class="mb-0">Nguyễn Văn A</h6>
                    <small class="text-muted">2 ngày trước</small>
                    <p class="mt-1">Sản phẩm rất chất lượng, giao hàng nhanh chóng!</p>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="me-3">
                    <img src="https://via.placeholder.com/50" alt="User avatar" class="rounded-circle">
                </div>
                <div>
                    <h6 class="mb-0">Lê Thị B</h6>
                    <small class="text-muted">1 tuần trước</small>
                    <p class="mt-1">Hài lòng với sản phẩm, sẽ tiếp tục ủng hộ!</p>
                </div>
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
