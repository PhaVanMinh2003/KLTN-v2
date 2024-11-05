$(document).on('click', '.load-content', function(e) {
    e.preventDefault();
    const url = $(this).data('url');

    $('#content').fadeOut(500, function() { // Ẩn phần nội dung
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
