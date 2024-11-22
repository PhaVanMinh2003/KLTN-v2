<!-- Phần Cài Đặt Tài Khoản -->
<div class="container-fluid" style="background-color: #fff; padding: 30px;">
    <!-- Header -->
    <header class="text-center text-dark mb-4">
        <h1 class="display-4 font-weight-bold" style="font-size: 28px;">Trang Cài Đặt Tài Khoản</h1>
    </header>

    <div class="row justify-content-center">
        <!-- Cột Thông Tin Người Dùng -->
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm rounded-lg" style="background-color: #F9F9F9; border: none;">
                <div class="card-body text-center">
                    <img src="{{ auth()->user()->img ?? 'default-avatar.jpg' }}" alt="Avatar" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h3 class="text-dark" style="font-size: 20px;">{{ auth()->user()->name }}</h3>
                    <p class="text-muted" style="font-size: 14px;">{{ auth()->user()->email }}</p>
                    <p class="text-muted" style="font-size: 14px;">Vai trò: <span class="font-weight-bold">{{ auth()->user()->role }}</span></p>
                </div>
            </div>
        </div>

        <!-- Cột Chức Năng -->
        <div class="col-md-7 col-lg-8">
            <div class="card shadow-sm rounded-lg" style="background-color: #F9F9F9; border: none;">
                <div class="card-body">
                    <h4 class="text-center text-dark mb-4" style="font-size: 22px; font-weight: 600;">Cài Đặt Tài Khoản</h4>

                    <!-- Nút Chức Năng -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Nút Đổi Mật Khẩu -->
                        <button class="btn btn-outline-warning btn-lg w-75 mb-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-key mr-2" style="font-size: 18px;"></i> Đổi Mật Khẩu
                        </button>

                        <!-- Nút Cập Nhật Thông Tin -->
                        <button class="btn btn-outline-warning btn-lg w-75 mb-3" data-bs-toggle="modal" data-bs-target="#updateInfoModal">
                            <i class="bi bi-pencil mr-2" style="font-size: 18px;"></i> Cập Nhật Thông Tin
                        </button>

                        <!-- Nút Xóa Tài Khoản -->
                        <button class="btn btn-outline-danger btn-lg w-75" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash mr-2" style="font-size: 18px;"></i> Xóa Tài Khoản
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm các thành phần phía dưới để tránh trống -->
    <footer class="mt-5 text-center">
        <p class="text-muted" style="font-size: 14px;">© 2024 Website của chúng tôi. Tất cả quyền được bảo lưu.</p>
    </footer>
</div>

<!-- Chèn Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Chèn Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
