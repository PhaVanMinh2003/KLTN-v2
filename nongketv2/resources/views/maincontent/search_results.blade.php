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
        <style>
            .table th {
        background-color: #f8f9fa; /* Màu nền cho tiêu đề bảng */
        font-weight: bold;
    }

    .table td {
        vertical-align: middle; /* Căn giữa theo chiều dọc */
    }

    .table img {
        max-width: 100px; /* Đảm bảo hình ảnh không quá lớn */
        height: auto; /* Giữ tỷ lệ hình ảnh */
    }
    #search-results {
    margin-top: 20px; /* Khoảng cách phía trên cho toàn bộ phần kết quả tìm kiếm */
    padding: 20px; /* Padding cho phần nội dung */
    border: 1px solid #e0e0e0; /* Đường viền nhẹ xung quanh phần kết quả tìm kiếm */
    border-radius: 8px; /* Bo góc cho phần kết quả tìm kiếm */
    background-color: #f9f9f9; /* Màu nền nhẹ cho phần kết quả */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ cho phần kết quả */
}

#search-results h1 {
    font-size: 24px; /* Kích thước chữ cho tiêu đề */
    color: #333; /* Màu chữ tối hơn cho tiêu đề */
    border-bottom: 2px solid #007bff; /* Đường viền dưới tiêu đề để tạo điểm nhấn */
    padding-bottom: 10px; /* Khoảng cách phía dưới cho tiêu đề */
}

#search-results p {
    font-size: 16px; /* Kích thước chữ cho đoạn văn */
    color: #666; /* Màu chữ xám cho đoạn văn */
    margin-top: 10px; /* Khoảng cách phía trên cho đoạn văn */
}

    </style>
@endsection
