// var ctx = document.getElementById('salesChart').getContext('2d');
// var salesChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Sơn Dulux', 'Sơn Jotun', 'Sơn TOA', 'Sơn Nippon'],
//         datasets: [{
//             label: 'Số lượng bán',
//             data: [145, 132, 98, 87],
//             backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
//             borderColor: ['#D62F6D', '#2589CC', '#E5A444', '#3B8B3B'],
//             borderRadius: 10,
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

// Dữ liệu mẫu về sản phẩm bán chạy
const productData = [
    { name: "Sản phẩm 1", count: 1200, color: "#4e73df" },
    { name: "Sản phẩm 2", count: 850, color: "#1cc88a" },
    { name: "Sản phẩm 3", count: 750, color: "#36b9cc" },
    { name: "Sản phẩm 4", count: 600, color: "#f6c23e" },
    { name: "Sản phẩm 5", count: 450, color: "#e74a3b" }
];

// Tính tổng số lượng để tính phần trăm
const totalCount = productData.reduce((sum, product) => sum + product.count, 0);

// Cập nhật bảng dữ liệu
const productTable = document.getElementById('productTable');
productData.forEach(product => {
    const percentage = ((product.count / totalCount) * 100).toFixed(1);
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <div class="d-flex align-items-center">
                <div style="width: 15px; height: 15px; background-color: ${product.color}; margin-right: 10px; border-radius: 3px;"></div>
                ${product.name}
            </div>
        </td>
        <td>${product.count.toLocaleString()}</td>
        <td>${percentage}%</td>
    `;
    productTable.appendChild(row);
});

// Tạo biểu đồ tròn
const ctx = document.getElementById('productPieChart').getContext('2d');
const productPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: productData.map(product => product.name),
        datasets: [{
            data: productData.map(product => product.count),
            backgroundColor: productData.map(product => product.color),
            borderWidth: 1,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    boxWidth: 15,
                    font: {
                        size: 14
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const percentage = ((value / totalCount) * 100).toFixed(1);
                        return `${label}: ${value.toLocaleString()} (${percentage}%)`;
                    }
                }
            }
        }
    }
});

const dailyRevenueData = [
    { period: '01/03/2025', revenue: 5200000, change: '+2.5%' },
    { period: '02/03/2025', revenue: 4800000, change: '-7.7%' },
    { period: '03/03/2025', revenue: 5500000, change: '+14.6%' },
    { period: '04/03/2025', revenue: 5700000, change: '+3.6%' },
    { period: '05/03/2025', revenue: 6100000, change: '+7.0%' },
    { period: '06/03/2025', revenue: 6300000, change: '+3.3%' },
    { period: '07/03/2025', revenue: 5900000, change: '-6.3%' },
    { period: '08/03/2025', revenue: 6500000, change: '+10.2%' },
    { period: '09/03/2025', revenue: 6800000, change: '+4.6%' },
    { period: '10/03/2025', revenue: 7200000, change: '+5.9%' }
];

// Dữ liệu mẫu về doanh thu theo tháng
const monthlyRevenueData = [
    { period: '10/2024', revenue: 120000000, change: '+5.3%' },
    { period: '11/2024', revenue: 135000000, change: '+12.5%' },
    { period: '12/2024', revenue: 150000000, change: '+11.1%' },
    { period: '01/2025', revenue: 142000000, change: '-5.3%' },
    { period: '02/2025', revenue: 155000000, change: '+9.2%' },
    { period: '03/2025', revenue: 168000000, change: '+8.4%' }
];

// Biến để lưu trữ biểu đồ hiện tại
let currentChart = null;
// Biến để lưu trữ chế độ hiển thị (theo ngày hoặc theo tháng)
let currentMode = 'day';

// Hàm để hiển thị dữ liệu trong bảng
function updateTable(data) {
    const tableBody = document.getElementById('revenueTable');
    tableBody.innerHTML = '';

    data.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.period}</td>
            <td>${item.revenue.toLocaleString()} VNĐ</td>
            <td>
                <span class="${item.change.includes('+') ? 'text-success' : 'text-danger'}">
                    ${item.change}
                </span>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Hàm để cập nhật thông tin tổng quan
function updateSummary(data) {
    const totalRevenue = data.reduce((sum, item) => sum + item.revenue, 0);
    document.getElementById('totalRevenue').textContent = `${totalRevenue.toLocaleString()} VNĐ`;
    
    const growth = currentMode === 'day' ? '8.5%' : '12.5%';
    document.getElementById('growth').textContent = growth;
}

// Hàm để tạo hoặc cập nhật biểu đồ
function updateChart(data) {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Hủy biểu đồ cũ nếu tồn tại
    if (currentChart) {
        currentChart.destroy();
    }
    
    // Tạo biểu đồ mới
    currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.period),
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: data.map(item => item.revenue),
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' VNĐ';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Doanh thu: ${context.raw.toLocaleString()} VNĐ`;
                        }
                    }
                }
            }
        }
    });
}

// Hàm để chuyển đổi giữa chế độ hiển thị theo ngày và theo tháng
function switchMode(mode) {
    currentMode = mode;
    const data = mode === 'day' ? dailyRevenueData : monthlyRevenueData;
    
    updateTable(data);
    updateSummary(data);
    updateChart(data);
    
    // Cập nhật nút active
    document.getElementById('dayBtn').classList.toggle('active', mode === 'day');
    document.getElementById('monthBtn').classList.toggle('active', mode === 'month');
}

// Xử lý sự kiện cho các nút chuyển đổi
document.getElementById('dayBtn').addEventListener('click', function() {
    switchMode('day');
});

document.getElementById('monthBtn').addEventListener('click', function() {
    switchMode('month');
});

// Khởi tạo ban đầu với chế độ hiển thị theo ngày
switchMode('day');