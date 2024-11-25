<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container my-5">
    <div class="row mb-4 text-center">
        @include('cart::title')
    </div>
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
    <div class="row">
        @include('cart::productList')
    </div>
    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-body">
                    <form id="discountForm" action="{{ route('cart.applyDiscountCode') }}" method="POST">
                        @csrf <!-- CSRF token để bảo vệ bảo mật -->
                        <input type="text" class="form-control mb-3" name="discount_code" id="discount_code" placeholder="Nhập mã giảm giá">
                        <button type="submit" class="btn custom-button">Áp Dụng</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title custom-header">Tổng Giỏ Hàng</h5>
                    <div class="row">
                        <div class="col-6">Tổng cộng</div>
                        <div class="col-6 text-right">
                            <span class="custom-price" id="totalPrice">
                                {{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; })) }}₫
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Phí vận chuyển</div>
                        <div class="col-6 text-right"><span class="custom-price" id="shippingFee">30,000₫</span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Giảm giá</div>
                        <div class="col-6 text-right"><span class="custom-price" id="discountAmount">0₫</span></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6"><strong>Tổng Cộng</strong></div>
                        <div class="col-6 text-right">
                            <strong class="custom-price" id="finalTotal">
                                {{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) + 30000) }}₫
                            </strong>
                        </div>
                    </div>
                    <a href="#" class="btn custom-button btn-block mt-4">Tiến Hành Thanh Toán</a>
                    <a href="#" class="btn btn-outline-secondary btn-block mt-2">Cập Nhật Giỏ Hàng</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-left">
            <a href="" class="btn btn-outline-secondary">Tiếp Tục Mua Sắm</a>
        </div>
    </div>
</div>

<script>
    // Lắng nghe sự kiện thay đổi số lượng sản phẩm trong giỏ hàng
    document.querySelectorAll('input[name^="items"]').forEach(input => {
        input.addEventListener('change', function () {
            const cartItemId = this.name.match(/\d+/)[0];
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
                    location.reload(); // Làm mới trang khi cập nhật số lượng
                } else {
                    alert(data.error);
                }
            });
        });
    });

    // Đảm bảo form giảm giá không gửi đi theo cách truyền thống
    $(document).ready(function() {
        $('#discountForm').on('submit', function(e) {
            e.preventDefault(); // Ngừng gửi form truyền thống và làm mới trang

            var discountCode = $('#discount_code').val().trim(); // Lấy giá trị mã giảm giá
            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy CSRF token

            // Kiểm tra nếu mã giảm giá trống
            if (!discountCode) {
                alert("Vui lòng nhập mã giảm giá.");
                return;
            }

            // Gửi yêu cầu AJAX
            $.ajax({
                url: $(this).attr('action'), // URL gửi yêu cầu (từ thuộc tính action của form)
                method: 'POST',
                data: {
                    discount_code: discountCode,
                    _token: csrfToken // Gửi CSRF token
                },
                success: function(data) {
                    if (data.success) {
                        alert(data.message); // Thông báo nếu thành công
                        updateCart(data.discount_amount); // Cập nhật giao diện
                    } else {
                        alert(data.message); // Thông báo lỗi nếu không thành công
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                }
            });
        });

        // Hàm cập nhật giao diện sau khi áp dụng mã giảm giá
        function updateCart(discountAmount) {
            const discountAmountElement = $('#discountAmount');
            const finalTotalElement = $('#finalTotal');
            const initialTotal = {{ $cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) }}; // Tổng tiền ban đầu
            const shippingFee = 30000; // Phí vận chuyển

            // Cập nhật số tiền giảm giá và tổng cộng cuối cùng
            const discount = parseInt(discountAmount, 10) || 0;
            const finalTotal = initialTotal + shippingFee - discount;

            discountAmountElement.text(discount > 0 ? `-${discount.toLocaleString()}₫` : '0₫');
            finalTotalElement.text(`${finalTotal.toLocaleString()}₫`);
        }
    });
</script>


<style>
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
