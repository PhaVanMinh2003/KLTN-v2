<div class="card custom-card">
    <div class="card-body">
        <h5 class="card-title">Mã Giảm Giá</h5>
        <form action="{{ route('cart.applyDiscount', ['cartId' => $cartId]) }}" method="POST">
            @csrf
            <input type="text" class="form-control mb-3" name="discount_code" placeholder="Nhập mã giảm giá">
            <button type="submit" class="btn custom-button">Áp Dụng</button>
        </form>
        @if(session('discount_amount'))
            <p class="text-success mt-2">Đã áp dụng mã giảm giá: -{{ number_format(session('discount_amount')) }}₫</p>
        @endif
    </div>
</div>
