<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Services\IAuthService;
use Illuminate\Support\Facades\Auth;
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = $this->authService->register($validatedData);

        // Thực hiện hành động sau khi đăng ký thành công (như chuyển hướng, gửi email, v.v.)
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
    public function showLoginForm()
    {
        return view('user::login');
    }

    public function login(Request $request)
    {
        // Kiểm tra xem có lỗi trong quá trình xác thực không
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Xác thực người dùng
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng đến trang đã định
            return redirect()->intended('home')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập không thành công, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ])->withInput(); // Giữ lại thông tin nhập vào
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Đăng xuất thành công!');
    }



    public function showForgotPasswordForm() {
        return view('user::forgot-password'); // Đường dẫn tới view forgot-password
    }
    public function submitForgotPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Thực hiện logic gửi email đặt lại mật khẩu tại đây

    return back()->with('status', 'Hướng dẫn đặt lại mật khẩu đã được gửi qua email của bạn.');
}

}
