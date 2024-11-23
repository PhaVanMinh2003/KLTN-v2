<div class="col">
            <h2 class="custom-orange">Giỏ Hàng Của Bạn</h2>
            <p>Kiểm tra các sản phẩm trong giỏ hàng và thực hiện thanh toán.</p>
            <button class="btn btn-danger" onclick="confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?') && document.getElementById('clear-cart-form').submit();">
                Xóa Toàn Bộ Giỏ Hàng
            </button>
            <form id="clear-cart-form" action="{{ route('cart.clear') }}" method="POST" style="display: none;">
                @csrf
            </form>
</div>
