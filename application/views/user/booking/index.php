<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="padding:40px;max-width:1100px;margin:0 auto">
    <div style="margin-bottom:32px;text-align:center">
        <h1 style="font-size:28px;font-weight:800;margin-bottom:8px">Pilih Alat untuk Disewa</h1>
        <p style="color:#64748B;font-size:15px">Klik detail atau sewa pada produk yang Anda inginkan.</p>
    </div>

    <?php if (empty($produk)): ?>
    <div style="text-align:center;padding:80px;color:#94A3B8">
        <i class="fas fa-box-open" style="font-size:48px;display:block;margin-bottom:16px"></i>
        <p>Maaf, saat ini belum ada alat yang tersedia untuk disewa.</p>
        <a href="<?= base_url() ?>" class="btn btn-outline mt-3">Kembali ke Home</a>
    </div>
    <?php else: ?>
    <div class="grid grid-3">
        <?php foreach ($produk as $p): ?>
        <div class="produk-card">
            <div class="produk-card-img">
                <?php if ($p->foto): ?>
                <img src="<?= base_url('assets/uploads/produk/'.$p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>">
                <?php else: ?>
                <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                <?php endif; ?>
            </div>
            <div class="produk-card-body">
                <div class="produk-card-kategori"><i class="fas fa-tag"></i> <?= ucfirst($p->kategori) ?></div>
                <h3 class="produk-card-title"><?= htmlspecialchars($p->nama) ?></h3>
                <div class="produk-card-price"><?= rupiah($p->harga_per_hari) ?><span>/hari</span></div>
                <div style="font-size:11px;color:#64748B;margin-top:4px;margin-bottom:16px">Stok tersedia: <?= $p->stok ?> unit</div>
                
                <div class="d-flex gap-2">
                    <a href="<?= site_url('produk/detail/'.$p->id) ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center">Detail</a>
                    <a href="<?= site_url('booking/form/'.$p->id) ?>" class="btn btn-primary btn-sm" style="flex:1;justify-content:center">Sewa</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
