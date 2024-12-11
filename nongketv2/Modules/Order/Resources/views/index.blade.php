@section('content')
<div class="container">
    <h1>Đặt Hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ number_format($item['price'], 0, ',', '.') }} VND</td>
                <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('order.create') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
    </form>
</div>
@endsection
