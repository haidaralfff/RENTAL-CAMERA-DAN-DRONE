/**
 * RENTCAM Main JavaScript
 * ---------------------------------------------------------
 * Centralized logic for UI interactions and confirmations.
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Initialize AOS (Animate on Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-in-out'
        });
    }

    // 2. Sidebar Toggle for Mobile
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar   = document.querySelector('.sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('open'));
    }

    // 3. Navbar Toggle for Mobile
    const navToggle = document.getElementById('navbar-toggle');
    const navCollapse = document.getElementById('navbar-collapse');
    if (navToggle && navCollapse) {
        navToggle.addEventListener('click', () => navCollapse.classList.toggle('show'));
    }

    // 4. Auto-dismiss Alerts
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            alert.style.transition = 'all 0.4s ease';
            setTimeout(() => alert.remove(), 400);
        }, 4000);
    });

    // 5. Logout Confirmation (SweetAlert2)
    document.querySelectorAll('.logout-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Mengambil nama aplikasi dari window object (yang kita inject dari PHP)
            const appName = window.RentCamConfig ? window.RentCamConfig.siteName : 'RENTCAM';
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: `${appName} Logout`,
                    text: `Apakah Anda yakin ingin keluar dari akun ${appName}?`,
                    icon: 'warning',
                    iconColor: '#DC2626',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Keluar',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'swal2-premium-popup',
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-outline'
                    },
                    buttonsStyling: false,
                    backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            } else {
                if (confirm(`Apakah Anda yakin ingin keluar dari ${appName}?`)) {
                    window.location.href = href;
                }
            }
        });
    });

    // 6. Password Visibility Toggle
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input && input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else if (input) {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
});
