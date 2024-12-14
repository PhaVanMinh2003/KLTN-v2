@extends('app')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container" id="search-results">
    <h1 class="mt-4"><i class="fas fa-search"></i> Kết quả tìm kiếm cho: "{{ $keyword }}"</h1>

    @if($products->isEmpty())
        <p><i class="fas fa-exclamation-circle"></i> Không tìm thấy sản phẩm nào phù hợp.</p>
    @else
        <p><i class="fas fa-check-circle"></i> Tìm thấy {{ $products->count() }} sản phẩm phù hợp.</p>

        <table class="table table-hover table-bordered table-striped mt-3">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td class="text-success">{{ number_format($product->price, 0, ',', '.') }} VND</td>
                        <td>
                            <a href="#" data-url="{{ route('showProductDetail', $product->product_id) }}" class="btn btn-success load-content">
                                <i class="fas fa-info-circle"></i> Xem chi tiết
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<style>/*/* Toàn bộ container */
.container {
    background-color: #fdf4e3; /* Màu vàng nhạt nhẹ */
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    font-family: 'Roboto', sans-serif; /* Font hiện đại */
}

.container:hover {
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

/* Tiêu đề chính */
.container h1 {
    color: #b2760c; /* Màu vàng đậm hơn cho nổi bật */
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.container h1 i {
    color: #b2760c; /* Icon cùng màu chữ */
}

/* Thông báo kết quả */
.container p {
    color: #4a4a4a;
    font-size: 18px;
    margin-bottom: 20px;
    font-style: italic;
    text-align: center;
}

/* Bảng */
.table {
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    font-size: 15px;
    border-collapse: separate;
    border-spacing: 0 8px;
    margin-top: 15px;
}

/* Header của bảng */
.table thead {
    background-color: #ffcc80; /* Màu vàng cam tươi */
    color: #4a4a4a;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
}

/* Các ô */
.table td,
.table th {
    text-align: center;
    vertical-align: middle;
    padding: 15px;
    border-bottom: 1px solid #eee;
}

/* Hàng hover */
.table-hover tbody tr:hover {
    background-color: #fff3e0; /* Vàng nhạt hơn cho tương tác */
    transition: background-color 0.3s ease;
}

/* Hình ảnh sản phẩm */
.img-fluid {
    border: 3px solid #ffcc80;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.img-fluid:hover {
    transform: scale(1.05);
}

/* Nút hành động */
.btn-success {
    background-color: #b2760c;
    border: none;
    color: #ffffff;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-success i {
    font-size: 16px;
}

.btn-success:hover {
    background-color: #935c09;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Footer bảng */
tfoot td {
    font-weight: bold;
    color: #b2760c;
    background-color: #fff9f2;
    text-align: center;
    padding: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    .table td,
    .table th {
        font-size: 13px;
        padding: 10px;
    }

    .container h1 {
        font-size: 24px;
    }
}

    </style>
@endsection
