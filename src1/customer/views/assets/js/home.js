document.addEventListener('DOMContentLoaded', () => {
    // Lấy tất cả các phần tử trong header có class 'nav-link'
    const navLinks = document.querySelectorAll('.nav-link');

    // Lặp qua từng phần tử và gắn sự kiện click
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Xóa class 'active' khỏi tất cả các phần tử
            navLinks.forEach(nav => nav.classList.remove('active'));

            // Thêm class 'active' vào phần tử được click
            link.classList.add('active');

            e.preventDefault(); 
        });
    });
});


