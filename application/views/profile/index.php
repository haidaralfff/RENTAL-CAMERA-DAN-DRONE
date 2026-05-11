<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <span class="topbar-title"><i class="fas fa-user-circle" style="color:var(--primary);margin-right:8px;"></i>Profil Saya</span>
        </div>

        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= validation_errors() ?></div>
            <?php endif; ?>

            <div class="grid grid-12">
                <div class="col-4">
                    <div class="card text-center" style="padding:40px 20px;">
                        <div style="width:100px; height:100px; border-radius:50%; background:linear-gradient(135deg, #1E3A8A, #2563EB); margin:0 auto 20px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:42px; font-weight:800; box-shadow:0 10px 20px rgba(37,99,235,0.2);">
                            <?= strtoupper(substr($user->nama, 0, 1)) ?>
                        </div>
                        <h2 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:800; margin-bottom:5px;"><?= htmlspecialchars($user->nama) ?></h2>
                        <p style="color:#64748B; font-size:14px; margin-bottom:20px;"><?= htmlspecialchars($user->email) ?></p>
                        <span class="badge badge-<?= normalize_role($user->role) === 'user' ? 'dipinjam' : 'confirmed' ?>" style="padding:6px 16px; font-size:12px;">
                            <?= $user->role === 'superadmin' ? 'Super Admin' : ucfirst($user->role) ?>
                        </span>
                        <div style="margin-top:30px; padding-top:20px; border-top:1px solid #F1F5F9; text-align:left;">
                            <div style="font-size:12px; color:#64748B; margin-bottom:5px;">Terdaftar Sejak</div>
                            <div style="font-weight:600; font-size:14px;"><?= tgl_indo(date('Y-m-d', strtotime($user->created_at))) ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title">Edit Profil</span>
                        </div>
                        <div class="card-body">
                            <?= form_open('profile') ?>
                            <div class="form-group mb-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $user->nama) ?>" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="<?= set_value('email', $user->email) ?>" required>
                            </div>
                            <div class="grid grid-2 gap-3">
                                <div class="form-group mb-4">
                                    <label class="form-label">Password Baru</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak diubah" minlength="6">
                                        <i class="fas fa-eye password-toggle" data-target="password"></i>
                                    </div>
                                    <small class="form-text">Minimal 6 karakter</small>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="passconf" id="passconf" class="form-control" placeholder="Ulangi password baru">
                                        <i class="fas fa-eye password-toggle" data-target="passconf"></i>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                                <button type="submit" class="btn btn-primary btn-lg" style="border-radius:12px;">
                                    <i class="fas fa-save" style="margin-right:8px;"></i> Simpan Perubahan
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
