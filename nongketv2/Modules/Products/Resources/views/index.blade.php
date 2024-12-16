
<link rel="stylesheet" href="{{ asset('static/backend/product/css/style.css') }}">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center">Add New Product</h2>
        </div>
        <div class="card-body">
            <!-- Hiển thị thông báo thành công -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hiển thị lỗi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form thêm sản phẩm -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Type -->
                <div class="mb-3">
                    <label for="product_type_id" class="form-label">Product Type:</label>
                    <select class="form-select" name="product_type_id" id="product_type_id" required>
                        <option value="" disabled selected>Select Product Type</option>
                        @foreach ($productTypes as $type)
                            <option value="{{ $type->product_type_id }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description"></textarea>
                </div>

                <!-- Origin -->
                <div class="mb-3">
                    <label for="origin" class="form-label">Origin:</label>
                    <input type="text" class="form-control" name="origin" id="origin" placeholder="Product Origin">
                </div>

                <!-- History -->
                <div class="mb-3">
                    <label for="history" class="form-label">History:</label>
                    <textarea class="form-control" name="history" id="history" rows="3" placeholder="Product History"></textarea>
                </div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" required>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Price" required>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" name="image" id="image" onchange="previewImage(event)">
                    <div class="mt-3 text-center">
                        <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 300px;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="{{ asset('static/backend/product/js/script.js') }}"></script>

