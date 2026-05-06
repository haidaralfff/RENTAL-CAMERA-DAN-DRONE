<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('superadmin/admin') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Tambah Admin Baru</span>
            </div>
        </div>
        <div class="page-content">
            <div class="card" style="max-width:520px">
                <div class="card-header"><span class="card-title">Form Tambah Admin</span></div>
                <div class="card-body">
                    <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>
                    <?= form_open('superadmin/admin/tambah') ?>
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama admin" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@rentcam.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-user-shield"></i> Buat Admin</button>
                        <a href="<?= site_url('superadmin/admin') ?>" class="btn btn-outline">Batal</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
