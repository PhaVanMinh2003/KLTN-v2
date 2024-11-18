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
    <!-- Thêm vào giỏ hàng -->
    <a href="#" id="add-to-cart" data-product-id="{{ $product->product_id }}" class="btn btn-success me-3">Thêm vào giỏ hàng</a>

    <!-- Số lượng -->
    <div class="input-group me-3" style="max-width: 120px;">
        <button id="decrease" class="btn btn-outline-secondary" type="button">-</button>
        <input id="quantity" type="number" class="form-control text-center" value="1" min="1" max="{{ $product->quantity }}">
        <button id="increase" class="btn btn-outline-secondary" type="button">+</button>
    </div>

    <!-- Nút yêu thích -->
    <button class="btn btn-outline-danger">
        <i class="fas fa-heart"></i>
    </button>
</div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-to-cart').addEventListener('click', function(e) {
        e.preventDefault();

        var productId = this.getAttribute('data-product-id');
        var quantity = document.getElementById('quantity').value;
        var price = {{ $product->price }};

        axios.post('/cart/add', {
            product_id: productId,
            quantity: quantity,
            price: price,
            _token: '{{ csrf_token() }}'
        })
        .then((response) => {
            alert(response.data.message);
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!');
        });
    });

    document.getElementById('increase').addEventListener('click', function() {
        var quantity = document.getElementById('quantity');
        if (parseInt(quantity.value) < quantity.max) {
            quantity.value = parseInt(quantity.value) + 1;
        }
    });

    document.getElementById('decrease').addEventListener('click', function() {
        var quantity = document.getElementById('quantity');
        if (parseInt(quantity.value) > 1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    });
</script>

