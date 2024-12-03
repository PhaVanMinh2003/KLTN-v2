<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            margin: 20px;
            color: white;
            font-size: 32px;
        }
        .cart-container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .cart-header, .cart-summary {
            background-color: #fafafa;
            padding: 10px;
            font-weight: bold;
            display: flex;
        }
        .cart-header div {
            flex: 1;
            text-align: center;
            color: #333;
        }
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        .cart-item div {
            flex: 1;
            text-align: center;
            font-size: 14px;
        }
        .cart-item img {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-controls button {
            background: #ffc107;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .quantity-controls button:hover {
            background: #ffc107;
        }
        .remove-btn {
            background: none;
            color: #ffc107;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .remove-btn:hover {
            color: #ffc107;
        }
        .cart-summary {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding: 20px;
        }
        .cart-summary h3 {
            margin: 10px 0;
        }
        .cart-summary .total {
            font-size: 24px;
            color:#ffc107;
            font-weight: bold;
        }
        .form-group {
            margin: 15px 0;
            display: flex;
            justify-content: flex-end;
        }
        .form-group input {
            width: 200px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #ffc107;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #ffc107;
        }
        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px;
            padding: 10px 20px;
            background-color: #ffc107;
            color: white;
            border-radius: 2px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 1070px;

        }
        .cart-header .cart-icon {
            display: flex;
            align-items: center;
            font-size: 32px;
            color: white;
        }
        .cart-header .cart-icon i {
            margin-right: 10px;
        }
        .cart-header .cart-summary {
            font-size: 16px;
        }
        .cart-header .promo {
            font-size: 14px;
            margin-top: 5px;
            color: #ffccbc;
        }
    </style>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="cart-header">
        <div class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <h1>Giỏ hàng</h1>
        </div>
        <div class="cart-summary">
            <p>Hiện có <strong>{{ $cart->cartItems->count() }}</strong> sản phẩm</p>
            <p class="promo">Miễn phí vận chuyển cho đơn hàng trên 500.000đ!</p>
        </div>
    </div>
    @if ($cart && $cart->cartItems->count())
        <div class="cart-container">
            <!-- Header -->
            <div class="cart-header">
                <div>Sản phẩm</div>
                <div>Số lượng</div>
                <div>Giá</div>
                <div>Thành tiền</div>
                <div>Thao tác</div>
            </div>
            <!-- Items -->
            @foreach ($cart->cartItems as $item)
                <div id="cart-item-{{ $item->id }}" class="cart-item">
                    <div>
                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                        <p>{{ $item->product->name }}</p>
                    </div>
                    <div class="quantity-controls">
                        <button onclick="decreaseQuantity({{ $item->id }})">-</button>
                        <span>{{ $item->quantity }}</span>
                        <button onclick="increaseQuantity({{ $item->id }})">+</button>
                    </div>
                    <div>{{ number_format($item->price, 0, ',', '.') }} đ</div>
                    <div>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</div>
                    <div>
                        <button class="remove-btn" data-id="{{ $item->id }}">Xóa</button>
                    </div>
                </div>
            @endforeach
            <!-- Summary -->
        <div class="cart-summary">
            <form action="{{ route('cart.applyDiscount') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="discount_code" id="discount_code" placeholder="Nhập mã giảm giá">
                    <button type="submit">Áp dụng</button>
                </div>
            </form>
            <h3>Tạm tính: <span id="subtotal">{{ number_format($subtotal, 0, ',', '.') }} đ</span></h3>
            <h3>Giảm giá: {{ number_format($discount, 0, ',', '.') }} đ</h3>
            <h3 class="total">Tổng: <span id="total">{{ number_format($total, 0, ',', '.') }} đ</span></h3>
        </div>
        </div>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif

    <script>
        $(document).on('click', '.remove-btn', function () {
    const itemId = $(this).data('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy token CSRF

    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        $.ajax({
            url: '/cart/item', // URL route xóa sản phẩm
            type: 'DELETE', // Phương thức HTTP DELETE
            data: {
                _token: csrfToken,
                item_id: itemId,
            },
            success: function (response) {
                // Thông báo thành công
                alert(response.success);

                // Xóa sản phẩm khỏi giao diện
                $(`#cart-item-${itemId}`).remove();

                // Cập nhật lại tổng tạm tính và tổng tiền
                $('#subtotal').text(response.subtotal.toLocaleString('vi-VN') + ' đ');
                $('#total').text(response.total.toLocaleString('vi-VN') + ' đ');
            },
            error: function (xhr) {
                alert(xhr.responseJSON.error || 'Đã xảy ra lỗi, vui lòng thử lại.');
            },
        });
    }
});

        function decreaseQuantity(itemId) {
            // Gửi request giảm số lượng
            alert('Giảm số lượng cho sản phẩm ID: ' + itemId);
        }

        function increaseQuantity(itemId) {
            // Gửi request tăng số lượng
            alert('Tăng số lượng cho sản phẩm ID: ' + itemId);
        }

        function removeItem(itemId) {
            // Gửi request xóa sản phẩm
            alert('Xóa sản phẩm ID: ' + itemId);
        }
    </script>
</body>
</html>
