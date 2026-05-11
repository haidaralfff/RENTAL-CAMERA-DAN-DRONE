<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('superadmin/laporan') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Detail Transaksi #<?= $booking->id ?></span>
            </div>
        </div>
        <div class="page-content">
            <div class="grid grid-2 gap-4">
                <!-- Card Informasi Penyewa -->
                <div class="card card-premium">
                    <div class="card-header">
                        <span class="card-title">
                            <i class="fas fa-user-circle" style="color: var(--primary); margin-right: 8px;"></i> Informasi Penyewa & Identitas
                        </span>
                    </div>
                    <div class="card-body" style="padding: 24px;">
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <div class="info-row">
                                <div class="info-icon" style="background: #eff6ff; color: #2563eb;"><i class="fas fa-signature"></i></div>
                                <div><p class="info-label">Nama Lengkap</p><p class="info-value"><?= htmlspecialchars($booking->nama_user) ?></p></div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon" style="background: #fef2f2; color: #dc2626;"><i class="fas fa-envelope"></i></div>
                                <div><p class="info-label">Alamat Email</p><p class="info-value" style="font-family:'Inter', sans-serif; font-weight:400;"><?= htmlspecialchars($booking->email) ?></p></div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon" style="background: #ecfdf5; color: #059669;"><i class="fas fa-phone-alt"></i></div>
                                <div><p class="info-label">Nomor Telepon</p><p class="info-value" style="font-family:'Inter', sans-serif; font-weight:400;"><?= htmlspecialchars($booking->phone) ?></p></div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon" style="background: #fff7ed; color: #ea580c;"><i class="fas fa-map-marked-alt"></i></div>
                                <div><p class="info-label">Alamat Lengkap</p><p class="info-value" style="font-family:'Inter', sans-serif; font-weight:400; font-size:13px;"><?= htmlspecialchars($booking->alamat) ?></p></div>
                            </div>
                        </div>

                        <?php if ($booking->ktp): ?>
                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed #e2e8f0;">
                            <p style="font-family: 'Poppins', sans-serif; font-size: 12px; color: #1e293b; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-id-card" style="color: #64748b;"></i> KTP / Identitas Penyewa
                            </p>
                            <div style="position: relative; overflow: hidden; border-radius: 12px; border: 1px solid #f1f5f9; cursor: pointer; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'" onclick="window.open('<?= base_url('assets/uploads/identitas/'.$booking->ktp) ?>','_blank')">
                                <img src="<?= base_url('assets/uploads/identitas/'.$booking->ktp) ?>" style="width: 100%; height: 180px; object-fit: cover; display: block;">
                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.6)); padding: 10px; text-align: center; color: #fff; font-size: 10px;">
                                    <i class="fas fa-search-plus"></i> Klik untuk memperbesar
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Card Status & Bukti -->
                <div class="card card-premium">
                    <div class="card-header">
                        <span class="card-title">
                            <i class="fas fa-shield-alt" style="color: var(--success); margin-right: 8px;"></i> Status & Bukti
                        </span>
                    </div>
                    <div class="card-body" style="padding: 24px;">
                        <div style="margin-bottom: 24px; padding: 16px; border-radius: 16px; background: #f8fafc; border: 1px solid #f1f5f9;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <span style="font-size: 12px; color: #64748b; font-weight: 600;">Status Transaksi</span>
                                <span class="badge badge-<?= $booking->status ?>" style="padding: 6px 12px; font-size: 11px; letter-spacing: 0.5px;"><?= strtoupper($booking->status) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 12px; color: #64748b; font-weight: 600;">Periode Sewa</span>
                                <span style="font-size: 12px; color: #0f172a; font-weight: 700;"><?= tgl_indo($booking->tanggal_mulai) ?> - <?= tgl_indo($booking->tanggal_selesai) ?></span>
                            </div>
                        </div>

                        <div class="grid grid-2 gap-3">
                            <!-- Bukti Bayar -->
                            <?php if (isset($pembayaran) && $pembayaran->bukti_bayar): ?>
                            <div style="text-align: center;">
                                <p style="font-family: 'Poppins', sans-serif; font-size: 11px; color: #64748b; font-weight: 700; margin-bottom: 10px; text-transform: uppercase;">Bukti Pembayaran</p>
                                <div style="position: relative; border-radius: 12px; overflow: hidden; border: 1px solid #f1f5f9; cursor: pointer;" onclick="window.open('<?= base_url('assets/uploads/bukti/'.$pembayaran->bukti_bayar) ?>','_blank')">
                                    <img src="<?= base_url('assets/uploads/bukti/'.$pembayaran->bukti_bayar) ?>" style="width: 100%; height: 120px; object-fit: cover;">
                                    <div style="position: absolute; inset: 0; background: rgba(37, 99, 235, 0.1); opacity: 0; transition: 0.3s; display: flex; align-items: center; justify-content: center; color: #fff;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Bukti Handover -->
                            <?php if ($booking->foto_penerima): ?>
                            <div style="text-align: center;">
                                <p style="font-family: 'Poppins', sans-serif; font-size: 11px; color: #64748B; font-weight: 700; margin-bottom: 10px; text-transform: uppercase;">Bukti Penerima</p>
                                <div style="position: relative; border-radius: 12px; overflow: hidden; border: 1px solid #f1f5f9; cursor: pointer;" onclick="window.open('<?= base_url('assets/uploads/penerima/'.$booking->foto_penerima) ?>','_blank')">
                                    <img src="<?= base_url('assets/uploads/penerima/'.$booking->foto_penerima) ?>" style="width: 100%; height: 120px; object-fit: cover;">
                                    <div style="position: absolute; inset: 0; background: rgba(34, 197, 94, 0.1); opacity: 0; transition: 0.3s; display: flex; align-items: center; justify-content: center; color: #fff;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header"><span class="card-title">Rincian Produk</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>Produk</th><th>Harga Satuan</th><th>Qty</th><th>Durasi</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            <?php 
                            $durasi = hitung_durasi($booking->tanggal_mulai, $booking->tanggal_selesai);
                            foreach ($detail as $item): 
                            ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($item->nama_produk) ?></strong></td>
                                <td><?= rupiah($item->harga_satuan) ?></td>
                                <td><?= $item->qty ?> unit</td>
                                <td><?= $durasi ?> hari</td>
                                <td><strong><?= rupiah($item->harga_satuan * $item->qty * $durasi) ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align:right"><strong>Total Pendapatan:</strong></td>
                                <td style="font-size:18px;color:#2563EB"><strong><?= rupiah($booking->total_harga) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
