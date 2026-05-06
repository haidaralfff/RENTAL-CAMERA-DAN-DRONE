<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('superadmin/user') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Edit User</span>
            </div>
        </div>
        <div class="page-content">
            <div class="card" style="max-width:560px">
                <div class="card-header"><span class="card-title">Edit: <?= htmlspecialchars($user->nama) ?></span></div>
                <div class="card-body">
                    <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>
                    <?= form_open('superadmin/user/edit/'.$user->id) ?>
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user->nama) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user->email) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru <span style="color:#94A3B8;font-weight:400">(kosongkan jika tidak diganti)</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control form-select">
                            <option value="1" <?= $user->status ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= !$user->status ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= site_url('superadmin/user') ?>" class="btn btn-outline">Batal</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
