<div class="container my-5">
    <div class="row mb-4 text-center">
    @include('cart::title')
    </div>
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
    @include('cart::productList')
    </div>
    <div class="row mt-5">
        <div class="col-md-8">
        @include('cart::discount')
        </div>
        <div class="col-md-4">
        @include('cart::totalAmount')
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-left">
            <a href="" class="btn btn-outline-secondary">Tiếp Tục Mua Sắm</a>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('input[name^="items"]').forEach(input => {
    input.addEventListener('change', function () {
        const cartItemId = this.name.match(/\d+/)[0];
        const quantity = this.value;

        fetch(`/cart/update/${cartItemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.error);
            }
        });
    });
});
</script>

<style>
    .custom-orange {
        background-color: #FF7A00;
        color: white;
    }

    .custom-button {
        background-color: #FF7A00;
        border-color: #FF7A00;
        color: white;
    }

    .custom-button:hover {
        background-color: #FF5A00;
        border-color: #FF5A00;
        color: white;
    }

    .custom-card {
        border: 1px solid #FF7A00;
        border-radius: 8px;
    }

    .custom-header {
        font-size: 24px;
        font-weight: bold;
    }

    .custom-price {
        color: #FF7A00;
        font-weight: bold;
    }

    .price {
        font-size: 18px;
        font-weight: 600;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .card-title {
        font-size: 18px;
    }

</style>
