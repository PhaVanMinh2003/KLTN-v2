<header class="bg-success text-white py-3">
    <div class="container-fluid">
        <div class="row">
            <!-- Phần bên trái chứa logo -->
            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 150px;">
            </div>

            <!-- Phần bên phải chứa các chức năng (navbar) -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3">Nông Sản Marketplace</h1>

                    <div class="d-flex align-items-center">
                        <!-- Gọi file tìm kiếm -->
                        @include('maincontent.search')

                        <!-- Avatar hoặc Icon -->
                        <div class="ms-3">
                            @if(Auth::check())
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" style="height: 40px; width: 40px; border: 2px solid white;">
                                <span class="ms-2 text-white">{{ Auth::user()->name }}</span>
                            @else
                                <i class="fas fa-user-circle" style="font-size: 40px; color: white;"></i> <!-- Icon khi chưa đăng nhập -->
                            @endif
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
                                    <a class="nav-link text-white" href=""><i class="fas fa-shopping-cart"></i> Giỏ Hàng</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tài Khoản</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="">Thông Tin Cá Nhân</a></li>
                                        <li><a class="dropdown-item" href="">Đăng Xuất</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href=""><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href=""><i class="fas fa-user-plus"></i> Đăng Ký</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

