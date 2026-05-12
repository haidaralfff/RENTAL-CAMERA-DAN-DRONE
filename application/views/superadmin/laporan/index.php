<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title"><i class="fas fa-file-alt" style="color:var(--primary);margin-right:8px;"></i>Laporan Keuangan</span></div>
        <div class="page-content">
            <div class="card mb-4">
                <div class="card-header">
                    <span class="card-title">Pendapatan Tahun <?= $tahun ?></span>
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('superadmin/laporan/export') ?>" class="btn btn-outline btn-sm" style="color: #16a34a; border-color: #bbf7d0; background: #f0fdf4;">
                            <i class="fas fa-file-excel" style="margin-right: 4px;"></i> Export ke Sheets
                        </a>
                        <?= form_open('superadmin/laporan', 'method="get", class="d-flex gap-2"') ?>
                            <select name="tahun" class="form-control form-select" style="width:120px">
                                <?php foreach ($list_tahun as $y): ?>
                                <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i></button>
                        <?= form_close() ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid grid-2 mb-4">
                        <div class="stat-card">
                            <div class="stat-icon blue"><i class="fas fa-calendar-alt"></i></div>
                            <div class="stat-info">
                                <div class="stat-value" style="font-size:18px"><?= rupiah($total_pendapatan_tahun) ?></div>
                                <div class="stat-label">Total Pendapatan Tahun <?= $tahun ?></div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="stat-info">
                                <div class="stat-value" style="font-size:18px"><?= rupiah($total_pendapatan_all) ?></div>
                                <div class="stat-label">Total Pendapatan Keseluruhan</div>
                            </div>
                        </div>
                    </div>
                    <canvas id="lapChart" height="120"></canvas>
                </div>
            </div>

            <!-- Kartu Produk Terlaris -->
            <div class="card card-premium">
                <div class="card-header">
                    <span class="card-title">
                        <i class="fas fa-crown" style="color: #fbbf24; margin-right: 8px;"></i> Produk Terlaris
                    </span>
                </div>
                <div class="table-wrap">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 80px;">Rank</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Total Disewa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk_terlaris as $i => $p): ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span class="rank-badge rank-<?= $i <= 2 ? $i+1 : 'default' ?>">
                                        #<?= $i+1 ?>
                                    </span>
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-family: 'Inter', sans-serif;"><?= htmlspecialchars($p->nama) ?></strong>
                                </td>
                                <td>
                                    <span class="badge badge-info" style="padding: 4px 10px; border-radius: 6px; background: #eff6ff; color: #2563eb; font-size: 11px; font-weight: 600; text-transform: uppercase;"><?= ucfirst($p->kategori) ?></span>
                                </td>
                                <td>
                                    <strong style="color: #2563eb; font-size: 15px;"><?= $p->total_sewa ?> <span style="font-size: 12px; color: #64748b; font-weight: 400;">x disewa</span></strong>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kartu Riwayat Semua Transaksi -->
            <div class="card card-premium" style="margin-top: 24px;">
                <div class="card-header">
                    <span class="card-title">
                        <i class="fas fa-history" style="color: #6366f1; margin-right: 8px;"></i> Riwayat Semua Transaksi
                    </span>
                </div>
                <div class="table-wrap">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Periode</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all_bookings as $b): ?>
                            <tr>
                                <td style="color: #64748b; font-weight: 600;">#<?= $b->id ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px;"><?= strtoupper(substr($b->nama_user, 0, 1)) ?></div>
                                        <strong style="color: #0f172a; font-family: 'Inter', sans-serif;"><?= htmlspecialchars($b->nama_user) ?></strong>
                                    </div>
                                </td>
                                <td>
                                    <p style="font-size: 12px; color: #334155; margin: 0; font-weight: 600;"><?= tgl_indo($b->tanggal_mulai) ?></p>
                                    <p style="font-size: 11px; color: #64748b; margin: 0;">s/d <?= tgl_indo($b->tanggal_selesai) ?></p>
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-size: 14px;"><?= rupiah($b->total_harga) ?></strong>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $b->status ?>" style="padding: 6px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;"><?= ucfirst($b->status) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="<?= site_url('superadmin/laporan/detail/'.$b->id) ?>" class="btn btn-outline btn-sm" style="border-radius: 8px; font-size: 11px;">
                                        <i class="fas fa-external-link-alt" style="margin-right: 4px;"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
const rawData = <?= json_encode($pendapatan_bulanan) ?>;
const chartData = new Array(12).fill(0);
rawData.forEach(item => { chartData[item.bulan - 1] = parseInt(item.total); });

new Chart(document.getElementById('lapChart'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Pendapatan',
            data: chartData,
            borderColor: '#2563EB',
            backgroundColor: 'rgba(37,99,235,0.08)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#2563EB',
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { callback: v => 'Rp ' + (v/1000).toFixed(0) + 'rb', font: { size: 11 } }, grid: { color: '#F1F5F9' } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
<?php $this->load->view('templates/footer'); ?>
