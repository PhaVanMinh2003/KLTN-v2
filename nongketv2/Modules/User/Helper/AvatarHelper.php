<?php

namespace Modules\User\Helper;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AvatarHelper
{
    public static function createAvatar($name)
    {
        // Lấy chữ cái đầu tiên của tên
        $initial = strtoupper(mb_substr($name, 0, 1));

        $image = Image::canvas(100, 100, '#FF9800')
        ->text($initial, 50, 50, function ($font) {
            // Thay vì sử dụng file TTF, bạn có thể sử dụng font nội bộ (1-5)
            $font->file(1); // Dùng font có chỉ số 1
            $font->size(96); // Phóng to chữ lên gấp đôi
            $font->color('#4CAF50'); // Đổi màu chữ thành màu xanh cây
            $font->align('center');
            $font->valign('center');
        });

        $fileName = 'avatars/' . uniqid() . '.png';
        $path = storage_path('app/public/' . $fileName);
        $image->save($path);

        return 'storage/' . $fileName; // Trả về đường dẫn avatar
    }
}
