// Price range slider
const priceRange = document.getElementById('priceRange');
const priceValue = document.getElementById('priceValue');

priceRange.addEventListener('input', function() {
    const value = parseInt(this.value).toLocaleString('vi-VN');
    priceValue.textContent = value + 'đ';
});

// Filter functionality
document.querySelectorAll('.sidebar-link, .filter-btn').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Update active state for sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.classList.remove('active');
        });
        this.classList.add('active');
        
        // Update active state for filter buttons if clicked from sidebar
        const filter = this.getAttribute('data-filter');

        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            if (['dulux', 'jotun', 'maxilite', 'kova', 'nippon', 'toa', 'mykolor', 'expo', 'da-hoabinh', 'trong-tham'].includes(filter) && btn.getAttribute('data-filter') === filter) {
                btn.classList.add('active');
            }
        });
        
        // Filter products logic would go here
        console.log('Filtering by:', filter);
    });
});