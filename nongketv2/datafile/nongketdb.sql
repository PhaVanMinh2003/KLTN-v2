-- Tạo cơ sở dữ liệu và sử dụng
CREATE DATABASE nongsandb;
USE nongsandb;

-- Bảng người nông dân
CREATE TABLE `farmers` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng loại sản phẩm
CREATE TABLE `product_types` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng sản phẩm
CREATE TABLE `products` (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    product_type_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT DEFAULT NULL,
    origin VARCHAR(255) DEFAULT NULL,
    history TEXT DEFAULT NULL,
    rating DECIMAL(3, 2) DEFAULT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmers(id),
    FOREIGN KEY (product_type_id) REFERENCES product_types(id)
);

-- Bảng giỏ hàng
CREATE TABLE `carts` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng chi tiết giỏ hàng
CREATE TABLE `cart_items` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Bảng người dùng
CREATE TABLE `users` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    img VARCHAR(255) NULL,
    role ENUM('client', 'farmer', 'admin') NOT NULL DEFAULT 'client',
    email_verified_at DATETIME DEFAULT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng đơn hàng
CREATE TABLE `orders` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng chi tiết đơn hàng
CREATE TABLE `order_items` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Bảng thanh toán
CREATE TABLE `payments` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status ENUM('pending', 'completed', 'failed') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Bảng mã giảm giá
CREATE TABLE `discount_codes` (
    discount_code_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    discount_type ENUM('percentage', 'fixed') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    min_purchase_amount DECIMAL(10, 2) DEFAULT NULL,
    start_date DATETIME DEFAULT NULL,
    end_date DATETIME DEFAULT NULL,
    status ENUM('active', 'inactive') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng giảm giá đơn hàng
CREATE TABLE `order_discounts` (
    order_discount_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    discount_code_id INT NOT NULL,
    discount_amount DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (discount_code_id) REFERENCES discount_codes(discount_code_id) ON DELETE CASCADE
);

INSERT INTO `nongsandb`.`products`
(`product_id`, `farmer_id`, `name`, `quantity`, `price`, `description`, `image_url`, `history`, `rating`)
VALUES ('6', '1', 'Táo đỏ', '456', '50000', 'Được lấy trực tiếp tại vườn', 'img\\Apple.jpg', 'lay tu dong', '0');

INSERT INTO `nongsandb`.`products`
(`product_id`, `farmer_id`, `name`, `quantity`, `price`, `description`, `image_url`, `history`, `rating`)
VALUES ('7', '1', 'Apricot', '358', '300000', 'trồng tại trung hiệp', 'img\\Apricot.jpg', 'lay tu dong', '0');

INSERT INTO `nongsandb`.`products`
(`product_id`, `farmer_id`, `name`, `quantity`, `price`, `description`, `image_url`, `history`, `rating`)
VALUES
('8', '1', 'Chuối', '358', '200000', 'trồng tại trung hiệp', 'img\\Banana.jpg', 'lay tu dong', '0'),
('9', '1', 'Bơ', '358', '330000', 'trồng tại trung hiệp', 'img\\bo.jpg', 'lay tu dong', '0'),
('10', '1', 'Cherry', '358', '400000', 'trồng tại trung hiệp', 'img\\Cherry.jpg', 'lay tu dong', '0'),
('11', '1', 'Sầu riêng', '558', '300000', 'trồng tại trung hiệp', 'img\\Durian.jpg', 'lay tu dong', '0');
INSERT INTO `nongsandb`.`products`
(`product_id`, `farmer_id`, `name`, `quantity`, `price`, `description`, `image_url`, `history`, `rating`)
VALUES
('12', '1', 'Nho', '338', '150000', 'trồng tại trung hiệp', 'img\\Grape.jpg', 'lay tu dong', '0'),
('13', '1', 'Bưởi', '358', '330000', 'trồng tại trung tân`', 'img\\Grapefruit.jpg', 'lay tu dong', '0'),
('14', '1', 'mít', '358', '200000', 'trồng tại trung tân', 'img\\Jackfruit.jpg', 'lay tu dong', '0'),
('15', '1', 'kiwi', '558', '400000', 'trồng tại trung hiệp', 'img\\Kiwifruit.jpg', 'lay tu dong', '0');

INSERT INTO `nongsandb`.`products`
(`product_id`, `farmer_id`, `name`, `quantity`, `price`, `description`, `image_url`, `history`, `rating`)
VALUES
('16', '1', 'Kumquat', '438', '150000', 'trồng tại tam hiệp', 'img\\Kumquat.jpg', 'lay tu dong', '0'),
('17', '1', 'chanh', '128', '29000', 'trồng tại trung tân`', 'img\\Lemon.jpg', 'lay tu dong', '0'),
('18', '1', 'Mandarin', '858', '150000', 'trồng tại 	trung chanh', 'img\\Mandarin.jpg', 'lay tu dong', '0'),
('19', '1', 'kiwi', '578', '400000', 'trồng tại trung hiệp', 'img\\Kiwifruit.jpg', 'lay tu dong', '0'),
('20', '1', 'Soài', '358', '200000', 'trồng tại trung tân', 'img\\Mango.jpg', 'lay tu dong', '0'),
('21', '1', 'Orange', '452', '130000', 'trồng tại trung tân', 'img\\Orange.jpg', 'lay tu dong', '0'),
('22', '1', 'Đu đủ', '353', '100000', 'trồng tại trung tân', 'img\\Papaya.jpg', 'lay tu dong', '0'),
('23', '1', 'Peach', '358', '200000', 'trồng tại trung tân', 'img\\Peach.jpg', 'lay tu dong', '0'),
('24', '1', 'Pineapple', '358', '440000', 'trồng tại trung tân', 'img\\Pineapple.jpg', 'lay tu dong', '0'),
('25', '1', 'Plum', '329', '330000', 'trồng tại trung tân', 'img\\Plum.jpg', 'lay tu dong', '0'),
('26', '1', 'Chôm CHôm', '318', '157000', 'trồng tại trung tân', 'img\\Rambutan.jpg', 'lay tu dong', '0'),
('27', '1', 'Mãng cầu', '258', '126000', 'trồng tại trung tân', 'img\\Soursop.jpg', 'lay tu dong', '0'),
('28', '1', 'Khế', '358', '86000', 'trồng tại trung tân', 'img\\Starfruit.jpg', 'lay tu dong', '0');

