<div class="card custom-card">
    <div class="card-body">
        <form id="discountForm" action="{{ route('cart.applyDiscountCode') }}" method="POST">
            @csrf <!-- CSRF token để bảo vệ bảo mật -->
            <input type="text" class="form-control mb-3" name="discount_code" id="discount_code" placeholder="Nhập mã giảm giá">
            <button type="submit" class="btn custom-button">Áp Dụng</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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
        const initialTotal = {{ $cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) }};
        const shippingFee = 30000;

        // Cập nhật số tiền giảm giá và tổng cộng cuối cùng
        const discount = parseInt(discountAmount, 10) || 0;
        const finalTotal = initialTotal + shippingFee - discount;

        discountAmountElement.text(discount > 0 ? `-${discount.toLocaleString()}₫` : '0₫');
        finalTotalElement.text(`${finalTotal.toLocaleString()}₫`);
    }
});
</script>
