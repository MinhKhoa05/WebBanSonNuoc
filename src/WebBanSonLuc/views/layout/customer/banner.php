<!-- banner section -->
<style>
    /* Điều chỉnh chiều cao của slide */
    .slider {
        height: 300px; /* Chiều cao cố định */
        position: relative; /* Để sử dụng cho các nút điều hướng */
        display: flex; /* Sử dụng flexbox để căn giữa hình ảnh */
        justify-content: center; /* Căn giữa theo chiều ngang */
        align-items: center; /* Căn giữa theo chiều dọc */
        
    }

    /* Đảm bảo slide không bị méo khi thay đổi kích thước */
    .slider img {
        height: 300px; /* Chiều cao cố định nhỏ hơn */
        object-fit: cover; /* Đảm bảo hình ảnh giữ tỷ lệ */
    }
</style>
<section class="slider text-center py-2" id="image-slider">
    <div>
        <button class="slider-btn prev" aria-label="Hình ảnh trước">&#10094;</button>
        <div class="slider py-2">
            <a href="https://example.com/product1" class="slide"><img src="views/assets/images/Background.png"
                    alt="Sự kiện 1" loading="lazy"></a>
            <a href="https://example.com/product2" class="slide"><img src="views/assets/images/Background.png"
                    alt="Sự kiện 2" loading="lazy"></a>
            <a href="https://example.com/product3" class="slide"><img src="views/assets/images/Background.png"
                    alt="Sự kiện 3" loading="lazy"></a>
        </div>
        <button class="slider-btn next" aria-label="Hình ảnh tiếp theo">&#10095;</button>
    </div>
</section>