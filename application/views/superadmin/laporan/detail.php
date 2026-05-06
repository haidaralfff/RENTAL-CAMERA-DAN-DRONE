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
                <div class="card">
                    <div class="card-header"><span class="card-title">Informasi Penyewa</span></div>
                    <div class="card-body">
                        <table class="table-info">
                            <tr><td>Nama</td><td>: <strong><?= htmlspecialchars($booking->nama_user) ?></strong></td></tr>
                            <tr><td>Email</td><td>: <?= htmlspecialchars($booking->email) ?></td></tr>
                            <tr><td>Tgl Booking</td><td>: <?= tgl_indo(date('Y-m-d', strtotime($booking->created_at))) ?></td></tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Status Transaksi</span></div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <span class="badge badge-<?= $booking->status ?>" style="width:fit-content;padding:8px 16px;font-size:14px">
                                Status: <?= strtoupper($booking->status) ?>
                            </span>
                            <p style="font-size:12px;color:#64748B">Periode: <?= tgl_indo($booking->tanggal_mulai) ?> s/d <?= tgl_indo($booking->tanggal_selesai) ?></p>
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
