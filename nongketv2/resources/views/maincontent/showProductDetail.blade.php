<!-- resources/views/user/products/show.blade.php -->
<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="{{ asset($product->image_url)}}" alt="{{ $product->name }}" class="img-fluid">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>Giá: <strong>{{ number_format($product->price, 2) }} VNĐ</strong></p>
            <p>Số lượng: {{ $product->quantity }}</p>
            <p>Farmers: {{ $product->farmer->name }}</p> <!-- Giả sử có quan hệ với Farmer -->

            <!-- Nút thêm vào giỏ hàng, số lượng và tym -->
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="btn btn-success me-3">Thêm vào giỏ hàng</a>

                <div class="input-group me-3" style="max-width: 120px;">
                    <button class="btn btn-outline-secondary" type="button">-</button>
                    <input type="text" class="form-control text-center" value="1">
                    <button class="btn btn-outline-secondary" type="button">+</button>
                </div>

                <button class="btn btn-outline-danger">
                    <i class="fas fa-heart"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Thông tin thêm về sản phẩm: Nguồn gốc, Lịch sử, Đánh giá -->
    <div class="mt-5">
        <h3>Thông tin sản phẩm</h3>
        <div class="accordion" id="productInfoAccordion">
            <!-- Nguồn gốc -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOrigin">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrigin" aria-expanded="true" aria-controls="collapseOrigin">
                        Nguồn gốc
                    </button>
                </h2>
                <div id="collapseOrigin" class="accordion-collapse collapse show" aria-labelledby="headingOrigin" data-bs-parent="#productInfoAccordion">
                    <div class="accordion-body">
                        Sản phẩm này được trồng tại vùng núi Tây Bắc Việt Nam, nơi có khí hậu mát mẻ và đất đai màu mỡ. Quy trình chăm sóc và thu hoạch đảm bảo không sử dụng hóa chất độc hại.
                    </div>
                </div>
            </div>

            <!-- Lịch sử -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHistory">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory">
                        Lịch sử
                    </button>
                </h2>
                <div id="collapseHistory" class="accordion-collapse collapse" aria-labelledby="headingHistory" data-bs-parent="#productInfoAccordion">
                    <div class="accordion-body">
                        Sản phẩm này đã có mặt trên thị trường từ năm 2015 và luôn được khách hàng tin dùng nhờ vào chất lượng vượt trội và nguồn gốc rõ ràng.
                    </div>
                </div>
            </div>

            <!-- Đánh giá -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingReviews">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReviews" aria-expanded="false" aria-controls="collapseReviews">
                        Đánh giá
                    </button>
                </h2>
                <div id="collapseReviews" class="accordion-collapse collapse" aria-labelledby="headingReviews" data-bs-parent="#productInfoAccordion">
                    <div class="accordion-body">
                        <p><strong>Nguyễn Văn A:</strong> Sản phẩm rất tốt, tôi đã sử dụng trong nhiều năm và luôn hài lòng với chất lượng.</p>
                        <p><strong>Lê Thị B:</strong> Sản phẩm có nguồn gốc rõ ràng và rất an toàn. Tôi sẽ tiếp tục ủng hộ.</p>
                        <p><strong>Trần Văn C:</strong> Giao hàng nhanh, đóng gói cẩn thận. Chất lượng sản phẩm đúng như mô tả.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateQuantity(change) {
        var currentQuantity = parseInt($('#quantity-input').val());
        var newQuantity = currentQuantity + change;

        if (newQuantity >= 1) {
            $('#quantity-input').val(newQuantity);
            // Gửi AJAX để cập nhật số lượng trên server
            $.ajax({
                url: '/update-product', // URL route xử lý ở Laravel
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: '{{ $product->id }}',
                    quantity: newQuantity
                },
                success: function(response) {
                    // Cập nhật thông tin sản phẩm
                    $('#product-quantity').text(response.new_quantity);
                }
            });
        }
    }
</script>

