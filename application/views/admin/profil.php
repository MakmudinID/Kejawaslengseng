<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-9">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="fw-bold">Data Profil Restoran</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('admin/update_profil/'); ?>">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Nama Restoran</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Restoran" value="<?= $profil['nama_resto']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Nomor Kontak Restoran</label>
                                            <input type="text" class="form-control" name="nomor" placeholder="Nomor Kontak Restoran" value="<?= $profil['kontak_resto']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label class="mb-2">Tentang Restoran</label>
                                            <textarea class="form-control" id="keterangan" rows="5" name="keterangan" required><?= $profil['tentang_resto']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Instagram</label>
                                            <input type="text" class="form-control" name="ig" placeholder="URL Account" value="<?= $profil['ig']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" name="fb" placeholder="URL Account" value="<?= $profil['fb']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" name="twitter" placeholder="URL Account" value="<?= $profil['twitter']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Alamat Restoran</label>
                                            <textarea class="form-control" id="alamat" rows="5" name="alamat" required><?= $profil['alamat_resto']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Plugin Maps Restoran</label>
                                            <textarea rows="5" class="form-control" name="plugin" placeholder="Plugin Maps"><?= $profil['plugin_resto']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 mb-3">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <?= form_open_multipart('admin/foto'); ?>
                        <div class="card-header">
                            <h2 class="fw-bold text-center">Logo Restoran</h2>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="input-file input-file-image">
                                    <?php if (empty($profil['foto_resto'])) : ?>
                                        <center><img class="img-upload-preview" src="<?= base_url('assets/image/img_preview/no-image.png'); ?>" alt="preview"></center>
                                    <?php else : ?>
                                        <center><img class="img-upload-preview" src="<?= base_url('assets'); ?>/img_profil/<?= $profil['foto_resto']; ?>" alt="preview"></center>
                                    <?php endif; ?>
                                    <input type="file" class="form-control form-control-file" id="uploadImg1" name="gambar" accept="image/*" required="">
                                    <label for="uploadImg1" class="label-input-file btn btn-sm btn-black btn-round">
                                        <span class="btn-label">
                                            <i class="fa fa-file-image"></i>
                                        </span>
                                        Pilih foto
                                    </label>
                                    <input type="hidden" name="nama" value="<?= $profil['nama_resto']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-round" style="width: 100%;"> Simpan </button>
                        </div>
                        </form>
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
                <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>
        </div>
    </footer>
</div>