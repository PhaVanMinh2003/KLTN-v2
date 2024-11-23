<div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title custom-header">Tổng Giỏ Hàng</h5>
                    <div class="row">
                        <div class="col-6">Tổng cộng</div>
                        <div class="col-6 text-right">
                            <span class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; })) }}₫</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Phí vận chuyển</div>
                        <div class="col-6 text-right"><span class="custom-price">30,000₫</span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">Giảm giá</div>
                        <div class="col-6 text-right"><span class="custom-price">-50,000₫</span></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6"><strong>Tổng Cộng</strong></div>
                        <div class="col-6 text-right">
                            <strong class="custom-price">{{ number_format($cart->cartItems->sum(function($item) { return $item->price * $item->quantity; }) + 30000 - 50000) }}₫</strong>
                        </div>
                    </div>
                    <a href="#" class="btn custom-button btn-block mt-4">Tiến Hành Thanh Toán</a>
                    <a href="#" class="btn btn-outline-secondary btn-block mt-2">Cập Nhật Giỏ Hàng</a>
                </div>
</div>
