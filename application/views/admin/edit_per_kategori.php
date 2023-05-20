<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Menu</h4>
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
                        <a href="<?= base_url('admin/kategori_menu')?>">Kategori Menu</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/per_kategori')?>"> Daftar Menu</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Menu</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Menu</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('admin/edit_per_kategori'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-group-default">
                                            <label>Nama Menu</label>
                                            <input id="nama" name="nama" value="<?= $perKategori['nama_menu']; ?>" type="text" class="form-control" placeholder="Masukkan nama kategori menu" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-group-default">
                                            <label>Kategori Menu</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <?php foreach ($kategori as $st) : ?>
                                                    <?php if ($st['id'] == $perKategori['id_kategori']) : ?>
                                                        <option value="<?= $st['id']; ?>" selected><?= $st['nama_kategori']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $st['id']; ?>"><?= $st['nama_kategori']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-group-default">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" value="<?= $perKategori['harga']; ?>" name="harga" id="rupiah" placeholder="Masukkan harga" required>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group form-group-default">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" id="summernote" name="deskripsi"><?= $perKategori['deskripsi']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <center>
                                        <div class="input-file input-file-image">
                                            <img class="img-upload-preview" width="150" height="150" src="<?= base_url('assets/img_menu/') . $perKategori['foto']; ?>" alt="preview">
                                            <input type="file" class="form-control form-control-file" id="uploadImg2" name="gambar" accept="image/*">
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
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="<?= base_url('admin/per_kategori')?>" class="btn btn-danger" >Batal</a>
                                     </div>
                                </div>
                            </form>
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