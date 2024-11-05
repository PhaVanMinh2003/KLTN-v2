CREATE DATABASE nongsandb;
USE nongsandb;

CREATE TABLE `farmers` (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Khóa chính tự động tăng
    name VARCHAR(255) NOT NULL,        -- Tên của nông dân, không được phép để trống
    email VARCHAR(255) NOT NULL UNIQUE, -- Địa chỉ email, không được phép để trống và phải là duy nhất
    phone VARCHAR(20) NOT NULL,        -- Số điện thoại, không được phép để trống
    address TEXT,                      -- Địa chỉ, có thể để trống
    created_at TIMESTAMP NULL DEFAULT NULL, -- Thời gian tạo, có thể để trống
    updated_at TIMESTAMP NULL DEFAULT NULL  -- Thời gian cập nhật, có thể để trống
);

CREATE TABLE `products` (
    product_id INT AUTO_INCREMENT PRIMARY KEY,  -- Khóa chính tự động tăng
    farmer_id INT NOT NULL,                     -- ID của người nông dân, không được phép để trống
    name VARCHAR(255) NOT NULL,                 -- Tên sản phẩm, không được phép để trống
    quantity INT NOT NULL,                      -- Số lượng sản phẩm, không được phép để trống
    price DECIMAL(10, 2) NOT NULL,              -- Giá của sản phẩm, không được phép để trống
    image_url VARCHAR(255) DEFAULT NULL,        -- URL hình ảnh sản phẩm, có thể để trống
    created_at TIMESTAMP NULL DEFAULT NULL,      -- Thời gian tạo, có thể để trống
    updated_at TIMESTAMP NULL DEFAULT NULL,      -- Thời gian cập nhật, có thể để trống
    FOREIGN KEY (farmer_id) REFERENCES farmers(id)  -- Khóa ngoại liên kết với bảng farmers
);
ALTER TABLE products
ADD COLUMN description TEXT DEFAULT NULL AFTER price;
ALTER TABLE products
ADD COLUMN history TEXT DEFAULT NULL AFTER origin,             -- Cột lịch sử
ADD COLUMN rating DECIMAL(3, 2) DEFAULT NULL AFTER history;    -- Cột đánh giá


CREATE TABLE `carts` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE `cart_items` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE `orders` (
    order_id INT AUTO_INCREMENT PRIMARY KEY, -- Khóa chính tự động tăng
    order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Ngày đặt hàng, mặc định là thời gian hiện tại
    status VARCHAR(50) NOT NULL,             -- Trạng thái đơn hàng, không được phép để trống
    total_amount DECIMAL(10, 2) NOT NULL,    -- Tổng số tiền, không được phép để trống
    created_at TIMESTAMP NULL DEFAULT NULL,  -- Thời gian tạo, có thể để trống
    updated_at TIMESTAMP NULL DEFAULT NULL   -- Thời gian cập nhật, có thể để trống
);

CREATE TABLE `order_items` (
    id INT AUTO_INCREMENT PRIMARY KEY,       -- Khóa chính tự động tăng
    order_id INT NOT NULL,                   -- ID của đơn hàng, không được phép để trống
    product_id INT NOT NULL,                 -- ID của sản phẩm, không được phép để trống
    quantity INT NOT NULL,                   -- Số lượng sản phẩm, không được phép để trống
    price DECIMAL(10, 2) NOT NULL,           -- Giá của sản phẩm, không được phép để trống
    created_at TIMESTAMP NULL DEFAULT NULL,  -- Thời gian tạo, có thể để trống
    updated_at TIMESTAMP NULL DEFAULT NULL,  -- Thời gian cập nhật, có thể để trống
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE, -- Khóa ngoại liên kết với bảng orders
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE -- Khóa ngoại liên kết với bảng products
);

CREATE TABLE `payments` (
    id INT AUTO_INCREMENT PRIMARY KEY,       -- Khóa chính tự động tăng
    order_id INT NOT NULL,                   -- ID của đơn hàng, không được phép để trống
    amount DECIMAL(10, 2) NOT NULL,          -- Số tiền thanh toán, không được phép để trống
    payment_method VARCHAR(50) NOT NULL,     -- Phương thức thanh toán, không được phép để trống
    status ENUM('pending', 'completed', 'failed') NOT NULL, -- Trạng thái thanh toán
    created_at TIMESTAMP NULL DEFAULT NULL,   -- Thời gian tạo, có thể để trống
    updated_at TIMESTAMP NULL DEFAULT NULL,   -- Thời gian cập nhật, có thể để trống
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE -- Khóa ngoại liên kết với bảng orders
);

CREATE TABLE `users` (
    id INT AUTO_INCREMENT PRIMARY KEY,             -- Khóa chính tự động tăng
    name VARCHAR(255) NOT NULL,                    -- Tên người dùng, không được phép để trống
    email VARCHAR(255) UNIQUE NOT NULL,            -- Email, không được phép để trống và phải duy nhất
    password VARCHAR(255) NOT NULL,                 -- Mật khẩu, không được phép để trống
    email_verified_at TIMESTAMP NULL DEFAULT NULL, -- Thời gian xác thực email, có thể để trống
    remember_token VARCHAR(100) DEFAULT NULL,      -- Token ghi nhớ, có thể để trống
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,  -- Thời gian tạo, mặc định là thời gian hiện tại
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Thời gian cập nhật, mặc định là thời gian hiện tại và tự động cập nhật khi có thay đổi
);
