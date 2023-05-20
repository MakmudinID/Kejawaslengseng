<div class="main-panel">
    <div class="container container-full">
        <div class="page-navs bg-white">
            <div class="nav-scroller">
                <div class="nav nav-tabs nav-line nav-color-primary d-flex align-items-center justify-contents-center w-100">
                    <?php foreach ($kategori as $kat) : ?>
                        <?php if ($this->session->userdata('id_def') == $kat['id']) : ?>
                            <a class="nav-link active show" href="<?= base_url('order/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php else : ?>
                            <a class="nav-link" href="<?= base_url('order/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <?= $this->session->flashdata('message');
            // $this->session->sess_destroy(); ?>
            <div class="row row-projects">
                <?php foreach ($byMenu as $i) : ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="p-1">
                                <img class="card-img-top rounded" src="<?= base_url('assets'); ?>/img_menu/<?= $i['foto']; ?>" alt="<?= $i['nama_menu']; ?>" style="height: 250px;">
                            </div>
                            <div class="card-body pt-1">
                                <h5 class="mb-1 fw-bold text-center mt-1 text-uppercase"><?= htmlspecialchars_decode($i['nama_menu']); ?></h5>
                                <h3 class="mb-1 fw-bold text-center">Rp. <?= number_format($i['harga']); ?></h3>
                                <p class="text-muted small mb-2 text-center">
                                    <?php if ($i['stok'] != "0") : ?>
                                        Tersisa <?= $i['stok']; ?> porsi
                                    <?php else : ?>
                                        <span class="text-muted small mb-2 text-center text-danger fw-bold">HABIS</span>
                                    <?php endif; ?>
                                </p>
                                <?php if ($i['stok'] != "0") : ?>
                                    <center>
                                        <div class="input-group text-center" style="width:200px;">
                                            <input type="hidden" name="id_b" id="id_b" value="<?= $i['id']; ?>">
                                            <input class="form-control text-center" type="number" name="quantity" id="<?= $i['id']; ?>" value="1" placeholder="Qty" required><br>
                                            <div class="input-group-prepend">
                                                <button class="add_cart btn btn-primary btn-sm" id="alert<?= $i['id']; ?>" data-menuid="<?= $i['id']; ?>" data-stok="<?= $i['stok']; ?>" data-menunama="<?= $i['nama_menu']; ?>" data-menuharga="<?= $i['harga']; ?>" data-menufoto="<?= $i['foto']; ?>">Pilih</button>
                                            </div>
                                        </div>
                                    </center>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

<!-- Modal konfirmasi -->
<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Jenis</span>
                    <span class="fw-light">
                        Layanan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-pills nav-primary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                    <li class="nav-item  text-center">
                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                            <i class="fas fa-couch"></i>
                            DINE IN <br> <small>Makan Ditempat</small>
                        </a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" id="pills-contact-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                            <i class="fas fa-store"></i>
                            TAKE AWAY <br> <small>Pesanan diambil di Resto</small>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                    <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                        <form method="post" id="DineInForm" action="<?= base_url('order/konfirmasi/'); ?>">
                            <div class="form-group form-group-default">
                                <label>Nama Pemesan</label>
                                <input id="namapemesan" name="namapemesan" type="text" class="form-control" placeholder="Masukkan nama pemesan" autofocus required>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="sekarang" name="status" value="sekarang" class="detail custom-control-input">
                                            <label class="custom-control-label" for="sekarang">Pesan Sekarang</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="lebihawal" name="status" value="lebihawal" class="detail custom-control-input">
                                            <label class="custom-control-label" for="lebihawal">Pesan Lebih Awal</label>
                                        </div>
                                    </div>
                                    <div class="input-group" id="form-input">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                        <input type="text" placeholder="Masukkan jam makan" class="form-control" id="timepicker" name="waktu" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fab fa-whatsapp"></i>
                                            </span>
                                        </div>
                                        <input type="text" placeholder="Masukkan nomor kontak" class="form-control" name="nomorkontak" required>
                                    </div>
                                    <div id="form-sekarang">
                                        Pesanan anda akan diproses sekarang juga.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-default mt-2">
                                <label>Catatan Pemesan</label>
                                <textarea id="catatan" rows="3" name="catatan" class="form-control" placeholder="Catatan Pemesan (Optional)" autofocus required></textarea>
                            </div>
                            <input type="hidden" name="layanan" value="1">
                            <button type="button" onclick="postDineIn()" class="btn btn-primary" style="width:100%;">Proses Pesanan</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-contact-tab-icon">
                        <form method="post" action="<?= base_url('order/konfirmasi/'); ?>">
                            <div class="form-group form-group-default">
                                <label>Nama Pemesan</label>
                                <input id="namapemesan" rows="5" name="namapemesan" class="form-control" placeholder="Masukkan nama pemesan" autofocus required>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group" id="form-input">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fab fa-whatsapp"></i>
                                            </span>
                                        </div>
                                        <input type="text" placeholder="Masukkan nomor kontak" class="form-control" name="nomorkontak" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email" placeholder="Masukkan alamat email" class="form-control" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-default mt-3">
                                <label>Catatan Pemesan</label>
                                <textarea id="catatan" rows="3" name="catatan" class="form-control" placeholder="Catatan Pemesan (Optional)" autofocus required></textarea>
                            </div>
                            <input type="hidden" name="layanan" value="0">
                            <button type="submit" class="btn btn-primary" style="width:100%;">Proses Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function postDineIn() {
        document.getElementById("DineInForm").submit();
    }
</script>