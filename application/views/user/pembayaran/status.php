<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:800px;margin:40px auto;padding:0 20px">
    <h1 style="font-size:22px;font-weight:800;margin-bottom:6px">Status Pembayaran</h1>
    <p style="font-size:13px;color:#64748B;margin-bottom:24px">Pantau status verifikasi pembayaran Anda</p>

    <?php if (empty($payments)): ?>
    <div style="text-align:center;padding:80px;color:#94A3B8">
        <i class="fas fa-receipt" style="font-size:48px;display:block;margin-bottom:16px"></i>
        <p>Belum ada riwayat pembayaran.</p>
    </div>
    <?php else: ?>
    <div style="display:flex;flex-direction:column;gap:14px">
        <?php foreach ($payments as $p): ?>
        <div class="card" style="padding:0;overflow:hidden">
            <div style="display:flex;align-items:stretch;flex-wrap:wrap">
                <div style="background:<?= $p->status === 'verified' ? '#DCFCE7' : ($p->status === 'rejected' ? '#FEE2E2' : '#FEF9C3') ?>;width:6px;flex-shrink:0"></div>
                <div style="padding:18px 20px;flex:1">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
                        <div>
                            <div style="font-size:14px;font-weight:700">Booking #<?= $p->booking_id ?></div>
                            <div style="font-size:12px;color:#64748B"><?= tgl_indo($p->tanggal_mulai) ?> – <?= tgl_indo($p->tanggal_selesai) ?></div>
                        </div>
                        <div style="text-align:right">
                            <div style="font-size:17px;font-weight:800;color:#2563EB"><?= rupiah($p->total_harga) ?></div>
                            <span class="badge badge-<?= $p->status ?>"><?= ucfirst($p->status) ?></span>
                        </div>
                    </div>
                    <?php if ($p->status === 'pending' && !empty($p->deadline_bayar)): ?>
                    <div style="font-size:12px;color:#EF4444;margin-top:6px">
                        Batas bayar: <?= date('d/m/Y H:i', strtotime($p->deadline_bayar)) ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->status === 'rejected'): ?>
                    <div class="alert alert-danger mt-2" style="margin-bottom:0">
                        <i class="fas fa-exclamation-circle"></i> Pembayaran ditolak.
                        <a href="<?= site_url('pembayaran/upload/'.$p->booking_id) ?>" style="font-weight:700">Upload ulang →</a>
                    </div>
                    <?php elseif ($p->status === 'verified'): ?>
                    <div class="alert alert-success mt-2" style="margin-bottom:0">
                        <i class="fas fa-check-circle"></i> Pembayaran terverifikasi! Booking Anda telah dikonfirmasi.
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning mt-2" style="margin-bottom:0">
                        <i class="fas fa-clock"></i> Menunggu verifikasi admin...
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
