    <footer class="footer">
        <p>© <?= date('Y') ?> <strong style="color:#fff">RENTCAM</strong> — Platform Rental Kamera & Drone</p>
    </footer>

    <script>
    // Sidebar toggle for mobile
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar   = document.querySelector('.sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('open'));
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
