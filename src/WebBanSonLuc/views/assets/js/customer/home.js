
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

// Sample data for testimonials
const testimonials = [
    {
        name: "Anh Long Neuvillete",
        role: "Chủ nhà",
        content: "Tôi rất hài lòng với chất lượng sơn và dịch vụ tư vấn tận tình của ColorMaster. Căn nhà của tôi trông như mới sau khi sơn.",
        image: "../assets/images/Neuvillete.jpeg"
    },
    {
        name: "Kaveh Trần",
        role: "Kiến trúc sư",
        content: "Là một kiến trúc sư, tôi luôn tìm kiếm những sản phẩm chất lượng cao cho khách hàng. ColorMaster luôn là sự lựa chọn hàng đầu của tôi.",
        image: "../assets/images/Kaveh.jpeg"
    },
    {
        name: "Kamisato Ayaka",
        role: "Nhà thầu",
        content: "Đã hợp tác với ColorMaster trong nhiều dự án và luôn hài lòng với chất lượng sản phẩm và dịch vụ giao hàng đúng hẹn.",
        image: "../assets/images/Ayaka.jpeg"
    }
];

$(document).ready(function() {
    // Example 1: Change all HTML elements - Dynamically adding products
    function renderProducts(productList) {
        const productContainer = $('#productsList');
        productContainer.empty();
        
        productList.forEach(product => {
            const discountBadge = product.discount > 0 ? 
                `<div class="promotion-badge">-${product.discount}%</div>` : '';
            
            const finalPrice = product.discount > 0 ? 
                product.price * (1 - product.discount/100) : product.price;
            
            const productCard = `
                <div class="col-md-4 product-item" data-category="${product.category}">
                    <div class="card product-card position-relative">
                        ${discountBadge}
                        <img src="${product.image}" class="card-img-top" alt="${product.name}">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    ${product.discount > 0 ? 
                                        `<span class="text-muted text-decoration-line-through">${product.price.toLocaleString()}đ</span> ` : ''}
                                    <span class="fw-bold text-primary">${finalPrice.toLocaleString()}đ</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-product-id="${product.id}">
                                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            productContainer.append(productCard);
        });
    }
    
    // Initial product rendering
    renderProducts(products);
    
    // Example 2: Change HTML attributes - Product filtering
    $('.filter-btn').on('click', function() {
        // Change active class attribute
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if (filter === 'all') {
            renderProducts(products);
        } else {
            const filteredProducts = products.filter(product => product.category === filter);
            renderProducts(filteredProducts);
        }
    });
    
    // Example 3: Change CSS styles - Theme toggle
    // $('#themeToggle').on('click', function() {
    //     // Toggle dark mode
    //     $('body').toggleClass('bg-dark text-white');
    //     $('.card').toggleClass('bg-dark text-white border-light');
    //     $('.bg-light').toggleClass('bg-secondary');
        
    //     // Change the icon and text
    //     const icon = $(this).find('i');
    //     if (icon.hasClass('fa-moon')) {
    //         icon.removeClass('fa-moon').addClass('fa-sun');
    //         $(this).html('<i class="fas fa-sun"></i> Chế độ sáng');
    //     } else {
    //         icon.removeClass('fa-sun').addClass('fa-moon');
    //         $(this).html('<i class="fas fa-moon"></i> Chế độ tối');
    //     }
    // });

    
    // Example 4: Remove HTML elements - Remove product cards
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        
 
        const productName = products.find(p => p.id === productId).name;
        const notification = $(`
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
                <strong>Đã thêm!</strong> ${productName} đã được thêm vào giỏ hàng.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
        
        $('body').append(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.alert('close');
        }, 3000);
    });
    
    // Example 5: Add new HTML elements - Render testimonials dynamically
    function renderTestimonials() {
        const testimonialsContainer = $('#testimonialsList');
        
        testimonials.forEach(testimonial => {
            const testimonialCard = $(`
                <div class="col-md-4 mb-4">
                    <div class="testimonial">
                        <div class="d-flex mb-3">
                            <img src="${testimonial.image}" class="rounded-circle me-3" alt="${testimonial.name}" width="50" height="50">
                            <div>
                                <h5 class="mb-0">${testimonial.name}</h5>
                                <p class="text-muted mb-0">${testimonial.role}</p>
                            </div>
                        </div>
                        <p class="mb-0">${testimonial.content}</p>
                    </div>
                </div>
            `);
            
            testimonialsContainer.append(testimonialCard);
        });
    }
    
    renderTestimonials();
    
    // Example 6: React to HTML events - Color selector tool
    function updateColorPreview() {
        const red = $('#redRange').val();
        const green = $('#greenRange').val();
        const blue = $('#blueRange').val();
        
        const colorHex = rgbToHex(red, green, blue);
        
        $('#colorPreview').css('backgroundColor', `rgb(${red}, ${green}, ${blue})`);
        $('#colorHex').val(colorHex);
    }
    
    function rgbToHex(r, g, b) {
        return "#" + ((1 << 24) + (parseInt(r) << 16) + (parseInt(g) << 8) + parseInt(b)).toString(16).slice(1).toUpperCase();
    }

// Event listeners cho thanh trượt màu
$('#redRange, #greenRange, #blueRange').on('input', updateColorPreview);

// Khởi tạo màu mặc định
updateColorPreview();

// Xử lý nút lưu màu
$('#saveColorBtn').on('click', function() {
    const colorHex = $('#colorHex').val();
    const savedColors = JSON.parse(localStorage.getItem('savedColors') || '[]');
    
    savedColors.push({
        hex: colorHex,
        timestamp: new Date().toISOString()
    });
    
    localStorage.setItem('savedColors', JSON.stringify(savedColors));
    
    // thông báo
    const notification = $(`
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
            <strong>Đã lưu!</strong> Mã màu ${colorHex} đã được lưu lại.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
    
    $('body').append(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.alert('close');
    }, 3000);
    
    // Tùy chọn: Thêm mẫu màu vào danh sách đã lưu
    displaySavedColors();
});

// Hàm hiển thị các màu đã lưu
function displaySavedColors() {

    if ($('#savedColorsList').length === 0) {
        // Tạo phần hiển thị màu đã lưu
        const savedColorsContainer = $(`
            <div class="mt-4">
                <h6>Các màu đã lưu</h6>
                <div id="savedColorsList" class="d-flex flex-wrap gap-2"></div>
            </div>
        `);
        
        $('#colorPreview').after(savedColorsContainer);
    }
    
    // Lấy danh sách màu đã lưu
    const savedColors = JSON.parse(localStorage.getItem('savedColors') || '[]');
    const container = $('#savedColorsList');
    
    container.empty();
    
    // Hiển thị các màu đã lưu
    savedColors.forEach((color, index) => {
        const colorElement = $(`
            <div class="saved-color d-flex flex-column align-items-center">
                <div style="width: 30px; height: 30px; background-color: ${color.hex}; border: 1px solid #ddd; cursor: pointer;" 
                     data-hex="${color.hex}" title="Áp dụng màu này"></div>
                <small>${color.hex}</small>
            </div>
        `);
        
        container.append(colorElement);
    });
    
    // Thêm event áp dụng màu đã lưu
    $('.saved-color div').on('click', function() {
        const hex = $(this).data('hex');
        const rgb = hexToRgb(hex);
        
        $('#redRange').val(rgb.r);
        $('#greenRange').val(rgb.g);
        $('#blueRange').val(rgb.b);
        
        updateColorPreview();
    });
}

// Hàm chuyển từ hex sang rgb
function hexToRgb(hex) {

    hex = hex.replace('#', '');
    
    // Chuyển đổi hex sang rgb
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);
    
    return { r, g, b };
}

displaySavedColors();
}
)
