<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Services\IAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }
    public function showRegistrationForm()
    {
        return view('user::register');
    }
    public function register(Request $request)
    {
        // Validate input dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Xác nhận mật khẩu
        ]);

        // Gọi service để lưu người dùng, đã mã hóa mật khẩu trong service rồi
        $this->authService->register($validatedData);

        // Redirect về trang đăng nhập với thông báo thành công
        return redirect()->route('user.login.form')->with('success', 'Đăng ký thành công!');
    }

    public function showLoginForm()
    {
        return view('user::login');
    }
    public function login(Request $request)
    {
        try {
            \Log::info('Login request received', $request->all());

            $validator = \Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                ]);
            }

            $credentials = $request->only('email', 'password');
            $credentials['email'] = strtolower($credentials['email']);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                \Log::info('User authenticated successfully', ['user_id' => $user->id]);

                // Tạo token
                $token = $user->createToken('YourAppName')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'token' => $token, // Trả về token cho người dùng
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => ['Invalid email or password.']
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Login error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'errors' => ['An error occurred. Please try again later.']
            ], 500);
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout();
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        } catch (\Exception $e) {
            Log::error('Logout error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'errors' => ['Có lỗi xảy ra trong quá trình đăng xuất. Vui lòng thử lại sau.']
            ], 500);
        }
    }
    public function showForgotPasswordForm()
    {
        return view('user::forgot-password');
    }
    public function submitForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Thực hiện logic gửi email đặt lại mật khẩu tại đây
        // Ví dụ: $this->authService->sendResetPasswordEmail($request->email);

        return back()->with('status', 'Hướng dẫn đặt lại mật khẩu đã được gửi qua email của bạn.');
    }
}
