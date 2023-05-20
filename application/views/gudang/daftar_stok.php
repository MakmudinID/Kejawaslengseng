<div class="main-panel">
    <div class="container container-full">
        <div class="page-navs bg-white">
            <div class="nav-scroller">
                <div class="nav nav-tabs nav-line nav-color-primary d-flex align-items-center justify-contents-center w-100">
                    <?php foreach ($kategori as $kat) : ?>
                        <?php if ($this->session->userdata('id_def') == $kat['id']) :?>
                            <a class="nav-link active show" href="<?= base_url('gudang/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php else:?>
                            <a class="nav-link" href="<?= base_url('gudang/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php endif;?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="page-inner">
        <?= $this->session->flashdata('message');  ?>
            <div class="row">
                       <?php foreach ($byMenu as $i) : ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="p-2">
                                    <img class="card-img-top rounded" src="<?= base_url('assets'); ?>/img_menu/<?= $i['foto']; ?>" style="height: 250px;">
                                </div>
                                <div class="card-body pt-2">
                                    <h5 class="fw-bold text-center"><?= $i['nama_menu']; ?></h5>
                                    <div class="separator-dashed"></div>
                                    <h4 class="text-center">Rp. <?= number_format($i['harga']); ?></h4>
                                    <div class="separator-dashed"></div>
                                    <div class="form-group" style="width:100%;">
                                        <form method="post" action="<?= base_url('gudang/ubah_stok'); ?>/<?= $i['id']; ?>">
                                            <div class="input-group">
                                                <input type="hidden" name="id_b" id="id_b" value="<?= $i['id']; ?>">
                                                <input class="form-control" type="number" min="1" value="<?= $i['stok']; ?>" name="stok" id="stok" placeholder="Qty" required><br>
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary btn-sm" type="submit" name="btn_qty" id="btn_qty"><small>Update</small></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
                <?=date('Y')?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>				
        </div>
    </footer>
</div

