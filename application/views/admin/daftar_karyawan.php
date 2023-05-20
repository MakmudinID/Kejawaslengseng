<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?=$title;?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Setting</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?=$title;?></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Karyawan</h4>
                                <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Karyawan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr align="center">
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No. HP</th>
                                            <th>Posisi</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($daftarKaryawan as $dk) : ?>
                                            <tr>
                                                <td><?= $dk['nama']; ?></td>
                                                <td><?= $dk['username']; ?></td>
                                                <td><?= $dk['no_hp']; ?></td>
                                                <td><?= $dk['role']; ?></td>
                                                <td style="color: <?= $dk['warna']; ?>"><?= $dk['keterangan']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="modal" data-target="#<?=$dk['id'];?>" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <a href="<?= base_url('admin/hapus_karyawan'); ?>/<?= $dk['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="return confirm('Data karyawan <?= $dk['nama'] ?> akan dihapus?');"> 
                                                            <i class="fa fa-trash"></i>
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
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Resto Kejawa
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                <?=date('Y')?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>				
        </div>
    </footer>
</div>    

<!-- Modal Tambah -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tambah</span> 
                    <span class="fw-light">
                    Karyawan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form tambah Karyawan baru. harap semua terisi dengan benar
                </p>
                <form method="post" action="<?= base_url('admin/daftar_karyawan'); ?>">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Nama Karyawan</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan Nama" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>No. Handphone</label>
                                <input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Masukkan No.HP" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Username Akun</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Password Akun</label>
                                <div class="input-icon">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                    <span class="input-icon-addon show-password">
                                        <i class="icon-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Posisi Jabatan</label>
                                <select id="posisi" name="posisi" class="form-control" required>
                                    <option selected>&nbsp;</option>
                                    <?php foreach ($status as $st) : ?>
                                        <option value="<?= $st['id']; ?>"><?= $st['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Status Karyawan</label>
                                <select id="is_active" name="is_active" class="form-control" required>
                                    <option selected>&nbsp;</option>
                                    <?php foreach ($active as $ac) : ?>
                                        <option value="<?= $ac['id']; ?>"><?= $ac['keterangan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="addRowButton" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($daftarKaryawan as $dk) : ?>
<div class="modal fade" id="<?=$dk['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit</span> 
                    <span class="fw-light">
                    Karyawan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Edit Karyawan
                </p>
                <form method="post" action="<?= base_url('admin/detail/'.$dk['id']); ?>">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Nama Karyawan</label>
                                <input id="nama" value="<?= $dk['nama']; ?>" name="nama" type="text" class="form-control" placeholder="Masukkan Nama" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>No. Handphone</label>
                                <input name="no_hp" value="<?= $dk['no_hp']; ?>" id="no_hp" type="text" class="form-control" placeholder="Masukkan No.HP" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Username Akun</label>
                                <input type="text" class="form-control" value="<?= $dk['username']; ?>" id="username" name="username" placeholder="Masukkan Username" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Password Akun</label>
                                <div class="input-icon">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diubah">
                                    <span class="input-icon-addon show-password">
                                        <i class="icon-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Posisi Jabatan</label>
                                <select id="posisi" name="posisi" class="form-control" required>
                                    <?php foreach ($status as $st) : ?>
                                        <?php if ($st['role'] == $dk['role']) : ?>
                                            <option value="<?= $st['id']; ?>" selected><?= $st['role']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $st['id']; ?>"><?= $st['role']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Status Karyawan</label>
                                <select id="is_active" name="is_active" class="form-control" required>
                                        <?php foreach ($active as $ac) : ?>
                                            <?php if ($ac['keterangan'] == $dk['keterangan']) : ?>
                                                <option value="<?= $ac['id']; ?>" selected><?= $ac['keterangan']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $ac['id']; ?>"><?= $ac['keterangan']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="<?=$dk['id'];?>" class="btn btn-info">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<?php endforeach; ?>