@extends('app')

@section('title', 'Kết quả tìm kiếm')

@section('content')
    <div class="container" id="search-results">
        <h1 class="mt-4">Kết quả tìm kiếm cho: "{{ $keyword }}"</h1>

        @if($products->isEmpty())
            <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
            <p>Tìm thấy {{ $products->count() }} sản phẩm phù hợp.</p>

            <table class="table table-hover table-bordered table-striped mt-3">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="text-center">Hình ảnh</th>
                        <th scope="col" class="text-center">Tên sản phẩm</th>
                        <th scope="col" class="text-center">Giá</th>
                        <th scope="col" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td class="text-success text-center">{{ number_format($product->price, 0, ',', '.') }} VND</td>
                            <td class="text-center">
                                <a href="#" data-url="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-success load-content">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
        <style>/* Bảng tìm kiếm */
            .table th {
                background-color: #ffedcc; /* Màu nền tiêu đề tông cam nhạt */
                font-weight: bold;
                color: #d35400; /* Tông cam đậm cho chữ */
                text-transform: uppercase;
                font-size: 14px;
                text-align: center;
                border-bottom: 2px solid #ffa500; /* Viền dưới tông cam nổi bật */
            }

            .table td {
                vertical-align: middle;
                font-size: 15px;
                color: #444; /* Màu chữ xám đậm */
                border-color: #ffe4b5; /* Viền nhạt giữa các hàng */
            }

            .table img {
                max-width: 80px;
                border-radius: 8px; /* Bo góc cho hình ảnh */
                border: 1px solid #f0ad4e; /* Viền mỏng cam nhạt */
            }

            /* Nút xem chi tiết */
            .btn-success {
                background: linear-gradient(135deg, #ff9f43, #ff6f00); /* Nút chuyển màu cam rực rỡ */
                border: none;
                font-weight: bold;
                color: #fff;
                text-transform: uppercase;
                transition: all 0.3s ease-in-out;
            }

            .btn-success:hover {
                background: linear-gradient(135deg, #ff6f00, #d35400); /* Hiệu ứng hover với tông cam đậm */
                transform: scale(1.05); /* Phóng to nhẹ khi hover */
                color: #fff;
            }

            /* Kết quả tìm kiếm */
            #search-results {
                margin-top: 20px;
                padding: 25px;
                border: 1px solid #f8d7da; /* Viền nhạt */
                border-radius: 10px; /* Bo góc mượt hơn */
                background: linear-gradient(135deg, #fff, #fffaf0); /* Màu nền sáng với ánh cam nhẹ */
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); /* Đổ bóng tinh tế */
            }

            #search-results h1 {
                font-size: 26px;
                color: #ff6f00; /* Màu cam nổi bật */
                border-bottom: 3px solid #FFA500; /* Đường viền dưới dày hơn */
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            #search-results p {
                font-size: 17px;
                color: #555; /* Xám nhẹ hơn */
                font-style: italic;
            }

            /* Hover hiệu ứng cho hàng trong bảng */
            .table-hover tbody tr:hover {
                background-color: #fff5e1; /* Màu nền sáng cam khi hover */
                cursor: pointer;
            }

    </style>
@endsection
