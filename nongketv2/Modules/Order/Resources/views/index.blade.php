@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Nhập Thông Tin Đơn Hàng</h2>

    {{-- Hiển thị thông báo nếu có --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Đặt Hàng --}}
    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <!-- Thông Tin Cá Nhân -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Thông Tin Người Đặt Hàng</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="address">Địa Chỉ Giao Hàng</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
            </div>
        </div>

        <!-- Giỏ Hàng -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Giỏ Hàng</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td> <!-- Assuming 'product_name' is actually 'product->name' -->
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phương Thức Thanh Toán -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Phương Thức Thanh Toán</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Phương Thức Vận Chuyển -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Phương Thức Vận Chuyển</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" id="shipping_method" name="shipping_method" required>
                        <option value="standard">Vận chuyển tiêu chuẩn (3-5 ngày)</option>
                        <option value="express">Vận chuyển nhanh (1-2 ngày)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tổng Tiền -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Tổng Tiền</h4>
            </div>
            <div class="card-body">
                <p><strong>Tổng Giỏ Hàng: </strong>{{ number_format($totalAmount, 0, ',', '.') }} VND</p>
                <p><strong>Phí Vận Chuyển: </strong>{{ number_format($shippingFee, 0, ',', '.') }} VND</p>
                <p><strong>Tổng Thanh Toán: </strong>{{ number_format($totalAmount + $shippingFee, 0, ',', '.') }} VND</p>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Đặt Hàng</button>
    </form>
</div>
@endsection
