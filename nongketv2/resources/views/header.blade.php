<header class="bg-success text-white py-3 shadow">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-lg-3 col-md-4 d-flex align-items-center">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid" style="height: 80px; margin-right: 15px;">
                    <span class="fs-4 fw-bold text-white">Nông Sản Marketplace</span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="col-lg-4 col-md-5">
            @include('maincontent.search')
            </div>

            <!-- Extra Modules -->
            <div class="col-lg-5 col-md-12 text-end d-flex justify-content-end align-items-center">
                <!-- Notifications -->
                <div class="me-3">
                    <a href="#" class="text-white position-relative">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">5</span>
                    </a>
                </div>

                <!-- Language Switcher -->
                <div class="me-3">
                    <select class="form-select form-select-sm bg-success text-white border-0" style="width: auto;">
                        <option value="vi">🇻🇳 Tiếng Việt</option>
                        <option value="en">🇺🇸 English</option>
                    </select>
                </div>
               <!-- User Info -->
                <div class="d-inline-flex align-items-center">
                    @auth
                    <!-- Hiển thị avatar và tên khi đã đăng nhập -->
                    <img src="{{ auth()->user()->img ?? url('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-2" style="height: 40px; width: 40px; border: 2px solid white;">
                    <span class="text-white me-3">{{ Auth::user()->name }}</span>
                    <button class="btn btn-sm btn-outline-light rounded-pill" id="logout-btn">Đăng Xuất</button>
                    @else
                    <!-- Hiển thị avatar mặc định khi chưa đăng nhập -->
                    <i class="fas fa-user-circle fa-2x text-white me-2"></i>
                    <span class="text-white me-3">Khách</span>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mt-3">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" id="home-link" data-url="{{ route('homecontent') }}">
                                        <i class="fas fa-home"></i> Trang Chủ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" id="product-link" data-url="{{ route('productlist') }}">
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
                                            <a class="dropdown-item load-content" href="#" data-url="{{ route('account.info') }}">Thông Tin Cá Nhân</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" id="logout-btn">cài đặt</a>
                                            <!-- id="logout-btn" -->
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
                                <li class="nav-item">
                                    <a class="nav-link text-white load-content" href="#" id="contact-link" ">
                                        <i class="fas fa-envelope"></i> Liên Hệ
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
header {
    position: sticky;
    top: 0;
    z-index: 1020;
}
header .navbar-nav .nav-link {
    transition: color 0.3s ease;
}
header .navbar-nav .nav-link:hover {
    color: #f8d210;
}

</style>
