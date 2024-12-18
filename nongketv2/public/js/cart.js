$(document).ready(function() {

    $(document).on("click", ".remove-btn", function() {

        let itemId = $(this).data("item-id");
        console.log("ID sản phẩm cần xóa: " + itemId);
        if (!itemId) {
            console.error("Không tìm thấy ID sản phẩm!");
            return;
        }
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?")) {
            $.ajax({
                url: '/cart/remove/' + itemId,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    console.log("Đang gửi yêu cầu AJAX đến: /cart/remove/" + itemId);
                },
                success: function(response) {
                    console.log("Response từ server: ", response);
                    $("#cart-item-" + itemId).remove();
                    alert("Sản phẩm đã được xóa khỏi giỏ hàng!");
                    updateCartSummary(response.cart);
                },
                error: function(xhr, status, error) {
                    console.error("Có lỗi xảy ra: ", error);
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        } else {
            console.log("Hủy xóa sản phẩm");
        }
    });

    // Show the SHIPCOD form when the button is clicked
    $(document).on("click", ".ship-cod", function() {
        $("#shipcod-form").slideToggle();
    });

    $(document).on("click", ".btn-shipcod-submit", function() {
        let transactionModal = new bootstrap.Modal(document.getElementById('transactionSuccessModal'));
        transactionModal.show();

        // Handle the OK button click to redirect to the homepage
        $('#redirectHome').on('click', function () {
            window.location.href = "/";
        });
    });


});
function updateCartSummary(cart) {
    $(".cart-summary .cart-item-count").text(cart.cartItems.length);
    $(".cart-summary .cart-total").text(cart.totalAmount);
    $('input[name="total_amount"]').val(cart.totalAmount);
}

// Hàm tăng/giảm số lượng sản phẩm
function changeQuantity(itemId, action) {
    console.log('Thao tác ' + action + ' số lượng cho sản phẩm có ID: ' + itemId);

    // Tăng hoặc giảm số lượng sản phẩm
    $.ajax({
        url: '/cart/quantity/' + itemId,
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            action: action // Truyền thông tin hành động 'increase' hoặc 'decrease'
        },
        success: function(response) {
            console.log("Cập nhật số lượng thành công:", response);
            // Cập nhật lại thông tin giỏ hàng
            updateCartSummary(response.cart);
            // Cập nhật số lượng hiển thị trên giao diện
            $("#cart-item-" + itemId + " .quantity-controls span").text(response.cartItem.quantity);
        },
        error: function(xhr, status, error) {
            console.error("Có lỗi xảy ra khi thay đổi số lượng: ", error);
        }
    });
}