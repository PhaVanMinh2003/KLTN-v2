$(document).on('click', '.load-content', function(e) {
    e.preventDefault();

    const url = $(this).data('url');

    // Kiểm tra xem URL hiện tại có trùng với URL của liên kết không
    if (window.location.href === url) {
        $('html, body').animate({ scrollTop: 0 }, 300);
        return;
    }

    // Cập nhật URL trên trình duyệt nhưng không tải lại trang
    history.pushState(null, null, url);

    $('#content').fadeOut(300, function() {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#content').html(response).fadeIn(500);
            },
            error: function() {
                alert('Không hiển thị được nội dung bạn mong muốn');
            }
        });
    });
});

// Xử lý lịch sử trình duyệt
window.onpopstate = function() {
    const url = window.location.href;

    $('#content').fadeOut(300, function() {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#content').html(response).fadeIn(500);
            },
            error: function() {
                alert('Không hiển thị được nội dung bạn mong muốn');
            }
        });
    });
};

$(document).ready(function () {

    if (window.location.href.includes("vnp_Amount")) {
        // Show the Bootstrap modal
        let transactionModal = new bootstrap.Modal(document.getElementById('transactionSuccessModal'));
        transactionModal.show();

        // Handle the OK button click to redirect to the homepage
        $('#redirectHome').on('click', function () {
            window.location.href = "/";
        });
    }

});


