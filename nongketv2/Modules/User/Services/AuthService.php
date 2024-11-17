<?php
namespace Modules\User\Services;

use Modules\User\Helper\AvatarHelper;
use Modules\User\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService implements IAuthService
{
    protected $userRepository;
    protected $hash;

    public function __construct(IUserRepository $userRepository, Hash $hash)
    {
        $this->userRepository = $userRepository;
        $this->hash = $hash;
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Lấy thông tin người dùng
            Log::info('User logged in successfully', ['user_id' => $user->id]);

            return $user; // Trả về đối tượng người dùng khi đăng nhập thành công
        }
        return false; // Trả về false nếu đăng nhập không thành công
    }

    public function logout()
    {
        try {
            if (Auth::check()) {  // Sử dụng facade Auth trực tiếp
                $user = Auth::user();
                if ($user->currentAccessToken()) {
                    $user->currentAccessToken()->delete();  // Xóa token
                }
                Auth::logout();  // Đăng xuất người dùng
            }

            // Trả về phản hồi khi đăng xuất thành công
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        } catch (\Exception $e) {
            Log::error('Logout error', ['error' => $e->getMessage()]);
            // Trả về lỗi nếu có sự cố
            return response()->json([
                'success' => false,
                'errors' => ['Có lỗi xảy ra trong quá trình đăng xuất. Vui lòng thử lại sau.']
            ], 500);
        }
    }

    public function register(array $data)
    {
        // Mã hóa mật khẩu người dùng trước khi lưu
        $data['password'] = Hash::make($data['password']); // Dùng Hash::make thay vì bcrypt

        // Tạo avatar cho người dùng
        $data['img'] = AvatarHelper::createAvatar($data['name']); // Nếu cần, kiểm tra avatar có phải là URL hay đường dẫn tệp

        // Lưu thông tin người dùng vào cơ sở dữ liệu
        return $this->userRepository->create($data);
    }

    public function sendResetPasswordEmail(string $email)
    {
        // Chức năng gửi email reset mật khẩu (Chưa được cài đặt ở đây)
    }
}
