<div>
<h3 class="info-title">Thông tin thêm</h3>
<div class="d-flex justify-content-between"> <!-- Chia thành hai phần -->
    <ul class="info-list flex-grow-1"> <!-- Danh sách bên trái -->
        <li class="info-item">
            <div class="info-icon">
                <i class="fas fa-info-circle"></i> <!-- Biểu tượng thông tin -->
            </div>
            <div class="info-content">
                <a href="#">Giới thiệu về chúng tôi</a>
            </div>
        </li>
        <li class="info-item">
            <div class="info-icon">
                <i class="fas fa-envelope"></i> <!-- Biểu tượng liên hệ -->
            </div>
            <div class="info-content">
                <a href="#">Liên hệ</a>
            </div>
        </li>
        <li class="info-item">
            <div class="info-icon">
                <i class="fas fa-shield-alt"></i> <!-- Biểu tượng chính sách bảo mật -->
            </div>
            <div class="info-content">
                <a href="#">Chính sách bảo mật</a>
            </div>
        </li>
    </ul>

    <!-- Chi tiết bên phải -->
    <div class="info-detail">
        <h4>Chi tiết thêm</h4>
        <p>Khám phá những thông tin bổ ích và cập nhật mới nhất từ chúng tôi.</p>
        <p>Chúng tôi cam kết mang đến những sản phẩm chất lượng cao và dịch vụ tốt nhất cho khách hàng.</p>
    </div>
</div>

</div>
<style>
  /* Tiêu đề Thông tin thêm */
.info-title {
    font-size: 2rem;
    font-weight: bold;
    color: #ff6600; /* Màu tiêu đề */
    text-align: center;
    margin-bottom: 30px; /* Tăng khoảng cách dưới tiêu đề */
}

/* Danh sách thông tin thêm */
.info-list {
    display: flex;
    flex-direction: column; /* Xếp theo chiều dọc */
    gap: 15px; /* Khoảng cách giữa các mục */
    margin: 0 10px; /* Căn chỉnh lề */
}

/* Mục thông tin thêm */
.info-item {
    background-color: #fff; /* Nền trắng */
    border-radius: 8px; /* Bo tròn */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    padding: 15px; /* Padding bên trong */
    position: relative; /* Để có thể đặt đường cắt lên trên */
    overflow: hidden; /* Ẩn phần tràn */
    display: flex; /* Thay đổi thành flexbox */
    align-items: center; /* Căn giữa theo chiều dọc */
}

/* Đường cắt chéo cho mục thông tin */
.info-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 102, 0, 0.2), rgba(0, 204, 0, 0.1)); /* Màu nền chéo */
    z-index: 1; /* Đặt lên trên nội dung */
}

/* Nội dung mục thông tin */
.info-content {
    position: relative; /* Để nội dung nằm trên đường cắt */
    z-index: 2; /* Đặt nội dung lên trên */
    flex-grow: 1; /* Chiếm hết không gian còn lại */
}

/* Đường dẫn */
.info-content a {
    text-decoration: none;
    color: #333; /* Màu chữ */
    font-weight: bold; /* Chữ đậm */
}

/* Đường dẫn khi rê chuột */
.info-content a:hover {
    color: #ff6600; /* Màu chữ khi rê chuột */
    text-decoration: underline; /* Gạch chân khi rê chuột */
}

/* Biểu tượng */
.info-icon {
    font-size: 1.5rem; /* Kích thước biểu tượng */
    color: #ff6600; /* Màu biểu tượng */
    margin-right: 15px; /* Khoảng cách bên phải */
}

/* Khu vực chi tiết bên phải */
.info-detail {
    margin-left: 20px; /* Khoảng cách từ danh sách */
    flex-shrink: 0; /* Không cho phép thu nhỏ */
    text-align: right; /* Căn chỉnh bên phải */
}

/* Nội dung chi tiết */
.info-detail p {
    margin: 0; /* Xóa khoảng cách mặc định */
    color: #666; /* Màu chữ */
}

</style>
