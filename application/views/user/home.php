<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-camera"></i> Platform Rental Terpercaya</div>
        <h1>Sewa <span>Kamera & Drone</span> Profesional</h1>
        <p>Dapatkan peralatan foto dan video terbaik untuk setiap momen. Mudah, terpercaya, dan harga terjangkau.</p>
        <div class="hero-actions">
            <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Lihat Katalog
            </a>
            <?php if (!is_logged_in()): ?>
            <a href="<?= site_url('register') ?>" class="btn btn-lg" style="background:rgba(255,255,255,0.15);color:#fff;border:1.5px solid rgba(255,255,255,0.3);">
                <i class="fas fa-user-plus"></i> Daftar Gratis
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section style="padding:52px 40px;background:#fff;border-bottom:1px solid #E2E8F0;">
    <div class="grid grid-3" style="max-width:900px;margin:0 auto;gap:32px">
        <div style="text-align:center;padding:20px">
            <div style="width:56px;height:56px;border-radius:16px;background:#EFF6FF;color:#2563EB;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Booking Online</h3>
            <p style="font-size:13px;color:#64748B">Pesan kamera atau drone favorit Anda kapan saja, di mana saja.</p>
        </div>
        <div style="text-align:center;padding:20px">
            <div style="width:56px;height:56px;border-radius:16px;background:#F0FDF4;color:#22C55E;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Terverifikasi</h3>
            <p style="font-size:13px;color:#64748B">Setiap pembayaran diverifikasi langsung oleh tim admin kami.</p>
        </div>
        <div style="text-align:center;padding:20px">
            <div style="width:56px;height:56px;border-radius:16px;background:#FFF7ED;color:#F97316;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
                <i class="fas fa-star"></i>
            </div>
            <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Berikan Review</h3>
            <p style="font-size:13px;color:#64748B">Bagikan pengalaman Anda setelah menggunakan alat kami.</p>
        </div>
    </div>
</section>

<!-- Catalog Section -->
<section class="section" style="background:#F8FAFC">
    <div class="section-header">
        <h2 class="section-title">Produk Tersedia</h2>
        <p class="section-subtitle">Temukan kamera dan drone terbaik untuk kebutuhan Anda</p>
    </div>

    <?php if (empty($produk_unggulan)): ?>
    <div style="text-align:center;padding:48px;color:#94A3B8">
        <i class="fas fa-box-open" style="font-size:48px;margin-bottom:12px;display:block"></i>
        <p>Belum ada produk tersedia.</p>
    </div>
    <?php else: ?>
    <div class="grid grid-3" style="max-width:1100px;margin:0 auto">
        <?php foreach ($produk_unggulan as $p): ?>
        <div class="produk-card">
            <div class="produk-card-img">
                <?php if ($p->foto): ?>
                    <img src="<?= base_url('assets/uploads/produk/' . $p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>">
                <?php else: ?>
                    <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                <?php endif; ?>
            </div>
            <div class="produk-card-body">
                <div class="produk-card-kategori"><i class="fas fa-tag"></i> <?= ucfirst($p->kategori) ?></div>
                <h3 class="produk-card-title"><?= htmlspecialchars($p->nama) ?></h3>
                <p style="font-size:12px;color:#64748B;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?= htmlspecialchars($p->spesifikasi) ?></p>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:12px">
                    <div>
                        <div class="produk-card-price"><?= rupiah($p->harga_per_hari) ?><span>/hari</span></div>
                        <div style="font-size:11px;color:#64748B;margin-top:2px">Stok: <?= $p->stok ?> unit</div>
                    </div>
                    <a href="<?= site_url('produk/detail/' . $p->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:32px">
        <a href="<?= site_url('produk') ?>" class="btn btn-outline">Lihat Semua Produk <i class="fas fa-arrow-right"></i></a>
    </div>
    <?php endif; ?>
</section>

<?php $this->load->view('templates/footer'); ?>
