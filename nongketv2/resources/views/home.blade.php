@section('title', 'Trang chủ')
<img src="{{ asset('img/bannerFood.png') }}" alt="Banner Food" style="width: 100%; height: 200px; margin-bottom: 20px; display: block; position: relative; right: -1%; margin-left: auto;">
<main class="">
    @include('maincontent.featuredproducts')
    @include('maincontent.intro')
    @include('maincontent.productscategory')
    @include('maincontent.promotions')
    @include('maincontent.news')
    @include('maincontent.more-info')
</main>
