document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('mainImage');
    const galleryImages = document.querySelectorAll('.gallery-image');

    galleryImages.forEach(image => {
        image.addEventListener('click', () => {
            // Đổi hình ảnh chính
            mainImage.src = image.src;

            // Thêm hiệu ứng viền cho hình ảnh được chọn
            galleryImages.forEach(img => img.style.borderColor = 'transparent');
            image.style.borderColor = '#007bff';
        });
    });
});