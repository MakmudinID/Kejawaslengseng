<div class="main-panel">
    <div class="container container-full">
        <div class="page-navs bg-white">
            <div class="nav-scroller">
                <div class="nav nav-tabs nav-line nav-color-primary d-flex align-items-center justify-contents-center w-100">
                    <?php foreach ($kategori as $kat) : ?>
                        <?php if ($this->session->userdata('id_def') == $kat['id']) : ?>
                            <a class="nav-link active show" href="<?= base_url('server/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php else : ?>
                            <a class="nav-link" href="<?= base_url('server/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <?= $this->session->flashdata('message'); ?>
            <div class="row row-projects">
                <?php foreach ($byMenu as $i) : ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="p-1">
                                <img class="card-img-top rounded" src="<?= base_url('assets'); ?>/img_menu/<?= $i['foto']; ?>" alt="<?= $i['nama_menu']; ?>" style="height: 250px;">
                            </div>
                            <div class="card-body pt-1">
                                <h5 class="mb-1 fw-bold text-center mt-1 text-uppercase"><?= htmlspecialchars_decode($i['nama_menu']); ?></h5>
                                <h3 class="mb-1 fw-bold text-center">Rp <?= number_format($i['harga'], 0, ',', '.'); ?></h3>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Konfirmasi</span>
                    <span class="fw-light">
                        Pesanan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Periksa pesananmu apakah sudah benar. Makanan yang sudah dipesan tidak dapat dibatalkan</p>
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table" style="width:100%;">
                                <thead>
                                    <th scope="col">Menu</th>
                                    <th scope="col" style="width:10%;">Qty</th>
                                    <th scope="col" style="width:25%;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="tablecart">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form method="post" action="<?= base_url('server/konfirmasi/'); ?>">
                            <div class="form-group form-group-default">
                                <label>Nama Pemesan</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama pemesan" autofocus required>
                            </div>
                            <div class="form-group form-group-default">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="dinein" name="status" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="dinein">Makan di Tempat</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="takeaway" name="status" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="takeaway">Bawa Pulang</label>
                                </div>
                            </div>

                            <div class="form-group form-group-default">
                                <label>Catatan Pesanan</label>
                                <textarea id="note" name="note" type="text" class="form-control" placeholder="Catatan (optional)" autofocus rows="4" cols="50"></textarea>
                            </div>
                            <button type="submit" class="proses_pesanan btn btn-primary" style="width:100%;">Proses Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>