
<div class="container my-5">
    <!-- Tiêu đề giỏ hàng -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="custom-orange">Giỏ Hàng Của Bạn</h2>
            <p>Kiểm tra các sản phẩm trong giỏ hàng và thực hiện thanh toán.</p>
            <button class="btn btn-danger" onclick="confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?') && document.getElementById('clear-cart-form').submit();">
                Xóa Toàn Bộ Giỏ Hàng
            </button>
            <form id="clear-cart-form" action="{{ route('cart.clear') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Thông báo -->
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
    @endif

    <!-- Danh sách sản phẩm trong giỏ hàng -->
    <div class="row">
        @foreach($cart->cartItems as $item)
        <div class="col-12 mb-4">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" alt="Sản phẩm" class="img-fluid">
                        </div>
                        <div class="col-md-6">
    <h5 class="card-title">{{ $item->product->name }}</h5>
    <p class="card-text">{{ $item->product->description ?? 'Mô tả sản phẩm chi tiết' }}</p>

    <nForm gửi yêu cầu xóa sản phẩm -->
    <form action="{{ route('cart.removeItem', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">Xoá</button>
    </form>

    @if($item->quantity > $item->product->stock)
        <p class="text-danger mt-2">Sản phẩm này chỉ còn {{ $item->product->stock }} trong kho!</p>
    @endif
</div>

                        <div class="col-md-2">
                            <input type="number" class="form-control" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="price">{{ number_format($item->price) }}₫</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tổng giá trị giỏ hàng và các thao tác -->
<div class="row mt-5">
    <!-- Cột trái: Mã giảm giá -->
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Mã Giảm Giá</h5>
                <form action="{{ route('cart.applyDiscount', ['cartId' => $cartId]) }}" method="POST">
                    @csrf
                    <input type="text" class="form-control mb-3" name="discount_code" placeholder="Nhập mã giảm giá">
                    <button type="submit" class="btn custom-button">Áp Dụng</button>
                </form>
                @if(session('discount_amount'))
                    <p class="text-success mt-2">Đã áp dụng mã giảm giá: -{{ number_format(session('discount_amount')) }}₫</p>
                @endif
            </div>
        </div>
    </div>
</div>


        <!-- Cột phải: Tổng giá trị -->
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title custom-header">Tổng Giỏ Hàng</h5>
                    <div class="row">
                        <div class="col-6">Tổng cộng</div>
                        <div class="col-6 text-right">
                            <span class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; })) }}₫</span>
                        </div>
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
                        <div class="col-6 text-right">
                            <strong class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) + 30000 - 50000) }}₫</strong>
                        </div>
                    </div>
                    <a href="#" class="btn custom-button btn-block mt-4">Tiến Hành Thanh Toán</a>
                    <a href="#" class="btn btn-outline-secondary btn-block mt-2">Cập Nhật Giỏ Hàng</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Nút tiếp tục mua sắm -->
    <div class="row mt-5">
        <div class="col text-left">
            <a href="" class="btn btn-outline-secondary">Tiếp Tục Mua Sắm</a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name^="items"]').forEach(input => {
    input.addEventListener('change', function () {
        const cartItemId = this.name.match(/\d+/)[0]; // Lấy ID của sản phẩm
        const quantity = this.value;

        fetch(`/cart/update/${cartItemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Làm mới trang để cập nhật tổng giá trị
            } else {
                alert(data.error);
            }
        });
    });
});

</script>

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
