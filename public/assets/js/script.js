document.addEventListener('DOMContentLoaded', function () {
    // Sidebar Toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const header = document.getElementById('header');
    const mainContent = document.getElementById('mainContent');
    const footer = document.getElementById('footer');
    const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');

    menuToggle.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        header.classList.toggle('sidebar-collapsed');
        mainContent.classList.toggle('expanded');
        footer.classList.toggle('expanded');

        // On mobile, show the sidebar
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
            // show close button on mobile
            if (sidebar.classList.contains('show')) {
                sidebarCloseBtn.style.display = 'block';
            } else {
                sidebarCloseBtn.style.display = 'none';
            }
        }
    });

    sidebarCloseBtn.addEventListener('click', function () {
        sidebar.classList.remove('show');
        sidebarCloseBtn.style.display = 'none';
    });

    // Sidebar Submenu Toggles
    const submenuToggles = [
        { toggle: 'riverPointsToggle', submenu: 'riverPointsSubmenu' },
        { toggle: 'sandTypesToggle', submenu: 'sandTypesSubmenu' },
        { toggle: 'sandStocksToggle', submenu: 'sandStocksSubmenu' },
        { toggle: 'tendersToggle', submenu: 'tendersSubmenu' },
        { toggle: 'salesToggle', submenu: 'salesSubmenu' },
        { toggle: 'vehiclesToggle', submenu: 'vehiclesSubmenu' },
        { toggle: 'workersToggle', submenu: 'workersSubmenu' },
        { toggle: 'majhiToggle', submenu: 'majhiSubmenu' },
        { toggle: 'equipmentToggle', submenu: 'equipmentSubmenu' },
        { toggle: 'reportsToggle', submenu: 'reportsSubmenu' },
        { toggle: 'settingsToggle', submenu: 'settingsSubmenu' }
    ];

    submenuToggles.forEach(({ toggle, submenu }) => {
        const toggleElement = document.getElementById(toggle);
        const submenuElement = document.getElementById(submenu);

        toggleElement.addEventListener('click', function (e) {
            e.preventDefault();
            submenuElement.classList.toggle('show');

            const chevron = toggleElement.querySelector('.bi-chevron-down, .bi-chevron-up');
            if (chevron) {
                chevron.classList.toggle('bi-chevron-down');
                chevron.classList.toggle('bi-chevron-up');
            }
        });
    });

    // User Dropdown Toggle
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userDropdown.addEventListener('click', function (e) {
        e.stopPropagation();
        userDropdownMenu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function () {
        userDropdownMenu.classList.remove('show');
    });

    // Sidebar Active Item
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    sidebarItems.forEach(item => {
        item.addEventListener('click', function () {
            sidebarItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales (₹)',
                data: [1200000, 1900000, 1500000, 2100000, 2300000, 2500000],
                backgroundColor: 'rgba(63, 108, 173, 0.1)',
                borderColor: 'rgba(63, 108, 173, 1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(63, 108, 173, 1)',
                pointBorderColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 14
                    },
                    padding: 10,
                    callbacks: {
                        label: function (context) {
                            return 'Sales: ₹' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function (value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Sand Types Chart
    const sandTypesCtx = document.getElementById('sandTypesChart').getContext('2d');
    const sandTypesChart = new Chart(sandTypesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Construction Grade', 'Premium Quality', 'Fine Sand', 'Coarse Sand', 'Specialized'],
            datasets: [{
                data: [45, 30, 15, 7, 3],
                backgroundColor: [
                    'rgba(63, 108, 173, 0.8)',
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(23, 162, 184, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 15,
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 14
                    },
                    padding: 10,
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Fade in animation for cards
    const fadeElements = document.querySelectorAll('.fade-in');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    fadeElements.forEach(element => {
        element.style.opacity = 0;
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(element);
    });

    // Responsive handling
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('show');
        }
    });
});