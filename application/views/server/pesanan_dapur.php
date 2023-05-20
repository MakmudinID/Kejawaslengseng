<div class="main-panel">
    <div class="container container-full">
        <div class="page-inner">
            <div class="row row-projects">
                <div class="card-columns">
                    <?php $i = 1;
                    foreach ($listPesanan as $rp) : ?>
                        <div class="card">
                            <div class="card-body pt-2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="mb-1 fw-bold latar">Pesanan No: K<?= $rp['id']; ?></h3>
                                        <h2 class="mb-2 fw-bold latar"><span style="background-color: black; color: white; padding:2px;"><?= $rp['atas_nama']; ?></span></h2>
                                        <span class="badge badge-count text-right"><?= $rp['ket']; ?></span> <span class="badge badge-count text-right"><?= $rp['keterangan']; ?></span>
                                    </div>
                                </div>
                                <style>
                                    table {
                                        border-collapse: collapse;
                                        width: 100%;
                                    }

                                    th {
                                        padding: 8px;
                                        text-align: center;
                                        border-bottom: 1px solid #ddd;
                                    }

                                    td {
                                        padding: 8px;
                                        border-bottom: 1px solid #ddd;
                                    }
                                </style>
                                <hr>
                                <table style="width:100%;" class="mt-2">
                                    <tr>
                                        <th>Menu Pesanan</th>
                                        <th width="10%">Status</th>
                                    </tr>
                                    <?php
                                    $id = $rp['id'];
                                    $datapesanan = "SELECT detail_pesanan.*, menu.nama_menu
                                    FROM `detail_pesanan` JOIN `menu`
                                    ON `detail_pesanan`.`id_menu` = `menu`.`id`
                                    WHERE `detail_pesanan`.`id_pesanan` = $id
                                    ";
                                    $data = $this->db->query($datapesanan)->result_array();
                                    ?>
                                    <?php foreach ($data as $dp) : ?>
                                        <?php if ($dp['status'] == 1) : ?>
                                            <tr style="background-color:#ffc107">

                                            <?php else : ?>
                                            <tr>

                                            <?php endif; ?>

                                            <td>(<?= $dp['jumlah']; ?>) <?= $dp['nama_menu']; ?></td>
                                            <td valign="top" align="center">
                                                <?php if ($dp['status'] == 1) : ?>
                                                    <div class="text-success">
                                                        <i class="fas fa-toggle-on fa-2x"></i>
                                                    </div>
                                                <?php else : ?>
                                                    <a href="<?= base_url(); ?>server/hapus_barang_dapur/<?= $dp['id']; ?>" data-toggle="tooltip" data-original-title="Batalkan" onclick="return confirm('Pesanan <?= $dp['nama_menu'] ?> akan dibatalkan?');">
                                                        <span class="text-danger">
                                                            <i class="fas fa-times fa-2x"></i>
                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            </tr>
                                        <?php endforeach; ?>
                                </table>


                                <?php if ($rp['status'] == 1) : ?>
                                    <br><span class="text-muted text-primary fw-bold">Makan Ditempat</span>
                                <?php elseif ($rp['status'] == "0") : ?>
                                    <br><span class="text-info fw-bold">Bawa Pulang</span>
                                <?php endif; ?>

                                <?php if ($rp['note'] != null) : ?>
                                    <br><span class="text-muted text-danger">Catatan : <?= $rp['note']; ?></span>
                                <?php endif; ?>

                                <hr>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                        <div class="accordion accordion-black">
                                            <div class="card">
                                                <div class="card-header collapsed" id="heading<?= $rp['id']; ?>" data-toggle="collapse" data-target="#collapse<?= $rp['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $rp['id']; ?>" role="button">
                                                    <div class="span-title fw-bold">
                                                        Tambah Orderan
                                                    </div>
                                                    <div class="span-mode"></div>
                                                </div>
                                                <div id="collapse<?= $rp['id']; ?>" class="collapse" aria-labelledby="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <form method="post" action="<?= base_url('server/tambah_orderan'); ?>">
                                                            <div class="form-group form-show-validation row">

                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="select2-input">
                                                                        <select id="basic<?= $rp['id']; ?>" name="menu" class="form-control" required style="width:100%;">
                                                                            <option value="">Ketik nama menu di sini..</option>
                                                                            <?php foreach ($daftarmenu as $menu) : ?>
                                                                                <option value="<?= $menu['id']; ?>"><?= $menu['nama_menu']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <input type="number" class="form-control text-center" name="jumlah" value="1">
                                                                    <input type="hidden" name="idpesanan" value="<?= $rp['id']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button class="btn btn-primary" style="width:100%;"><span class="fw-bold">Tambah Pesanan</span></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if ($listPesanan == null) : ?>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body pt-2">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h3 class="mb-1 fw-bold mt-3 fw-bold"><span style="background-color: red; color: white; padding:2px;">Tidak ada pesanan</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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