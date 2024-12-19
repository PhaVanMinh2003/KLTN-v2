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

            <!-- Lịch Sử Mua Hàng -->
            <div class="card shadow-sm rounded-lg mb-4" style="background-color: #F9F9F9; border: none;">
                <div class="card-body">
                    <h4 class="text-dark mb-3" style="font-size: 22px; font-weight: 600;">Lịch Sử Mua Hàng</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Ngày Mua</th>
                                    <th>Trạng Thái</th>
                                    <th>Tổng Tiền</th>
                                    <th>Chi Tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1001</td>
                                    <td>15/12/2024</td>
                                    <td><span class="badge bg-success">Hoàn Thành</span></td>
                                    <td>1,500,000 đ</td>
                                    <td><button class="btn btn-sm btn-primary">Xem Chi Tiết</button></td>
                                </tr>
                                <tr>
                                    <td>#1002</td>
                                    <td>10/12/2024</td>
                                    <td><span class="badge bg-warning">Đang Giao</span></td>
                                    <td>850,000 đ</td>
                                    <td><button class="btn btn-sm btn-primary">Xem Chi Tiết</button></td>
                                </tr>
                                <tr>
                                    <td>#1003</td>
                                    <td>05/12/2024</td>
                                    <td><span class="badge bg-danger">Hủy</span></td>
                                    <td>0 đ</td>
                                    <td><button class="btn btn-sm btn-primary">Xem Chi Tiết</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="card shadow-sm rounded-lg" style="background-color: #F9F9F9; border: none;">
                <div class="card-body">
                    <h4 class="text-dark mb-3" style="font-size: 22px; font-weight: 600;">Danh Sách Yêu Thích</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="product-1.jpg" class="card-img-top" alt="Sản phẩm 1">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="text-muted">500,000 đ</p>
                                    <button class="btn btn-sm btn-primary">Xem Chi Tiết</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="product-2.jpg" class="card-img-top" alt="Sản phẩm 2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="text-muted">750,000 đ</p>
                                    <button class="btn btn-sm btn-primary">Xem Chi Tiết</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="product-3.jpg" class="card-img-top" alt="Sản phẩm 3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sản phẩm 3</h5>
                                    <p class="text-muted">1,200,000 đ</p>
                                    <button class="btn btn-sm btn-primary">Xem Chi Tiết</button>
                                </div>
                            </div>
                        </div>
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
