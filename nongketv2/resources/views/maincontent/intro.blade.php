<div class="alert alert-info mt-3 welcome-alert" role="alert">
    Chào mừng đến với ứng dụng thu gom nông sản! Tại đây, bạn có thể tìm thấy và đặt hàng các sản phẩm nông sản tươi ngon từ nông dân địa phương.
</div>
<style>
    /* Tạo hiệu ứng fade-in và di chuyển */
@keyframes fadeInSlide {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Tùy chỉnh thông báo */
.welcome-alert {
    animation: fadeInSlide 1.5s ease forwards;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    background: linear-gradient(45deg, #e1f5fe, #81d4fa);
    color: #01579b;
    font-weight: 500;
    padding: 20px;
    opacity: 0; /* Đặt ban đầu là 0 để phục vụ animation */
    transform: translateY(-20px); /* Hiệu ứng di chuyển ban đầu */
    position: relative;
    overflow: hidden;
}

/* Thêm hiệu ứng sóng nhẹ vào góc trên */
.welcome-alert::before {
    content: "";
    position: absolute;
    top: -30px;
    right: -30px;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    animation: pulsate 3s ease-in-out infinite;
}

/* Hiệu ứng sóng lan tỏa */
@keyframes pulsate {
    0% {
        transform: scale(1);
        opacity: 0.8;
    }
    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

</style>
