<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Edit Produk</span>
            </div>
        </div>
        <div class="page-content">
            <div class="card" style="max-width:720px">
                <div class="card-header"><span class="card-title">Edit: <?= htmlspecialchars($produk->nama) ?></span></div>
                <div class="card-body">
                    <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>
                    <?= form_open_multipart('admin/produk/edit/'.$produk->id) ?>
                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($produk->nama) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-control form-select">
                                <option value="kamera"    <?= $produk->kategori === 'kamera'     ? 'selected' : '' ?>>Kamera</option>
                                <option value="drone"     <?= $produk->kategori === 'drone'      ? 'selected' : '' ?>>Drone</option>
                                <option value="aksesoris" <?= $produk->kategori === 'aksesoris'  ? 'selected' : '' ?>>Aksesoris</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Spesifikasi</label>
                        <textarea name="spesifikasi" class="form-control" rows="3"><?= htmlspecialchars($produk->spesifikasi) ?></textarea>
                    </div>
                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Harga per Hari (Rp)</label>
                            <input type="number" name="harga_per_hari" class="form-control" value="<?= $produk->harga_per_hari ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $produk->stok ?>" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control form-select">
                            <option value="tersedia"        <?= $produk->status === 'tersedia'       ? 'selected' : '' ?>>Tersedia</option>
                            <option value="tidak_tersedia"  <?= $produk->status === 'tidak_tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Produk</label>
                        <?php if ($produk->foto): ?>
                        <div style="margin-bottom:10px">
                            <img src="<?= base_url('assets/uploads/produk/'.$produk->foto) ?>" alt="" style="height:80px;border-radius:8px;object-fit:cover">
                            <p style="font-size:12px;color:#64748B;margin-top:4px">Foto saat ini. Upload baru untuk mengganti.</p>
                        </div>
                        <?php endif; ?>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui</button>
                        <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline">Batal</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
