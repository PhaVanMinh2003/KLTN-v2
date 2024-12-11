<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card p-5" style="max-width: 500px; width: 100%; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff;">
        <h2 class="text-center mb-4" style="font-weight: 600; color: #4CAF50;">Lấy lại mật khẩu</h2>
        <p class="text-center mb-4" style="color: #666; font-size: 0.9rem;">Vui lòng nhập email của bạn. Chúng tôi sẽ gửi hướng dẫn để bạn có thể đặt lại mật khẩu.</p>

        <form method="POST" action="{{ route('user.forgot-password.submit') }}" id="forgotPasswordForm" novalidate onsubmit="return validateForgotPasswordForm(event)">
            @csrf
            <div class="form-group mb-4">
                <label for="forgotPasswordEmail" class="form-label" style="font-weight: 500; color: #333;">Email</label>
                <input type="email" class="form-control" id="forgotPasswordEmail" name="email" required autocomplete="email" placeholder="Nhập email của bạn" style="border-radius: 8px; border: 1px solid #ddd;">
                <div class="invalid-feedback" style="color: red; display: none;" id="forgotPasswordEmailError"></div>
            </div>

            <button type="submit" class="btn w-100" style="background-color: #4CAF50; color: #ffffff; font-weight: 600; border-radius: 8px;">Gửi yêu cầu</button>
        </form>

        <div class="text-center mt-3">
            <p>Nhớ lại mật khẩu?
                <a href="#" class="load-content" data-url="{{ route('user.login.form') }}" style="color: #4CAF50; font-weight: bold;">
                    Đăng nhập
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function validateForgotPasswordForm(event) {
        event.preventDefault();

        // Ẩn tất cả các thông báo lỗi trước khi kiểm tra
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });

        const email = document.getElementById('forgotPasswordEmail').value.trim();
        const emailError = document.getElementById('forgotPasswordEmailError');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Biểu thức chính quy cho email
        let isValid = true;

        if (!email) {
            emailError.textContent = 'Email không được để trống.';
            emailError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = 'Email không hợp lệ. Vui lòng nhập email hợp lệ.';
            emailError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        }

        if (isValid) {
            document.getElementById('forgotPasswordForm').submit();
        }

        return isValid;
    }
</script>
