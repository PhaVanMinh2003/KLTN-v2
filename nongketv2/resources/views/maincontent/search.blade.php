<!-- resources/views/components/search.blade.php -->
<div id="search-container" class="d-flex align-items-center position-relative">
    <form class="d-flex" action="{{ route('search') }}" method="GET" id="search-form">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" name="query" id="search-input" autocomplete="off">
        <button class="btn btn-warning" type="submit">Tìm</button>
    </form>
    <div id="suggestions" class="bg-light" style="display: none;"></div>
</div>


<style>
/* Container cho thanh tìm kiếm */
#search-container {
    position: relative;
    margin-bottom: 1rem;
}

/* Kiểu cho ô input tìm kiếm */
#search-input {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
}

/* Container cho danh sách gợi ý */
#suggestions {
    position: absolute;
    z-index: 1000;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: calc(100% - 2rem);
    /* Căn chỉnh gợi ý với ô tìm kiếm */
    top: calc(100% + 10px); /* Xuống dưới ô input với khoảng cách 10px */
    left: 0; /* Bắt đầu từ bên trái */
    max-height: 200px;
    overflow-y: auto;
    display: none;
}


/* Mỗi mục gợi ý */
.suggestion-item {
    padding: 10px;
    cursor: pointer;
    color: #333;
}

/* Thay đổi màu nền khi hover */
.suggestion-item:hover {
    background-color: #f0f0f0;
}

/* Kiểu cho nút tìm kiếm */
.btn-warning {
    background-color: #ffc107;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
}

/* Thay đổi màu nền khi hover trên nút tìm kiếm */
.btn-warning:hover {
    background-color: #e0a800;
}
</style>

<script>
$(document).ready(function() {
    let timeout = null;

    $('#search-input').on('input', function() {
        clearTimeout(timeout);
        const query = $(this).val();

        // Sử dụng debounce để tránh quá tải server
        timeout = setTimeout(function() {
            if (query.length > 0) {
                $.ajax({
                    url: autocompleteUrl, // Đảm bảo đã định nghĩa biến này trong Blade
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        $('#suggestions').empty(); // Xóa gợi ý cũ

                        // Kiểm tra nếu dữ liệu không trống
                        if (data.length > 0) {
                            // Hiển thị gợi ý
                            data.forEach(function(product) {
                                $('#suggestions').append('<div class="suggestion-item">' + product.name + '</div>');
                            });
                            $('#suggestions').show(); // Hiển thị danh sách gợi ý
                        } else {
                            $('#suggestions').hide(); // Ẩn nếu không có gợi ý
                        }
                    },
                    error: function() {
                        $('#suggestions').hide(); // Ẩn nếu có lỗi
                    }
                });
            } else {
                $('#suggestions').empty(); // Xóa gợi ý nếu ô tìm kiếm rỗng
                $('#suggestions').hide(); // Ẩn danh sách gợi ý
            }
        }, 300); // Thời gian debounce 300ms
    });

    // Xử lý khi người dùng nhấn vào một gợi ý
    $(document).on('click', '.suggestion-item', function() {
        $('#search-input').val($(this).text());
        $('#suggestions').empty(); // Xóa gợi ý
        $('#suggestions').hide(); // Ẩn danh sách gợi ý
    });
});
// Ẩn gợi ý khi người dùng nhấn ra ngoài
$(document).on('click', function(event) {
        if (!$(event.target).closest('#search-container').length) {
            $('#suggestions').hide(); // Ẩn danh sách gợi ý
        }
    });
</script>

<script>
    const autocompleteUrl = "{{ route('autocomplete') }}"; // Đảm bảo biến này được định nghĩa
</script>
