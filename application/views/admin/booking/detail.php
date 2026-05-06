<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('admin/booking') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Detail Booking #<?= $booking->id ?></span>
            </div>
        </div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="grid" style="grid-template-columns:1fr 360px;gap:20px;align-items:start">
                <!-- Detail -->
                <div style="display:flex;flex-direction:column;gap:16px">
                    <div class="card">
                        <div class="card-header"><span class="card-title">Informasi Booking</span></div>
                        <div class="card-body">
                            <table style="width:100%;font-size:13px;border-collapse:collapse">
                                <tr><td style="padding:8px 0;color:#64748B;width:140px">Member</td><td><strong><?= htmlspecialchars($booking->nama_user) ?></strong></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Email</td><td><?= htmlspecialchars($booking->email) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Tanggal Mulai</td><td><?= tgl_indo($booking->tanggal_mulai) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Tanggal Selesai</td><td><?= tgl_indo($booking->tanggal_selesai) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Durasi</td><td><?= hitung_durasi($booking->tanggal_mulai, $booking->tanggal_selesai) ?> hari</td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Total Harga</td><td><strong style="font-size:16px;color:#2563EB"><?= rupiah($booking->total_harga) ?></strong></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Status</td><td><span class="badge badge-<?= $booking->status ?>"><?= ucfirst($booking->status) ?></span></td></tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><span class="card-title">Produk yang Disewa</span></div>
                        <div class="table-wrap">
                            <table class="table">
                                <thead><tr><th>Produk</th><th>Kategori</th><th>Harga/Hari</th><th>Qty</th><th>Subtotal</th></tr></thead>
                                <tbody>
                                    <?php foreach ($detail as $d): ?>
                                    <?php $durasi = hitung_durasi($booking->tanggal_mulai, $booking->tanggal_selesai); ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($d->nama_produk) ?></strong></td>
                                        <td><?= ucfirst($d->kategori) ?></td>
                                        <td><?= rupiah($d->harga_satuan) ?></td>
                                        <td><?= $d->qty ?></td>
                                        <td class="fw-semibold"><?= rupiah($d->harga_satuan * $d->qty * $durasi) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="card">
                    <div class="card-header"><span class="card-title">Update Status</span></div>
                    <div class="card-body">
                        <p style="font-size:13px;color:#64748B;margin-bottom:16px">Status saat ini: <span class="badge badge-<?= $booking->status ?>"><?= ucfirst($booking->status) ?></span></p>

                        <!-- Flow Status Visual -->
                        <?php
                        $statuses = ['pending','confirmed','dipinjam','kembali'];
                        $current_idx = array_search($booking->status, $statuses);
                        ?>
                        <div style="display:flex;justify-content:space-between;margin-bottom:20px;position:relative">
                            <div style="position:absolute;top:14px;left:0;right:0;height:2px;background:#E2E8F0;z-index:0"></div>
                            <?php foreach ($statuses as $idx => $s): ?>
                            <div style="text-align:center;position:relative;z-index:1">
                                <div style="width:28px;height:28px;border-radius:50%;background:<?= $idx <= $current_idx ? '#2563EB' : '#E2E8F0' ?>;display:flex;align-items:center;justify-content:center;margin:0 auto;color:<?= $idx <= $current_idx ? '#fff' : '#94A3B8' ?>;font-size:11px;font-weight:700">
                                    <?= $idx < $current_idx ? '✓' : ($idx+1) ?>
                                </div>
                                <div style="font-size:10px;margin-top:4px;color:#64748B;text-transform:capitalize"><?= $s ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?= form_open('admin/booking/update_status/'.$booking->id) ?>
                        <div class="form-group">
                            <label class="form-label">Ganti Status</label>
                            <select name="status" class="form-control form-select">
                                <option value="pending"   <?= $booking->status === 'pending'   ? 'selected' : '' ?>>Pending</option>
                                <option value="confirmed" <?= $booking->status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option value="dipinjam"  <?= $booking->status === 'dipinjam'  ? 'selected' : '' ?>>Dipinjam</option>
                                <option value="kembali"   <?= $booking->status === 'kembali'   ? 'selected' : '' ?>>Kembali</option>
                                <option value="batal"     <?= $booking->status === 'batal'     ? 'selected' : '' ?>>Batal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sync-alt"></i> Update Status
                        </button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
