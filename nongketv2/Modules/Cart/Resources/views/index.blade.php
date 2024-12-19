

<style>
.cart-container {
    max-width: 1100px;
    margin: 5px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 2px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.cart-container .cart-icon {
    display: flex;
    align-items: center;
    font-size: 18px;
    color: #333;
}

.cart-container .cart-icon i {
    color: #007bff;
    font-size: 30px;
    margin-right: 10px;
}

.cart-container .cart-summary {
    text-align: right;
    font-size: 14px;
    color: #555;
}

.cart-container .cart-summary .promo {
    font-style: italic;
    color: #f68b1e;
}

.cart-container .cart-header {
    font-weight: bold;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding: 10px 0;
}

.cart-container .cart-item {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
    position: relative;
}

.cart-container .cart-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 15px;
}

.cart-container .product-info {
    font-size: 14px;
    color: #333;
}

.cart-container .product-info p {
    margin: 0;
    font-weight: bold;
}

.cart-container .discount-notice {
    font-size: 12px;
    color: #f68b1e;
    margin-top: 5px;
}

.cart-container .discount-voucher {
    position: absolute;
    top: 10px;
    left: -5px;
    background-color: #f68b1e;
    color: #fff;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 5px 0 0 5px;
    transform: rotate(-10deg);
    z-index: 1;
}

.cart-container .quantity-controls button {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    font-size: 14px;
    color: #333;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    transition: all 0.3s;
}

.cart-container .quantity-controls button:hover {
    background-color: #007bff;
    color: #fff;
}

.cart-container .voucher-info {
    background-color: #fffbe6;
    border: 1px dashed #ffd966;
    border-radius: 5px;
    padding: 10px;
    margin-top: 10px;
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #555;
}

.cart-container .voucher-info i {
    color: orange;
    margin-right: 10px;
    font-size: 18px;
}

.cart-container .cart-summary h3 {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin: 10px 0;
}

.cart-container .cart-summary .total {
    color: #f68b1e;
}

.cart-container .cart-summary button {
    background-color: #28a745;
    color: #fff;
    font-size: 14px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s;
}

.cart-container .cart-summary button:hover {
    background-color: #218838;
}

.cart-container .remove-btn {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 18px;
    cursor: pointer;
}

