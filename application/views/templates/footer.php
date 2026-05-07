    <footer class="footer">
        <p>© <?= date('Y') ?> <strong style="color:#fff">RENTCAM</strong> — Platform Rental Kamera & Drone</p>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-in-out'
    });

    // Sidebar toggle for mobile
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar   = document.querySelector('.sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('open'));
    }

    // Navbar toggle for mobile
    const navToggle = document.getElementById('navbar-toggle');
    const navCollapse = document.getElementById('navbar-collapse');
    if (navToggle && navCollapse) {
        navToggle.addEventListener('click', () => navCollapse.classList.toggle('show'));
    }

    // Auto-dismiss alerts
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            alert.style.transition = 'all 0.4s ease';
            setTimeout(() => alert.remove(), 400);
        }, 4000);
    });
    </script>
</body>
</html>
