<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="padding:40px;max-width:1100px;margin:0 auto">
    <!-- Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
        <div>
            <h1 style="font-size:22px;font-weight:800">Katalog Produk</h1>
            <p style="color:#64748B;font-size:13px">Temukan kamera & drone yang tepat untuk Anda</p>
        </div>
        <!-- Filter -->
        <?= form_open('produk', 'method="get"') ?>
        <div class="d-flex gap-2">
            <select name="kategori" class="form-control form-select" style="width:160px" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="kamera"    <?= $this->input->get('kategori') === 'kamera'    ? 'selected' : '' ?>>Kamera</option>
                <option value="drone"     <?= $this->input->get('kategori') === 'drone'     ? 'selected' : '' ?>>Drone</option>
                <option value="aksesoris" <?= $this->input->get('kategori') === 'aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
            </select>
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($this->input->get('search') ?? '') ?>" style="width:220px">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
        </div>
        <?= form_close() ?>
    </div>

    <?php if (empty($produk)): ?>
    <div style="text-align:center;padding:80px;color:#94A3B8">
        <i class="fas fa-search" style="font-size:48px;display:block;margin-bottom:16px"></i>
        <h3 style="font-size:18px;font-weight:700;margin-bottom:8px">Produk tidak ditemukan</h3>
        <p>Coba gunakan kata kunci yang berbeda atau hapus filter.</p>
        <a href="<?= site_url('produk') ?>" class="btn btn-outline mt-3">Reset Filter</a>
    </div>
    <?php else: ?>
    <div class="grid grid-3">
        <?php foreach ($produk as $p): ?>
        <div class="produk-card">
            <div class="produk-card-img">
                <?php if ($p->foto): ?>
                <img src="<?= base_url('assets/uploads/produk/'.$p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>">
                <?php else: ?>
                <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : ($p->kategori === 'aksesoris' ? 'camera-retro' : 'camera') ?>"></i>
                <?php endif; ?>
            </div>
            <div class="produk-card-body">
                <div class="produk-card-kategori"><i class="fas fa-tag"></i> <?= ucfirst($p->kategori) ?></div>
                <h3 class="produk-card-title"><?= htmlspecialchars($p->nama) ?></h3>
                <p style="font-size:12px;color:#64748B;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:12px"><?= htmlspecialchars($p->spesifikasi) ?></p>
                <div class="d-flex align-center justify-between" style="margin-top:auto">
                    <div>
                        <div class="produk-card-price"><?= rupiah($p->harga_per_hari) ?><span>/hari</span></div>
                        <div style="font-size:11px;margin-top:2px">
                            <span style="color:<?= $p->stok > 0 ? '#22C55E' : '#EF4444' ?>;font-weight:600"><?= $p->stok > 0 ? '● Tersedia' : '● Habis' ?></span>
                            <span style="color:#94A3B8"> (<?= $p->stok ?> unit)</span>
                        </div>
                    </div>
                    <a href="<?= site_url('produk/detail/'.$p->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