.cart-container .remove-btn:hover {
    color: #c82333;
}
/* Định dạng chung */
.cart-icon {
    background-color: #f8f9fa; /* Màu nền sáng nhẹ */
    padding: 10px 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.cart-icon i {
    color: #ff6f61; /* Màu cam nổi bật */
    animation: bounce 1s infinite; /* Hiệu ứng nhún nhảy */
}

.cart-icon h1 {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    text-transform: uppercase;
}

/* Hiệu ứng nhún nhảy cho icon */
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

/* Thông tin tóm tắt giỏ hàng */
.cart-summary {
    text-align: right;
    font-size: 16px;
    color: #555;
}

.cart-summary p {
    margin: 0;
    line-height: 1.5;
}

.cart-summary .promo {
    font-weight: bold;
    color: #28a745; /* Màu xanh lá nổi bật */
}

/* Hiệu ứng hover */
.cart-summary p:hover {
    color: #007bff;
    text-decoration: underline;
}
</style>

<div class="container py-5" style="width:1100px; margin-left:5px">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="cart-icon d-flex align-items-center">
                    <i class="fas fa-shopping-cart me-2" style="font-size: 30px;"></i>
                    <h1>Giỏ hàng</h1>
                </div>
                <div class="cart-summary">
                    <p>Hiện có <strong>{{ $cart->cartItems->count() }}</strong> sản phẩm</p>
                    <p class="promo">Miễn phí vận chuyển cho đơn hàng trên 500.000đ!</p>
                </div>
            </div>
            @if ($cart && $cart->cartItems->count())
                <div class="cart-container">
                    <div class="cart-header d-flex justify-content-between">
                        <div class="col-5">Sản phẩm</div>
                        <div class="col-2 text-center">Số lượng</div>
                        <div class="col-2 text-center">Giá</div>
                        <div class="col-2 text-center">Thành tiền</div>
                        <div class="col-1 text-center">Thao tác</div>
                    </div>
                    @foreach ($cart->cartItems as $item)
                        <div class="cart-item mb-3" id="cart-item-{{ $item->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="discount-voucher">
                                    Giảm giá 20%!
                                </div>
                                <div class="col-5 d-flex align-items-center">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                                    <div class="product-info">
                                        <p><strong>{{ $item->product->name }}</strong></p>
                                        @if ($item->product->discount)
                                            <div class="discount-notice">
                                                <strong>Khuyến mãi:</strong> Giảm giá {{ number_format($item->product->discount, 0, ',', '.') }} đ cho sản phẩm này!
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2 text-center quantity-controls">
                                    <button class="btn btn-outline-secondary" onclick="changeQuantity({{ $item->id }}, 'decrease')">-</button>
                                    <span>{{ $item->quantity }}</span>
                                    <button class="btn btn-outline-secondary" onclick="changeQuantity({{ $item->id }}, 'increase')">+</button>
                                </div>
                                <div class="col-2 text-center">{{ number_format($item->price, 0, ',', '.') }} đ</div>
                                <div class="col-2 text-center">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</div>
                                <div class="col-1 text-center">
                                    <button type="button" class="remove-btn" data-item-id="{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> <!-- Icon thùng rác -->
                                    </button>
                                </div>
                            </div>
                            <div class="voucher-info mt-2 p-2 d-flex align-items-center col-12">
                                <i class="fas fa-ticket-alt" style="color: orange; margin-right: 10px;"></i>
                                <span>Miễn phí vận chuyển cho đơn hàng trên 500k</span>
                            </div>
                        </div>
                    @endforeach

                    <div class="cart-summary">
                        <!-- Discount Code Form -->
                        <form action="http://127.0.0.1:8000/cart/apply-discount" method="POST">
                            <input type="hidden" name="_token" value="aaUFoAQfQMyOpSRZ7cDn9LFf4X0eqRXjO1olpqaE">
                            <div class="form-group mb-3">
                                <input type="text" name="discount_code" id="discount_code" class="form-control" placeholder="Nhập mã giảm giá">
                                <button type="submit" class="btn btn-primary mt-2">Áp dụng</button>
                            </div>
                        </form>

                        <h3>Tạm tính: <span id="subtotal">40.000 đ</span></h3>
                        <h3>Giảm giá: 0 đ</h3>
                        <h3 class="total">Tổng: <span id="total">40.000 đ</span></h3>

                        <div class="text-end mt-4">
                            <div class="row justify-content-end">
                                <!-- First Form: VNPAY Payment -->
                                <div class="col-auto">
                                    <form action="{{route('payment.vnpay')}}" method="POST">
                                        @csrf

                                        <input type="hidden" name="order_id" value="{{Str::random(16)}}">
                                        <input type="hidden" name="order_type" value="vnpay">
                                        <input type="hidden" name="total_amount" value="40000">
                                        <button type="submit" class="btn btn-success">Thanh toán VNPAY</button>
                                    </form>
                                </div>

                                <!-- Button to Show SHIPCOD Form -->
                                <div class="col-auto">
                                    <button type="button" class="btn btn-success ship-cod">Thanh toán SHIPCOD</button>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Form for SHIPCOD -->
                        <div id="shipcod-form" class="mt-3" style="display: none;">
                            <form action="{{route('payment.shipCode')}}" method="POST">
                                <input type="hidden" name="_token" value="aaUFoAQfQMyOpSRZ7cDn9LFf4X0eqRXjO1olpqaE">
                                <div class="mb-3">
                                    <label for="receiver_name" class="form-label fs-6 fw-bold">Tên người nhận</label>
                                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="Nhập tên người nhận" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="receiver_phone" class="form-label fs-6 fw-bold">Điện thoại</label>
                                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" placeholder="Số điện thoại người nhận" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="receiver_address" class="form-label fs-6 fw-bold">Địa chỉ</label>
                                    <textarea class="form-control" id="receiver_address" name="receiver_address" rows="3" placeholder="Địa chỉ nhận" required=""></textarea>
                                </div>
                                <button type="button" class="btn btn-success btn-shipcod-submit">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            @else
                <p>Giỏ hàng của bạn đang trống.</p>
            @endif
        </div>
    </div>
</div>
@include('maincontent.payment-success')



