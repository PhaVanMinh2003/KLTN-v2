$(document).on('click', '.load-content', function(e) {
    e.preventDefault();

    const url = $(this).data('url');

    // Kiểm tra xem URL hiện tại có trùng với URL của liên kết không
    if (window.location.href === url) {
        // Nếu trùng, cuộn về đầu trang mà không tải lại nội dung
        $('html, body').animate({ scrollTop: 0 }, 300);
        return; // Dừng thực hiện AJAX request
    }

    // Nếu không trùng, tiếp tục với yêu cầu AJAX
    $('#content').fadeOut(300, function() {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#content').html(response).fadeIn(500); // Hiển thị lại nội dung
            },
            error: function() {
                alert('Error loading content');
            }
        });
    });
});

