<div class="sidebar" >
<h5 class="text-center">
        <i class="fas fa-utensils"></i> <!-- Thay đổi biểu tượng nếu cần -->
        Menu
    </h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-home"></i> Sản phẩm nổi bật</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-shopping-basket"></i> Thể loại</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-newspaper"></i> Tin tức</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Thông tin thêm</a>
        </li>
    </ul>
</div>
<style>
/* Sidebar Container */
.sidebar {
    background: #009688; /* Màu nền xanh ngọc */
    padding: 20px; /* Khoảng cách bên trong */
    border-radius: 1px; /* Bo tròn góc */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Đổ bóng mạnh hơn */
}

/* Tiêu đề Sidebar */
.sidebar h5 {
    font-size: 1.75rem; /* Kích thước tiêu đề lớn hơn */
    color: #ffffff; /* Màu tiêu đề trắng */
    text-align: center; /* Căn giữa tiêu đề */
    margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
}

/* Danh sách điều hướng */
.nav-link {
    color: #ffffff; /* Màu chữ trắng */
    padding: 12px 20px; /* Padding cho các liên kết */
    border-radius: 8px; /* Bo tròn */
    transition: background-color 0.3s ease, transform 0.2s; /* Hiệu ứng chuyển đổi */
}

/* Màu sắc của các liên kết khi rê chuột */
.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Màu nền khi rê chuột */
    color: #FFB74D; /* Màu chữ vàng nhạt khi rê chuột */
    transform: scale(1.05); /* Tăng kích thước nhẹ khi rê chuột */
}

/* Màu sắc của biểu tượng */
.nav-link i {
    margin-right: 10px; /* Khoảng cách bên phải cho biểu tượng */
}


</style>
