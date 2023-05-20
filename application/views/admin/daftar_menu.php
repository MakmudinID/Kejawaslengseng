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
                        <a href="#">Admin</a>
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
                                <h4 class="card-title">Daftar Menu</h4>
                                <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#tambahmenu">
                                    <i class="fa fa-plus"></i>
                                    Tambah Kategori Menu
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr align="center">
                                            <th style="width: 5%">No</th>
                                            <th>Kategori Menu</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($kategori as $dk) : ?>
                                            <tr>
                                                <td align="center"><b><?= $i; ?></b></td>
                                                <td><b><?= $dk['nama_kategori']; ?></b></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= base_url('admin/before_per_kategori'); ?>/<?= $dk['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-info" data-original-title="Detail Varian">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        <button type="button" data-toggle="modal" class="btn btn-link btn-primary" data-target="#<?=$dk['id'];?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <a href="<?= base_url('admin/hapus_kategori'); ?>/<?= $dk['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="return confirm('Data kategori <?= $dk['nama_kategori'] ?> akan dihapus?');"> 
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php $i += 1; endforeach; ?>
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

<?php foreach ($kategori as $dk) : ?>
<div class="modal fade" id="<?=$dk['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit</span> 
                    <span class="fw-light">
                    Kategori
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Edit Kategori Menu
                </p>
                <form method="post" action="<?= base_url('admin/edit_kategori/'.$dk['id']); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama Kategori</label>
                                <input id="nama" value="<?= $dk['nama_kategori']; ?>" name="nama" type="text" class="form-control" placeholder="Masukkan Nama" autofocus required>
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
</div>
<?php endforeach; ?>

<div class="modal fade" id="tambahmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tambah</span> 
                    <span class="fw-light">
                    Kategori Menu
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Tambah Kategori Menu
                </p>
                <form method="post" action="<?= base_url('admin/tambah_kategori'); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama Kategori</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama kategori menu" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="<?=$dk['id'];?>" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>