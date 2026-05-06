<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Tambah Produk</span>
            </div>
        </div>
        <div class="page-content">
            <div class="card" style="max-width:720px">
                <div class="card-header"><span class="card-title">Form Tambah Produk</span></div>
                <div class="card-body">
                    <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>
                    <?= form_open_multipart('admin/produk/tambah') ?>
                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Nama Produk <span style="color:red">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama produk" value="<?= set_value('nama') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori <span style="color:red">*</span></label>
                            <select name="kategori" class="form-control form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="kamera" <?= set_select('kategori','kamera') ?>>Kamera</option>
                                <option value="drone"  <?= set_select('kategori','drone') ?>>Drone</option>
                                <option value="aksesoris" <?= set_select('kategori','aksesoris') ?>>Aksesoris</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Spesifikasi</label>
                        <textarea name="spesifikasi" class="form-control" rows="3" placeholder="Tuliskan spesifikasi produk..."><?= set_value('spesifikasi') ?></textarea>
                    </div>
                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Harga per Hari (Rp) <span style="color:red">*</span></label>
                            <input type="number" name="harga_per_hari" class="form-control" placeholder="250000" value="<?= set_value('harga_per_hari') ?>" min="1000" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Stok <span style="color:red">*</span></label>
                            <input type="number" name="stok" class="form-control" placeholder="1" value="<?= set_value('stok') ?>" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control form-select">
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak_tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Produk</label>
                        <div class="upload-area" onclick="document.getElementById('foto').click()">
                            <div class="upload-icon"><i class="fas fa-image"></i></div>
                            <div class="upload-text">Klik untuk upload foto (JPG, PNG, max 3MB)</div>
                            <div id="foto-name" style="font-size:12px;color:#2563EB;margin-top:8px"></div>
                        </div>
                        <input type="file" id="foto" name="foto" accept="image/*" style="display:none" onchange="document.getElementById('foto-name').textContent = this.files[0]?.name || ''">
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Produk</button>
                        <a href="<?= site_url('admin/produk') ?>" class="btn btn-outline">Batal</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
