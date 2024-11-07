<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card p-5" style="max-width: 500px; width: 100%; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff;">
        <h2 class="text-center mb-4" style="font-weight: 600; color: #4CAF50;">Đăng Nhập</h2>

        <form method="POST" action="{{ route('user.login') }}" id="loginForm" novalidate onsubmit="return validateLoginForm(event)">
            @csrf
            <div class="form-group mb-3">
                <label for="loginEmail" class="form-label" style="font-weight: 500; color: #333;">Email</label>
                <input type="email" class="form-control" id="loginEmail" name="email" required autocomplete="email" style="border-radius: 8px; border: 1px solid #ddd;">
                <div class="invalid-feedback" style="color: red; display: none;" id="loginEmailError"></div>
            </div>
            <div class="form-group mb-3 position-relative">
                <label for="loginPassword" class="form-label" style="font-weight: 500; color: #333;">Mật khẩu</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required autocomplete="current-password" style="border-radius: 8px; border: 1px solid #ddd; padding-right: 40px;">

                <!-- Icon con mắt -->
                <span class="password-toggle-icon" onclick="togglePasswordVisibility()" style="position: absolute; top: 50%;top:50px; right: 10px; transform: translateY(-50%); cursor: pointer;">
                    <i id="passwordIcon" class="fa fa-eye" style="color: #888;"></i>
                </span>

                <div class="invalid-feedback" style="color: red; display: none;" id="loginPasswordError"></div>
            </div>
            <div class="text-end mb-3">
                <a href="#" class="load-content" data-url="{{ route('user.forgot-password.form') }}" style="color: #4CAF50;">
                    Quên mật khẩu?
                </a>
            </div>
            <button type="submit" class="btn w-100" style="background-color: #4CAF50; color: #ffffff; font-weight: 600; border-radius: 8px;">Đăng Nhập</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản?
                <a href="#" class="load-content" data-url="{{ route('user.register') }}" style="color: #4CAF50; font-weight: bold;">
                    Đăng ký ngay
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function validateLoginForm(event) {
        event.preventDefault();

        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });

        const email = document.getElementById('loginEmail').value.trim();
        const password = document.getElementById('loginPassword').value;

        let isValid = true;

        const emailError = document.getElementById('loginEmailError');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            emailError.textContent = 'Email không được để trống.';
            emailError.style.display = 'block';
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = 'Email không hợp lệ. Vui lòng nhập email hợp lệ.';
            emailError.style.display = 'block';
            isValid = false;
        }

        const passwordError = document.getElementById('loginPasswordError');
        if (!password) {
            passwordError.textContent = 'Mật khẩu không được để trống.';
            passwordError.style.display = 'block';
            isValid = false;
        }

        if (isValid) {
            document.getElementById('loginForm').submit();
        }

        return isValid;
    }

    function togglePasswordVisibility() {
        const passwordField = document.getElementById('loginPassword');
        const passwordIcon = document.getElementById('passwordIcon');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordIcon.classList.remove("fa-eye");
            passwordIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            passwordIcon.classList.remove("fa-eye-slash");
            passwordIcon.classList.add("fa-eye");
        }
    }
</script>
