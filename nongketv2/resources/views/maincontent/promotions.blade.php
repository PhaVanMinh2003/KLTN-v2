<div class="alert alert-success mt-3 promo-alert" role="alert">
    Khuyến mãi đặc biệt! Giảm 10% cho đơn hàng đầu tiên của bạn!
</div>
<style>
    /* Hiệu ứng xuất hiện với chuyển động từ dưới lên */
@keyframes slideUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hiệu ứng mờ dần vào */
@keyframes pulse {
    0% {
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
    }
    100% {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }
}

/* Tùy chỉnh thông báo khuyến mãi */
.promo-alert {
    animation: slideUp 1s ease forwards, pulse 3s ease-in-out infinite;
    box-shadow: 0 8px 16px rgba(0, 255, 0, 0.2);
    border-radius: 12px;
    background: linear-gradient(45deg, #a5d6a7, #66bb6a);
    color: #1b5e20;
    font-weight: 600;
    padding: 20px;
    opacity: 0;
    transform: translateY(20px);
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Hiệu ứng đèn flash nhẹ nhàng ở góc dưới */
.promo-alert::before {
    content: "";
    position: absolute;
    bottom: -30px;
    left: -30px;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
}

</style>
