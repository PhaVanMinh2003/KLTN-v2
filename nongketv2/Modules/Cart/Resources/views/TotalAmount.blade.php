<div class="card custom-card">
    <div class="card-body">
        <form action="{{ route('cart.applyDiscountCode') }}" method="POST" id="discountForm">
            @csrf <!-- CSRF token để bảo vệ bảo mật -->
            <input type="text" class="form-control mb-3" name="discount_code" id="discount_code" placeholder="Nhập mã giảm giá">
            <button type="submit" class="btn custom-button">Áp Dụng</button>
        </form>
    </div>
</div>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const discountForm = document.getElementById('discountForm');
    const discountCodeInput = document.getElementById('discount_code');
    const discountAmountElement = document.getElementById('discountAmount');
    const finalTotalElement = document.getElementById('finalTotal');
    const totalPriceElement = document.getElementById('totalPrice');
    const shippingFee = 30000; // Phí vận chuyển cố định

    // Tổng cộng ban đầu
    const initialTotal = {{ $cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) }};

    discountForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn chặn hành động submit mặc định

        const discountCode = discountCodeInput.value.trim();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(discountForm.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ discount_code: discountCode }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const discountAmount = parseInt(data.discount_amount, 10) || 0;
                    const finalTotal = initialTotal + shippingFee - discountAmount;

                    // Cập nhật giao diện
                    discountAmountElement.innerText = discountAmount > 0
                        ? `-${discountAmount.toLocaleString()}₫`
                        : '0₫';
                    finalTotalElement.innerText = `${finalTotal.toLocaleString()}₫`;

                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi, vui lòng thử lại.');
            });
    });
});
</script>
