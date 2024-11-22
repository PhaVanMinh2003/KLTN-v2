<header class="bg-success text-white py-3">
    <div class="container-fluid">
        <div class="row">
            <!-- Phần bên trái chứa logo -->
            <div class="col-lg-3 d-flex align-items-center justify-content-start">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 150px; margin-left: 100px;">
            </div>

            <!-- Phần bên phải chứa các chức năng (navbar) -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Tên trang web -->
                    <h1 class="h3 text-white">Nông Sản Marketplace</h1>

                    <!-- Avatar hoặc Icon và tìm kiếm -->
                    <div class="d-flex align-items-center">
                        <!-- Gọi file tìm kiếm -->
                        @include('maincontent.search')

                        <!-- Avatar hoặc Icon -->
                        <div class="ms-3">
                            @auth
                                <!-- Nếu người dùng có ảnh đại diện, sử dụng ảnh này -->
                                <img src="{{ auth()->user()->img ?? url('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" style="height: 40px; width: 40px; border: 2px solid white;">
                                <span class="ms-2 text-white">{{ Auth::user()->name }}</span>
                            @else
                                <i class="fas fa-user-circle" style="font-size: 40px; color: white;"></i>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Thanh điều hướng (navbar) -->
                <nav class="navbar navbar-expand-lg navbar-light bg-success mt-3">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" data-url="{{ route('homecontent') }}">
                                        <i class="fas fa-home"></i> Trang Chủ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" data-url="{{ route('productlist') }}">
                                        <i class="fas fa-shopping-basket"></i> Sản Phẩm
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" id="cart-link" data-url="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                                    </a>
                                </li>
                                <li class="nav-item dropdown" id="account-menu" style="display: none;">
    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Tài Khoản
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li>
            <a class="dropdown-item load-content" href="#" data-url="{{ route('account.info') }}">
                Thông Tin Cá Nhân
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#" id="logout-btn">Đăng Xuất</a>
        </li>
    </ul>
</li>

                                <li class="nav-item" id="login-register-links">
                                    <a class="nav-link text-white load-content" href="#" data-url="{{ route('user.login.form') }}">
                                        <i class="fas fa-user-plus"></i> Đăng Nhập
                                    </a>
                                    <a class="nav-link text-white load-content" href="#" data-url="{{ route('user.register.form') }}">
                                        <i class="fas fa-user-plus"></i> Đăng Ký
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Kiểm tra trạng thái đăng nhập qua Laravel Auth
    @auth
        document.getElementById('account-menu').style.display = 'block';
        document.getElementById('login-register-links').style.display = 'none';
    @else
        document.getElementById('account-menu').style.display = 'none';
        document.getElementById('login-register-links').style.display = 'block';
    @endauth

    // Xử lý sự kiện đăng xuất
    const logoutButton = document.getElementById('logout-btn');
    if (logoutButton) {
        logoutButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Gửi yêu cầu đăng xuất qua Laravel
            axios.post('/logout', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                }
            })
            .then(function (response) {
                if (response.data.success) {
                    window.location.href = '/'; // Hoặc trang bạn muốn chuyển hướng
                }
            })
            .catch(function (error) {
                console.error('Error logging out:', error);
            });
        });
    }

    // Xử lý sự kiện giỏ hàng
    const cartLink = document.getElementById('cart-link');
    if (cartLink) {
        cartLink.addEventListener('click', function (e) {
            e.preventDefault();  // Ngừng hành động mặc định của thẻ <a> (chuyển hướng)
            e.stopImmediatePropagation();  // Ngừng tất cả các sự kiện khác tiếp theo

            // Kiểm tra xem người dùng đã đăng nhập chưa
            @auth
                // Nếu đã đăng nhập, tải nội dung giỏ hàng vào phần layout
                const url = cartLink.getAttribute('data-url');
                // Giả sử bạn có một hàm loadContent để tải dữ liệu vào layout
                loadContent(url);
            @else
                alert('Bạn phải đăng nhập để xem giỏ hàng.');
            @endauth
        });
    }
});

// Hàm load nội dung vào layout (cần phải tùy chỉnh lại theo cách bạn load dữ liệu)
function loadContent(url) {
    axios.get(url)
        .then(response => {
            // Giả sử bạn có phần tử có ID #main-content để hiển thị nội dung
            document.getElementById('content').innerHTML = response.data;
        })
        .catch(error => {
            console.error('Error loading content:', error);
        });
}

</script>
<style>#login-register-links {
    display: flex;
    align-items: center; /* Căn chỉnh theo chiều dọc */
    gap: 15px; /* Khoảng cách giữa các nút */
}

#login-register-links a {
    display: inline-block; /* Đảm bảo các nút không bị đẩy xuống dòng */
}
</style>
