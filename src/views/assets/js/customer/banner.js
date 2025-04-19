document.addEventListener('DOMContentLoaded', () => {
    const sliderContainer = document.getElementById('image-slider');
    const slider = sliderContainer.querySelector('.slider');
    const slides = slider.querySelectorAll('.slide');
    const prevBtn = sliderContainer.querySelector('.prev');
    const nextBtn = sliderContainer.querySelector('.next');
    const totalSlides = slides.length;

    let currentIndex = 0;
    let autoSlideInterval;

    // Khởi tạo slider
    function initSlider() {
        // Thêm sự kiện cho các nút
        prevBtn.addEventListener('click', () => navigateSlide(-1));
        nextBtn.addEventListener('click', () => navigateSlide(1));

        // Bắt đầu tự động chuyển slide
        startAutoSlide();

        // Dừng tự động chuyển khi hover vào slider
        sliderContainer.addEventListener('mouseenter', stopAutoSlide);
        sliderContainer.addEventListener('mouseleave', startAutoSlide);

        // Thêm hỗ trợ swipe cho thiết bị cảm ứng
        setupTouchEvents();
    }

    // Điều hướng đến slide cụ thể
    function showSlide(index) {
        currentIndex = (index + totalSlides) % totalSlides;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    // Điều hướng tiến/lùi
    function navigateSlide(direction) {
        showSlide(currentIndex + direction);
    }

    // Bắt đầu tự động chuyển slide
    function startAutoSlide() {
        stopAutoSlide(); // Tránh nhiều interval chạy đồng thời
        autoSlideInterval = setInterval(() => navigateSlide(1), 5000);
    }

    // Dừng tự động chuyển slide
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Thiết lập sự kiện swipe cho thiết bị cảm ứng
    function setupTouchEvents() {
        let touchStartX = 0;
        let touchEndX = 0;

        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const SWIPE_THRESHOLD = 50;
            if (touchStartX - touchEndX > SWIPE_THRESHOLD) {
                navigateSlide(1); // Swipe trái -> slide tiếp theo
            } else if (touchEndX - touchStartX > SWIPE_THRESHOLD) {
                navigateSlide(-1); // Swipe phải -> slide trước
            }
        }
    }

    // Khởi tạo slider
    initSlider();
});