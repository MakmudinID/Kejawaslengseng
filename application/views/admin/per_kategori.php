<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Daftar Menu</h4>
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
                        <a href="<?= base_url('admin/kategori_menu')?>"><?=$title;?></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Daftar Menu</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Menu : Kategori <?= $kategoriOnly['nama_kategori']; ?></h4>
                                <a class="btn btn-primary btn-round ml-auto btn-sm" href="<?=base_url('admin/tambah_menu')?>">
                                    <i class="fa fa-plus"></i>
                                    Tambah Menu
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                        
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr align="center">
                                            <th style="width: 5%">No.</th>
                                            <th>Nama Menu</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th style="width: 7%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($kategori as $dk) : ?>
                                    <tr>
                                        <td align="center"><?= $i; ?></td>
                                        <td><?= $dk['nama_menu']; ?></td>
                                        <td><?= $dk['deskripsi']; ?></td>
                                        <td align="right"><?= number_format($dk['harga']); ?></td>
                                        <td align="center">
                                            <div class="image-gallery avatar">
                                                <a href="<?= base_url('assets/img_menu/') . $dk['foto']; ?>" data-toggle="tooltip" data-original-title="Zoom Out" >
                                                    <img src="<?= base_url('assets/img_menu/') . $dk['foto']; ?>" class="avatar-img rounded">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="<?= base_url('admin/before_edit_per_kategori'); ?>/<?= $dk['id']; ?>" title="" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/hapus_per_kategori'); ?>/<?= $dk['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="return confirm('Data menu <?= $dk['nama_menu'] ?> akan dihapus?');"> 
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

<div class="modal fade" id="tambahmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tambah Menu</span> 
                    <span class="fw-light">
                    Kategori <?= $kategoriOnly['nama_kategori']; ?>
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Tambah Menu
                </p>
                <form method="post" action="<?= base_url('admin/tambah_per_kategori'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Nama Menu</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama kategori menu" autofocus required>
                                <input name="kategori" type="hidden" value="<?= $kategoriOnly['id']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="harga" id="rupiah" placeholder="Masukkan harga" required>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group form-group-default">
                                <label>Deskripsi</label>
                                <textarea class="form-control" id="summernote" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <center>
                            <div class="input-file input-file-image">
                                <img class="img-upload-preview" width="150" height="150" src="http://placehold.it/150x150" alt="preview">
                                <input type="file" class="form-control form-control-file" id="uploadImg2" name="gambar" accept="image/*" required>
                                <label for="uploadImg2" class="  label-input-file btn btn-black btn-round">
                                    <span class="btn-label">
                                        <i class="fa fa-file-image"></i>
                                    </span>
                                    Upload Foto
                                </label>
                            </div>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($kategori as $dk) : ?>
<div class="modal fade" id="<?=$dk['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit</span> 
                    <span class="fw-light">
                    Menu
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Edit Menu
                </p>
                <form method="post" action="<?= base_url('admin/tambah_per_kategori'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Nama Menu</label>
                                <input id="nama" value="<?= $dk['nama_menu']; ?>" name="nama" type="text" class="form-control" placeholder="Masukkan nama kategori menu" autofocus required>
                                <input name="kategori" type="hidden" value="<?= $kategoriOnly['id']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Harga</label>
                                <input type="text" value="<?= $dk['harga']; ?>" class="form-control" name="harga" id="rupiah2" placeholder="Masukkan harga" required>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group form-group-default">
                                <label>Deskripsi</label>
                                <textarea class="form-control" id="summernote_edit" name="deskripsi"><?= $dk['deskripsi']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <center>
                            <div class="input-file input-file-image">
                                <img class="img-upload-preview" width="150" height="150" src="<?= base_url() . 'assets/img_menu/' . $dk['foto'] ?>" alt="preview">
                                <input type="file" class="form-control form-control-file" id="uploadImg2" name="gambar" accept="image/*" required>
                                <label for="uploadImg2" class="  label-input-file btn btn-black btn-round">
                                    <span class="btn-label">
                                        <i class="fa fa-file-image"></i>
                                    </span>
                                    Upload Foto
                                </label>
                            </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>