<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:1000px;margin:40px auto;padding:0 20px">
    <a href="<?= site_url('produk') ?>" style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#64748B;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>

    <div class="grid grid-2" style="gap:32px;align-items:start">
        <!-- Gambar -->
        <div class="card" style="overflow:hidden">
            <?php if ($produk->foto): ?>
            <img src="<?= base_url('assets/uploads/produk/'.$produk->foto) ?>" alt="<?= htmlspecialchars($produk->nama) ?>" style="width:100%;aspect-ratio:4/3;object-fit:cover">
            <?php else: ?>
            <div style="height:280px;background:linear-gradient(135deg,#EFF6FF,#DBEAFE);display:flex;align-items:center;justify-content:center;font-size:80px;color:#93C5FD">
                <i class="fas fa-<?= $produk->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
            </div>
            <?php endif; ?>
        </div>

        <!-- Info -->
        <div>
            <div class="produk-card-kategori mb-2"><i class="fas fa-tag"></i> <?= ucfirst($produk->kategori) ?></div>
            <h1 style="font-size:24px;font-weight:800;margin-bottom:8px"><?= htmlspecialchars($produk->nama) ?></h1>

            <!-- Rating -->
            <?php if ($rating > 0): ?>
            <div class="d-flex align-center gap-2 mb-2">
                <span class="stars"><?= str_repeat('★', round($rating)) ?><?= str_repeat('☆', 5 - round($rating)) ?></span>
                <span style="font-size:14px;font-weight:600"><?= $rating ?>/5</span>
                <span style="font-size:12px;color:#64748B">(<?= count($reviews) ?> ulasan)</span>
            </div>
            <?php endif; ?>

            <div style="font-size:28px;font-weight:800;color:#2563EB;margin:16px 0"><?= rupiah($produk->harga_per_hari) ?><span style="font-size:14px;font-weight:400;color:#64748B"> /hari</span></div>

            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:16px;margin-bottom:20px">
                <p style="font-size:12px;font-weight:700;color:#64748B;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px">Spesifikasi</p>
                <p style="font-size:13px;color:#374151;line-height:1.7"><?= nl2br(htmlspecialchars($produk->spesifikasi)) ?></p>
            </div>

            <div class="d-flex align-center gap-2 mb-4">
                <span style="font-size:13px;color:#64748B">Ketersediaan:</span>
                <span style="font-weight:700;color:<?= $produk->stok > 0 ? '#22C55E' : '#EF4444' ?>">
                    <i class="fas fa-circle" style="font-size:8px"></i>
                    <?= $produk->stok > 0 ? 'Tersedia (' . $produk->stok . ' unit)' : 'Stok Habis' ?>
                </span>
            </div>

            <?php if ($produk->stok > 0): ?>
            <?php if (is_logged_in()): ?>
            <a href="<?= site_url('booking/form/'.$produk->id) ?>" class="btn btn-primary btn-lg btn-block" style="margin-bottom:10px">
                <i class="fas fa-calendar-plus"></i> Sewa Sekarang
            </a>
            <?php else: ?>
            <a href="<?= site_url('login') ?>" class="btn btn-primary btn-lg btn-block" style="margin-bottom:10px">
                <i class="fas fa-sign-in-alt"></i> Login untuk Sewa
            </a>
            <?php endif; ?>
            <?php else: ?>
            <button class="btn btn-lg btn-block" style="background:#E2E8F0;color:#94A3B8;cursor:not-allowed" disabled>
                <i class="fas fa-ban"></i> Stok Habis
            </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- Reviews -->
    <?php if (!empty($reviews)): ?>
    <div class="card mt-3">
        <div class="card-header"><span class="card-title">Ulasan Pelanggan (<?= count($reviews) ?>)</span></div>
        <div class="card-body" style="padding:0">
            <?php foreach ($reviews as $r): ?>
            <div style="padding:20px;border-bottom:1px solid #E2E8F0">
                <div class="d-flex align-center justify-between mb-2">
                    <div class="d-flex align-center gap-2">
                        <div class="sidebar-avatar" style="width:34px;height:34px;font-size:13px"><?= strtoupper(substr($r->nama_user,0,1)) ?></div>
                        <div>
                            <div style="font-size:13px;font-weight:700"><?= htmlspecialchars($r->nama_user) ?></div>
                            <div class="stars" style="font-size:12px"><?= str_repeat('★',$r->rating) ?><?= str_repeat('☆',5-$r->rating) ?></div>
                        </div>
                    </div>
                    <span style="font-size:11px;color:#94A3B8"><?= tgl_indo(date('Y-m-d',strtotime($r->created_at))) ?></span>
                </div>
                <p style="font-size:13px;color:#374151"><?= htmlspecialchars($r->komentar) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
