@foreach($cart->cartItems as $item)
        <div class="col-12 mb-4">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" alt="Sản phẩm" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">{{ $item->product->description ?? 'Mô tả sản phẩm chi tiết' }}</p>

                            <!-- Form gửi yêu cầu xóa sản phẩm -->
                            <form action="{{ route('cart.removeItem', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Xoá</button>
                            </form>

                            @if($item->quantity > $item->product->stock)
                                <p class="text-danger mt-2">Sản phẩm này chỉ còn {{ $item->product->stock }} trong kho!</p>
                            @endif
                        </div>

                        <div class="col-md-2">
                            <input type="number" class="form-control" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="price">{{ number_format($item->price) }}₫</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
