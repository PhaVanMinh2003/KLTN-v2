
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card p-5" style="max-width: 500px; width: 100%; border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff;">
        <h2 class="text-center mb-4" style="font-weight: 600; color: #4CAF50;">Đăng Nhập</h2>

        <!-- Token CSRF -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Form đăng nhập -->
        <form id="loginForm" novalidate>
            @csrf

            <!-- Email -->
            <div class="form-group mb-3">
                <label for="loginEmail" class="form-label" style="font-weight: 500; color: #333;">Email</label>
                <input type="email" class="form-control" id="loginEmail" name="email" required autocomplete="email" style="border-radius: 8px; border: 1px solid #ddd;" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                <div class="invalid-feedback" id="emailError" style="color: red;"></div>
            </div>

            <!-- Mật khẩu -->
            <div class="form-group mb-3 position-relative">
                <label for="loginPassword" class="form-label" style="font-weight: 500; color: #333;">Mật khẩu</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required autocomplete="current-password" style="border-radius: 8px; border: 1px solid #ddd;" minlength="6">
                <div class="invalid-feedback" id="passwordError" style="color: red;"></div>
            </div>
            <!-- Quên mật khẩu -->
            <div class="text-end mb-3">
                <a href="#" class="load-content" data-url="{{ route('user.forgot-password.form') }}" style="color: #4CAF50;">Quên mật khẩu?</a>
            </div>

            <!-- Nút đăng nhập -->
            <button type="submit" class="btn w-100" style="background-color: #4CAF50; color: #ffffff; font-weight: 600; border-radius: 8px;">Đăng Nhập</button>
        </form>

        <!-- Hiển thị loader -->
        <div id="loadingSpinner" style="display: none;" class="text-center mt-3">
            <div class="spinner-border" role="status" style="color: #4CAF50;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Hiển thị thông báo lỗi -->
        <div id="generalError" class="alert alert-danger mt-3" style="display: none; color: red;"></div>

        <!-- Đăng ký -->
        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản?
                <a href="#" class="load-content" data-url="{{ route('user.register') }}" style="color: #4CAF50; font-weight: bold;">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get email, password and CSRF token values
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        const csrfToken = document.querySelector('input[name="_token"]').value;

        // Clear previous error messages
        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';
        document.getElementById('generalError').style.display = 'none';

        // Show loading spinner
        document.getElementById('loadingSpinner').style.display = 'block';

        // Kiểm tra xem các trường có trống không
        if (!email || !password) {
            document.getElementById('generalError').style.display = 'block';
            document.getElementById('generalError').innerText = 'Email and password are required.';
            document.getElementById('loadingSpinner').style.display = 'none';
            return;
        }

        // Kiểm tra định dạng email
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailError').innerText = 'Please enter a valid email address.';
            document.getElementById('loadingSpinner').style.display = 'none';
            return;
        }

        // Kiểm tra mật khẩu (có tối thiểu 6 ký tự)
        if (password.length < 6) {
            document.getElementById('passwordError').innerText = 'Password must be at least 6 characters.';
            document.getElementById('loadingSpinner').style.display = 'none';
            return;
        }

        // Nếu tất cả đều hợp lệ, gửi request đến server
        axios.post('{{ route("user.login") }}', {
            email: email,
            password: password,
        }, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(function (response) {
            document.getElementById('loadingSpinner').style.display = 'none';

            if (response.data.success) {
                // Save token in localStorage
                localStorage.setItem('token', response.data.token);

                // Redirect to the home page
                window.location.href = '/'; // Or use JS routing like React, Vue, etc.
            } else {
                // Display error messages
                if (response.data.errors) {
                    if (response.data.errors.includes('Invalid email or password.')) {
                        document.getElementById('generalError').style.display = 'block';
                        document.getElementById('generalError').innerText = 'Invalid email or password.';
                    }
                } else {
                    document.getElementById('generalError').style.display = 'block';
                    document.getElementById('generalError').innerText = 'Login failed. Please try again.';
                }
            }
        })
        .catch(function (error) {
            document.getElementById('loadingSpinner').style.display = 'none';
            document.getElementById('generalError').style.display = 'block';
            document.getElementById('generalError').innerText = 'An error occurred. Please try again later.';
            console.error('Error:', error);
        });
    });
</script>



