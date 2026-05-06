<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title">Manajemen User</span></div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header"><span class="card-title">Daftar User (<?= count($users) ?>)</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Bergabung</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $u): ?>
                            <?php
                                $role = normalize_role($u->role);
                                $role_label = $role === 'superadmin' ? 'Super Admin' : ucfirst($role);
                            ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <div class="d-flex align-center gap-2">
                                        <div class="sidebar-avatar" style="width:32px;height:32px;font-size:12px;flex-shrink:0"><?= strtoupper(substr($u->nama,0,1)) ?></div>
                                        <strong><?= htmlspecialchars($u->nama) ?></strong>
                                    </div>
                                </td>
                                <td style="font-size:13px"><?= htmlspecialchars($u->email) ?></td>
                                <td><span class="badge badge-<?= $role === 'user' ? 'dipinjam' : ($role === 'admin' ? 'confirmed' : 'kembali') ?>"><?= $role_label ?></span></td>
                                <td>
                                    <?php if ($u->status): ?>
                                    <span class="badge badge-verified">Aktif</span>
                                    <?php else: ?>
                                    <span class="badge badge-rejected">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size:12px"><?= tgl_indo(date('Y-m-d', strtotime($u->created_at))) ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('superadmin/user/edit/'.$u->id) ?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="<?= site_url('superadmin/user/toggle_status/'.$u->id) ?>" class="btn btn-sm <?= $u->status ? 'btn-danger' : 'btn-success' ?>" onclick="return confirm('Ubah status user?')">
                                            <i class="fas fa-<?= $u->status ? 'ban' : 'check' ?>"></i>
                                        </a>
                                    </div>
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
<?php $this->load->view('templates/footer'); ?>
