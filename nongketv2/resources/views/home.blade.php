@section('title', 'Trang chủ')

<div class="header-container">
    <!-- Khối vuông 3D bên trái -->
    <div class="cube-container">
        <script>
            // Three.js code to create a cube
            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0xffffff);  // Đặt nền của scene là màu trắng

            const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);  // Tỷ lệ camera phải là 1 để đảm bảo vuông
            camera.position.z = 5;

            const renderer = new THREE.WebGLRenderer();
            renderer.setSize(250, 250);  // Đảm bảo chiều rộng và chiều cao của canvas là bằng nhau (250x250)
            document.querySelector('.cube-container').appendChild(renderer.domElement);

            // Thêm ánh sáng vào scene để chiếu sáng khối vuông
            const light = new THREE.AmbientLight(0xffffff); // Ánh sáng trắng
            scene.add(light);

            // Tạo hình khối vuông với kích thước 2x2x2
            const geometry = new THREE.BoxGeometry(3, 3, 3);  // Khối vuông có kích thước 2x2x2
            const material = new THREE.MeshStandardMaterial({ color: 0x00ff00 }); // Sử dụng MeshStandardMaterial
            const cube = new THREE.Mesh(geometry, material);
            scene.add(cube);

            function animate() {
                requestAnimationFrame(animate);
                cube.rotation.x += 0.01;
                cube.rotation.y += 0.01;
                renderer.render(scene, camera);
            }
            animate();
        </script>
    </div>

    <!-- Banner -->
    <img src="{{ asset('img/bannerFood.png') }}" alt="Banner Food" style="width: 85%; height: 300px; margin-bottom: 20px; display: block; position: relative; right: -1%; margin-left: auto;">
</div>

<main class="">
    @include('maincontent.featuredproducts')
    @include('maincontent.intro')
    @include('maincontent.productscategory')
    @include('maincontent.promotions')
    @include('maincontent.news')
    @include('maincontent.more-info')
</main>

<style>
/* Nền trắng cho toàn bộ container */
.header-container {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    position: relative;
    background-color: white;  /* Nền trắng cho toàn bộ container */
    padding: 20px;  /* Khoảng cách từ các cạnh của container */
}

/* Nền trắng cho khối vuông */
.cube-container {
    width: 250px;  /* Đặt kích thước của container chứa khối vuông */
    height: 250px;  /* Đặt chiều cao của container chứa khối vuông */
    margin-right: -30px;  /* Điều chỉnh vị trí của khối vuông */
    background-color: white;  /* Nền trắng cho khối vuông */
    overflow: hidden;  /* Ẩn phần ngoài khối vuông */
    z-index: 1; /* Đảm bảo khối vuông không bị che khuất */
}

img {
    z-index: 0;

</style>
