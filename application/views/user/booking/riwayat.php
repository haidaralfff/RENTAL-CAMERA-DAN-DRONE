<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:900px;margin:40px auto;padding:0 20px">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <h1 style="font-size:22px;font-weight:800">Riwayat Booking</h1>
            <p style="font-size:13px;color:#64748B">Semua transaksi sewa Anda</p>
        </div>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Sewa Baru</a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if (empty($bookings)): ?>
    <div style="text-align:center;padding:80px;color:#94A3B8">
        <i class="fas fa-calendar-times" style="font-size:48px;display:block;margin-bottom:16px"></i>
        <h3 style="font-size:18px;font-weight:700;margin-bottom:8px">Belum ada booking</h3>
        <p style="margin-bottom:20px">Mulai sewa kamera atau drone favorit Anda sekarang!</p>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary"><i class="fas fa-camera"></i> Lihat Katalog</a>
    </div>
    <?php else: ?>

    <div style="display:flex;flex-direction:column;gap:16px">
        <?php foreach ($bookings as $b): ?>
        <div class="card" style="padding:0">
            <div style="padding:18px 20px;display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                <div style="width:46px;height:46px;border-radius:12px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;color:#2563EB;font-size:20px;flex-shrink:0">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div style="flex:1;min-width:200px">
                    <div style="font-size:13px;font-weight:700">Booking #<?= $b->id ?> — <span style="color:#2563EB"><?= $b->nama_produk ?></span></div>
                    <div style="font-size:12px;color:#64748B"><?= tgl_indo($b->tanggal_mulai) ?> — <?= tgl_indo($b->tanggal_selesai) ?></div>
                </div>
                <div style="text-align:center">
                    <div style="font-size:16px;font-weight:800;color:#2563EB"><?= rupiah($b->total_harga) ?></div>
                    <div style="font-size:11px;color:#64748B">Total Harga</div>
                </div>
                <div>
                    <span class="badge badge-<?= $b->status ?>"><?= ucfirst($b->status) ?></span>
                </div>
                <?php if ($b->status === 'pending' && !empty($b->deadline_bayar)): ?>
                <div style="font-size:11px;color:#EF4444">
                    Batas bayar: <?= date('d/m/Y H:i', strtotime($b->deadline_bayar)) ?>
                </div>
                <?php endif; ?>
                <?php if ($b->status_bayar): ?>
                <div>
                    <span class="badge badge-<?= $b->status_bayar ?>">Bayar: <?= ucfirst($b->status_bayar) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($b->status === 'kembali'): ?>
                <a href="<?= site_url('review/form/'.$b->id) ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-star"></i> Beri Review
                </a>
                <?php endif; ?>
                <?php if ($b->status === 'pending' && (!$b->status_bayar || $b->status_bayar === 'rejected')): ?>
                <a href="<?= site_url('pembayaran/upload/'.$b->id) ?>" class="btn btn-accent btn-sm">
                    <i class="fas fa-upload"></i> Upload Bukti
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
