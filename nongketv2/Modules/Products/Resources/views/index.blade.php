
<link rel="stylesheet" href="{{ asset('static/backend/product/css/style.css') }}">
<div class="container mt-5">
<div class="card-header text-center text-white" style="margin-bottom: 10px;padding-bottom: 10px;background: linear-gradient(to right, #4CAF50, #D4A017, #8B4513); border-radius: 15px 15px 0 0;">

    <h2 class="fw-bold mb-1 text-white display-4">
        <i class="fas fa-leaf"></i> Thêm Nông Sản
    </h2>
    <p class="text-white mb-0 fs-5">
        Điền thông tin sản phẩm của bạn để đăng bài. Tạo cơ hội cho nông sản của bạn được nhiều người biết đến!
    </p>
    <div class="mt-3">
        <span class="badge bg-light text-dark shadow-sm">Chú ý: Hãy điền đầy đủ thông tin để bài đăng nổi bật hơn.</span>
    </div>
</div>
        <div class="card-body">
            <div class="row">
                <!-- Form Section -->
                <div class="col-md-7 p-4 rounded shadow-sm" style="background: linear-gradient(to bottom, #FDF5E6, #FAF3E0); border: 1px solid #D4A017;">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Type -->
                        <div class="mb-4">
                            <label for="product_type_id" class="form-label">
                                <i class="fas fa-leaf text-success"></i> <strong>Loại Nông Sản:</strong>
                            </label>
                            <select class="form-select border-0 shadow-sm" name="product_type_id" id="product_type_id" required>
                                <option value="" disabled selected>Chọn loại</option>
                                @foreach ($productTypes as $type)
                                    <option value="{{ $type->product_type_id }}">{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="fas fa-seedling text-success"></i> <strong>Tên Nông Sản:</strong>
                            </label>
                            <input type="text" class="form-control border-0 shadow-sm" name="name" id="name" placeholder="Nhập tên sản phẩm" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-success"></i> <strong>Mô Tả:</strong>
                            </label>
                            <textarea class="form-control border-0 shadow-sm" name="description" id="description" rows="3" placeholder="Nhập mô tả"></textarea>
                        </div>

                        <!-- Origin -->
                        <div class="mb-4">
                            <label for="origin" class="form-label">
                                <i class="fas fa-map-marker-alt text-success"></i> <strong>Xuất Xứ:</strong>
                            </label>
                            <input type="text" class="form-control border-0 shadow-sm" name="origin" id="origin" placeholder="Nhập xuất xứ">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="form-label">
                                <i class="fas fa-cubes text-success"></i> <strong>Số Lượng:</strong>
                            </label>
                            <input type="number" class="form-control border-0 shadow-sm" name="quantity" id="quantity" placeholder="Nhập số lượng" required>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">
                                <i class="fas fa-money-bill-wave text-success"></i> <strong>Giá (VNĐ):</strong>
                            </label>
                            <input type="number" step="0.01" class="form-control border-0 shadow-sm" name="price" id="price" placeholder="Nhập giá" required>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-camera text-success"></i> <strong>Hình Ảnh:</strong>
                            </label>
                            <input type="file" class="form-control border-0 shadow-sm" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50; padding: 10px 40px;">
                                <i class="fas fa-paper-plane"></i> Đăng Bài
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Phần Preview -->
                <div class="col-md-5">
                    <div class="border p-3 rounded"
                        style="background: linear-gradient(to bottom, #F9F9E3, #EAF8E0);
                                border: 2px solid #D4A017;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h5 class="fw-bold text-center mb-3 text-success">Xem Trước</h5>
                        <!-- Product Image Preview -->
                        <div class="text-center">
                            <img id="image-preview" src="#" alt="Hình Ảnh Nông Sản"
                                class="img-thumbnail d-none"
                                style="max-width: 250px; border: 2px solid #D4A017;">
                        </div>

                        <!-- Preview Details -->
                        <div id="product-preview-details" class="mt-3"
                            style="font-size: 1rem; color: #4CAF50;">
                            <p><i class="fas fa-seedling text-success"></i> <strong>Tên:</strong> <span id="preview-name">N/A</span></p>
                            <p><i class="fas fa-leaf text-success"></i> <strong>Loại:</strong> <span id="preview-type">N/A</span></p>
                            <p><i class="fas fa-money-bill-wave text-success"></i> <strong>Giá:</strong> <span id="preview-price">N/A</span> VNĐ</p>
                            <p><i class="fas fa-align-left text-success"></i> <strong>Mô Tả:</strong> <span id="preview-description">N/A</span></p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4 class="highlight text-center">Bài Viết Liên Quan</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzlVRrbedAnaG1bNBrKgouLD6Asuxgo3-g2A&s" class="card-img-top" alt="Bài viết 1">
                                <div class="card-body">
                                    <h5 class="card-title highlight">Cách trồng rau sạch tại nhà</h5>
                                    <p class="card-text">Tìm hiểu về các kỹ thuật trồng rau sạch đơn giản và hiệu quả ngay tại nhà...</p>
                                    <a href="#" class="btn btn-outline-warning">Đọc thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="data:image/jpeg;base64,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" class="card-img-top" alt="Bài viết 2">
                                <div class="card-body">
                                    <h5 class="card-title highlight">Chọn lựa trái cây tươi ngon</h5>
                                    <p class="card-text">Khám phá cách chọn trái cây tươi ngon và đảm bảo sức khỏe cho gia đình bạn...</p>
                                    <a href="#" class="btn btn-outline-warning">Đọc thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mt-5 text-center">
                    <h4 class="highlight">Chia sẻ sản phẩm này với bạn bè!</h4>
                    <button class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</button>
                    <button class="btn btn-outline-info"><i class="fab fa-twitter"></i> Twitter</button>
                    <button class="btn btn-outline-danger"><i class="fab fa-instagram"></i> Instagram</button>
                </div>
                <div class="chatbot-btn col-mt-5 text-right">
                    <button class="btn btn-outline-info">
                        <i class="fas fa-comments"></i> Chat với chúng tôi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("image").addEventListener("change", function (event) {
        const imagePreview = document.getElementById("image-preview");
        const file = event.target.files[0];

        if (file) {
            const objectURL = URL.createObjectURL(file);
            imagePreview.src = objectURL;
            imagePreview.classList.remove("d-none");
        } else {
            imagePreview.src = "#";
            imagePreview.classList.add("d-none");
        }
    });

    // Cập nhật các trường preview
    document.getElementById("name").addEventListener("input", function () {
        document.getElementById("preview-name").textContent = this.value || "N/A";
    });

    document.getElementById("product_type_id").addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById("preview-type").textContent = selectedOption.text || "N/A";
    });

    document.getElementById("price").addEventListener("input", function () {
        document.getElementById("preview-price").textContent = this.value || "N/A";
    });

    document.getElementById("description").addEventListener("input", function () {
        document.getElementById("preview-description").textContent = this.value || "N/A";
    });
</script>
<script src="{{ asset('static/backend/product/js/script.js') }}"></script>

