<div>
<h3 class="news-title">Tin tức mới</h3>
<ul class="news-list">
    <li class="news-item">
        <div class="news-content">
            <a href="#">Cập nhật tình hình thời tiết ảnh hưởng đến vụ mùa</a>
        </div>
    </li>
    <li class="news-item">
        <div class="news-content">
            <a href="#">Hướng dẫn cách bảo quản nông sản tươi lâu</a>
        </div>
    </li>
    <li class="news-item">
        <div class="news-content">
            <a href="#">Giải pháp bền vững cho nông nghiệp trong thời đại 4.0</a>
        </div>
    </li>
    <li class="news-item">
        <div class="news-content">
            <a href="#">Các sản phẩm nông sản đặc trưng theo mùa</a>
        </div>
    </li>
</ul>

</div>
<style>
/* Tiêu đề Tin tức */
.news-title {
    font-size: 2rem;
    font-weight: bold;
    color: #ff6600; /* Màu tiêu đề */
    text-align: center;
    margin-bottom: 30px; /* Tăng khoảng cách dưới tiêu đề */
}

/* Danh sách tin tức */
.news-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Hai cột */
    gap: 20px; /* Khoảng cách giữa các mục */
    margin: 0 10px; /* Căn chỉnh lề */
}

/* Mục tin tức */
.news-item {
    position: relative; /* Để có thể đặt đường cắt lên trên */
    background-color: #fff; /* Nền trắng */
    border-radius: 8px; /* Bo tròn */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    overflow: hidden; /* Ẩn phần tràn */
    padding: 20px; /* Padding bên trong */
}

/* Đường cắt chéo */
.news-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 102, 0, 0.3), rgba(0, 204, 0, 0.3));
    z-index: 1; /* Đặt lên trên nội dung */
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%); /* Đường cắt */
}

/* Nội dung tin tức */
.news-content {
    position: relative; /* Để nội dung nằm trên đường cắt */
    z-index: 2; /* Đặt nội dung lên trên */
}

/* Đường dẫn */
.news-content a {
    text-decoration: none;
    color: #333; /* Màu chữ */
    font-weight: bold; /* Chữ đậm */
}

/* Đường dẫn khi rê chuột */
.news-content a:hover {
    color: #ff6600; /* Màu chữ khi rê chuột */
}

</style>
