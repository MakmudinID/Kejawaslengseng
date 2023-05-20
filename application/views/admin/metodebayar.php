<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $title; ?></h4>
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
                        <a href="#"><?= $title; ?></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Metode Pembayaran</h4>
                                <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Metode
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Nomor Pembayaran</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($metode as $dk) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dk['metode']; ?></td>
                                                <td><?= $dk['nomor_pembayaran']; ?></td>
                                                <td><?php if ($dk['is_active'] == 1) {
                                                        echo 'Aktif';
                                                    } else {
                                                        echo 'Non Aktif';
                                                    } ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="modal" data-target="#<?= $dk['id']; ?>" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <a href="<?= base_url('admin/hapus_metodebayar'); ?>/<?= $dk['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="return confirm('Metode Pembayaran <?= $dk['metode'] ?> akan dihapus?');">
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
                <?= date('Y') ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
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
                        Metode Pembayaran
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form tambah Metode Pembayaran. harap semua terisi dengan benar
                </p>
                <form method="post" action="<?= base_url('admin/metodebayar'); ?>">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="form-group form-group-default">
                                <label>Metode Bayar</label>
                                <input id="metode" name="metode" type="text" class="form-control" placeholder="Masukkan Metode Pembayaran" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>No. Pembayaran</label>
                                <input name="no_bayar" id="no_bayar" type="text" class="form-control" placeholder="Masukkan No.Pembayaran" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Status</label>
                                <select id="is_active" name="is_active" class="form-control" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
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
<?php $no = 1;
foreach ($metode as $dk) : ?>
    <div class="modal fade" id="<?= $dk['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Tambah</span>
                        <span class="fw-light">
                            Edit Pembayaran
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">Form Edit Metode Pembayaran. harap semua terisi dengan benar
                    </p>
                    <form method="post" action="<?= base_url('admin/editmetodebayar/' . $dk['id']); ?>">
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Metode Bayar</label>
                                    <input id="metode" name="metode" value="<?= $dk['metode']; ?>" type="text" class="form-control" placeholder="Masukkan Metode Pembayaran" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>No. Pembayaran</label>
                                    <input name="no_bayar" id="no_bayar" value="<?= $dk['nomor_pembayaran']; ?>" type="text" class="form-control" placeholder="Masukkan No.Pembayaran" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Status</label>
                                    <select id="is_active" name="is_active" class="form-control" required>
                                        <?php if ($dk['is_active'] == 1) : ?>
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        <?php else : ?>
                                            <option value="0" selected>Non Aktif</option>
                                            <option value="1">Aktif</option>
                                        <?php endif; ?>
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
<?php endforeach; ?>