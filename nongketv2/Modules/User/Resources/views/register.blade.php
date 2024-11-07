
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card p-5" style="max-width: 500px; width: 100%; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff;">
        <h2 class="text-center mb-4" style="font-weight: 600; color: #4CAF50;">Đăng Ký Tài Khoản</h2>

        <form method="POST" action="{{ route('user.register') }}" id="registerForm" novalidate onsubmit="return validateForm(event)">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label" style="font-weight: 500; color: #333;">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" aria-describedby="nameHelp" style="border-radius: 8px; border: 1px solid #ddd;">
                <small id="nameHelp" class="form-text text-muted">Nhập họ và tên đầy đủ của bạn.</small>
                <div class="invalid-feedback" style="color: red; display: none;" id="nameError"></div>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label" style="font-weight: 500; color: #333;">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp" style="border-radius: 8px; border: 1px solid #ddd;">
                <small id="emailHelp" class="form-text text-muted">Nhập địa chỉ email hợp lệ.</small>
                <div class="invalid-feedback" style="color: red; display: none;" id="emailError"></div>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label" style="font-weight: 500; color: #333;">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="8" autocomplete="new-password" onkeyup="checkPasswordStrength()" aria-describedby="passwordHelp" style="border-radius: 8px; border: 1px solid #ddd;">
                <small id="passwordHelp" class="form-text text-muted">Mật khẩu phải dài ít nhất 8 ký tự bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.</small>
                <div id="passwordStrength" class="mt-1"></div>
                <div class="invalid-feedback" style="color: red; display: none;" id="passwordError"></div>
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label" style="font-weight: 500; color: #333;">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" aria-describedby="passwordConfirmHelp" style="border-radius: 8px; border: 1px solid #ddd;">
                <small id="passwordConfirmHelp" class="form-text text-muted">Nhập lại mật khẩu của bạn.</small>
                <div class="invalid-feedback" style="color: red; display: none;" id="passwordConfirmError"></div>
            </div>
            <div class="form-group form-check mb-4">
                <input type="checkbox" class="form-check-input" id="termsCheckbox" name="terms" required>
                <label class="form-check-label" for="termsCheckbox">
                    Tôi đồng ý với
                    <a href="#" style="color: #4CAF50; text-decoration: underline;">Điều khoản và Điều kiện</a> và
                    <a href="#" style="color: #4CAF50; text-decoration: underline;">Chính sách Quyền riêng tư</a>
                </label>
                <div class="invalid-feedback" style="color: red; display: none;" id="termsError"></div>
            </div>
            <button type="submit" class="btn w-100" style="background-color: #4CAF50; color: #ffffff; font-weight: 600; border-radius: 8px;">Đăng Ký</button>
        </form>
        <div class="text-center mt-3">
            <p>Bạn đã có tài khoản?
                <a href="#" class="load-content" data-url="{{ route('user.login.form') }}" style="color: #4CAF50; font-weight: bold;">
                    Đăng nhập ngay
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthText = document.getElementById('passwordStrength');
        let strength = 'Yếu';

        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChars = /[@$!%*?&]/.test(password);
        const isLongEnough = password.length >= 8;

        if (isLongEnough && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChars) {
            strength = 'Mạnh';
        } else if (isLongEnough) {
            strength = 'Trung bình';
        }

        strengthText.innerHTML = `<span style="color: ${strength === 'Mạnh' ? 'green' : (strength === 'Trung bình' ? 'orange' : 'red')}">${strength}</span>`;
    }

    function validateForm(event) {
        event.preventDefault(); // Ngăn chặn gửi form nếu không hợp lệ

        // Ẩn tất cả các thông báo lỗi trước khi kiểm tra
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const isAgreed = document.getElementById('termsCheckbox').checked;

        let isValid = true; // Biến kiểm tra tính hợp lệ của form

        // Kiểm tra họ và tên
        const nameError = document.getElementById('nameError');
        if (!name) {
            nameError.textContent = 'Họ và tên không được để trống.';
            nameError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        }

        // Kiểm tra email hợp lệ
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Biểu thức chính quy cho email
        if (!email) {
            emailError.textContent = 'Email không được để trống.';
            emailError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = 'Email không hợp lệ. Vui lòng nhập email hợp lệ.';
            emailError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        }

        // Kiểm tra mật khẩu
        const passwordError = document.getElementById('passwordError');
        if (!password) {
            passwordError.textContent = 'Mật khẩu không được để trống.';
            passwordError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        } else {
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecialChars = /[@$!%*?&]/.test(password);
            const isLongEnough = password.length >= 8;

            if (!isLongEnough || !hasUpperCase || !hasLowerCase || !hasNumbers || !hasSpecialChars) {
                passwordError.textContent = 'Mật khẩu phải dài ít nhất 8 ký tự và bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.';
                passwordError.style.display = 'block'; // Hiển thị thông báo lỗi
                isValid = false;
            }
        }

        // Kiểm tra xác nhận mật khẩu
        const passwordConfirmError = document.getElementById('passwordConfirmError');
        if (password !== passwordConfirmation) {
            passwordConfirmError.textContent = 'Mật khẩu xác nhận không khớp.';
            passwordConfirmError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        }

        // Kiểm tra đồng ý với điều khoản
        const termsError = document.getElementById('termsError');
        if (!isAgreed) {
            termsError.textContent = 'Bạn cần đồng ý với điều khoản.';
            termsError.style.display = 'block'; // Hiển thị thông báo lỗi
            isValid = false;
        }

        // Nếu tất cả đều hợp lệ, gửi form
        if (isValid) {
            document.getElementById('registerForm').submit(); // Gửi form nếu tất cả đều hợp lệ
        }

        return isValid; // Trả về giá trị hợp lệ của form
    }
    </script>

