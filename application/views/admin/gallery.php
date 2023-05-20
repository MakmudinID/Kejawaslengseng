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
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Gallery Resto</h4>
                                <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#tambahgallery">
                                    <i class="fa fa-plus"></i>
                                    Tambah Gallery
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th style="width: 5%">No</th>
                                            <th>Judul</th>
                                            <th>Foto</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($gallery as $g) : ?>
                                            <tr>
                                                <td align="center"><b><?= $i++; ?></b></td>
                                                <td><b><?= $g['judul']; ?></b>
                                                </td>
                                                <td align="center">
                                                    <div class="row image-gallery text-center">
                                                        <a href="<?= base_url('assets'); ?>/img_gallery/<?= $g['foto']; ?>">
                                                            <img src="<?= base_url('assets'); ?>/img_gallery/<?= $g['foto']; ?>" style="height: 200px;" class="img-fluid">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('admin/hapus_gallery'); ?>/<?= $g['id']; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" onclick="return confirm('Gallery <?= $g['judul'] ?> akan dihapus?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
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

<div class="modal fade" id="tambahgallery" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Tambah</span>
                    <span class="fw-light">
                        Gallery <?= $profil['nama_resto']; ?>
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('admin/tambah_gallery'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <div class="input-file input-file-image">
                                    <img class="img-upload-preview" src="<?= base_url('assets/image/img_preview/no-image.png'); ?>" style="height:280px;" alt="preview">
                                    <input type="file" class="form-control form-control-file" id="uploadImg2" name="gambar" accept="image/*" required>
                                    <label for="uploadImg2" class="  label-input-file btn btn-sm btn-black btn-round">
                                        <span class="btn-label">
                                            <i class="fa fa-file-image"></i>
                                        </span>
                                        Pilih Foto
                                    </label>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-group form-group-default">
                                <label>Caption</label>
                                <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukkan Judul" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>