    <footer class="footer footer-main">
        <?php 
        // Deteksi area Dashboard atau Auth (Admin, Superadmin, Profile, atau Login/Register)
        $first_segment = $this->uri->segment(1);
        $is_suppressed_area = in_array($first_segment, ['admin', 'superadmin', 'profile', 'auth', 'login', 'register']);
        
        if (!$is_suppressed_area): 
        ?>
            <!-- Footer Lengkap (Hanya tampil di Halaman Depan/Public) -->
            <div class="footer-grid">
                <!-- Brand & About -->
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; background: #2563EB; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px;">
                            <i class="fas fa-camera"></i>
                        </div>
                        <strong style="color:#fff; font-size: 20px; letter-spacing: -0.5px;"><?= $this->config->item('site_name') ?></strong>
                    </div>
                    <p style="color: #94A3B8; font-size: 14px; line-height: 1.6;"><?= $this->config->item('site_description') ?></p>
                </div>

                <!-- Address -->
                <div>
                    <strong style="color:#fff; font-size: 16px; display: block; margin-bottom: 16px; font-family: 'Poppins', sans-serif;">Alamat Kantor</strong>
                    <p style="color: #94A3B8; font-size: 14px; line-height: 1.7;">
                        <i class="fas fa-map-marker-alt" style="color: #2563EB; margin-right: 10px;"></i>
                        <?= str_replace(', ', ', <br>', $this->config->item('office_address')) ?>
                    </p>
                    <!-- Google Maps Embed with Premium Styling -->
                    <div class="footer-map-box">
                        <iframe 
                            src="<?= $this->config->item('google_maps_embed') ?>" 
                            width="100%" height="130" style="border:0; display: block;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>

                <!-- Customer Service -->
                <div>
                    <strong style="color:#fff; font-size: 16px; display: block; margin-bottom: 16px; font-family: 'Poppins', sans-serif;">Customer Service</strong>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <a href="https://wa.me/<?= str_replace(['-', ' '], '', $this->config->item('contact_phone')) ?>" target="_blank" style="color: #94A3B8; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                            <i class="fab fa-whatsapp" style="color: #22C55E; font-size: 18px;"></i>
                            <?= $this->config->item('contact_phone') ?>
                        </a>
                        <a href="mailto:<?= $this->config->item('contact_email') ?>" style="color: #94A3B8; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-envelope" style="color: #F97316; font-size: 16px;"></i>
                            <?= $this->config->item('contact_email') ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div style="<?= $is_suppressed_area ? 'padding: 15px 0;' : 'border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px;' ?> text-align: center;">
            <p style="color: #64748B; font-size: 12px;">© <?= date('Y') ?> <strong style="color:#94A3B8"><?= $this->config->item('site_name') ?></strong> — All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Config Injection for JS -->
    <script>
        window.RentCamConfig = {
            siteName: '<?= $this->config->item("site_name") ?>',
            baseUrl: '<?= base_url() ?>'
        };
    </script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- App Main JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
