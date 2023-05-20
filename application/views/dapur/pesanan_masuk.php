<!--<?php if ($menunggu['now'] > 0) : ?>-->
<!--    <audio autoplay>-->
<!--        <source src="<?= base_url('assets/that-was-quick.mp3'); ?>">-->
<!--    </audio>-->
<!--<?php endif; ?>-->

<div class="main-panel">
    <div class="container container-full">
        <div class="page-inner">
            <?= $this->session->flashdata('message');  ?>
            <div class="row row-projects">
                <?php if ($listPesanan != null) : ?>
                    <div class="card-columns">
                        <?php $i = 1;
                        foreach ($listPesanan as $rp) : ?>
                            <div class="card">
                                <div class="card-body pt-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="mb-1 fw-bold latar">Pesanan No: K<?= $rp['id']; ?> </h3>
                                            <h2 class="mb-1 fw-bold latar"><span style="background-color: black; color: white; padding:2px;"><?= htmlspecialchars($rp['atas_nama']); ?></span></h2>
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="btn-group dropdown" style="height:100%; width:100%;">
                                                <button class="<?= $rp['class2']; ?>" type="button" data-toggle="dropdown">
                                                    <b><?= $rp['ket']; ?></b>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <?php if ($rp['ket'] == "Menunggu") : ?>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('dapur/prosesmasak/' . $rp['id']); ?>">Proses Dimasak</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="<?= base_url('dapur/selesai/' . $rp['id']); ?>">Proses Selesai</a>
                                                        </li>
                                                    <?php elseif ($rp['ket'] == "Dimasak") : ?>
                                                        <li>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="<?= base_url('dapur/selesai/' . $rp['id']); ?>">Selesai</a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
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
                                            <th>
                                                <font size="4">Menu Pesanan </font>
                                            </th>
                                            <th width="10%">
                                                <font size="4">Qty</font>
                                            </th>
                                            <?php if ($rp['id_status2'] != 1) : ?>
                                                <th width="10%">
                                                    <font size="4"></font>
                                                </th>
                                            <?php endif; ?>

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

                                                <td valign="top">
                                                    <font size="4"><?= $dp['nama_menu']; ?></font>
                                                </td>
                                                <td valign="top" align="center">
                                                    <font size="4"><?= $dp['jumlah']; ?></font>
                                                </td>

                                                <?php if ($rp['id_status2'] != 1) : ?>
                                                    <td valign="top">
                                                        <font size="4">
                                                            <?php if ($dp['status'] == 1) : ?>
                                                                <div class="text-success">
                                                                    <!--<a href="<?= base_url('dapur/proses_belum/'); ?>-->
                                                                    <a href="#" data-toggle="tooltip" data-original-title="Selesai">
                                                                        <i class="fas fa-toggle-on fa-2x"></i>
                                                                    </a>
                                                                </div>
                                                            <?php else : ?>
                                                                <span class="text-danger">
                                                                    <a href="<?= base_url('dapur/proses_selesai/'); ?><?= $dp['id']; ?>"><i class="fas fa-toggle-off fa-2x"></i></a>
                                                                </span>
                                                            <?php endif; ?>
                                                        </font>
                                                    </td>
                                                <?php endif; ?>

                                                </tr>
                                            <?php endforeach; ?>
                                    </table>

                                    <?php if ($rp['status'] == 1) : ?>
                                        <br><span class="text-muted text-primary fw-bold">
                                            <font size="4">Makan Ditempat</font>
                                        </span>
                                    <?php elseif ($rp['status'] == "0") : ?>
                                        <br><span class="text-info fw-bold">
                                            <font size="4">Bawa Pulang</font>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($rp['note'] != null) : ?>
                                        <br><span class="text-muted text-danger">
                                            <font size="4">Catatan : <br> <?= htmlspecialchars_decode($rp['note']); ?></font>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body pt-2">
                                <h3 class="mb-1 fw-bold mt-3 fw-bold"><span style="background-color: red; color: white; padding:2px;">Tidak ada pesanan</span></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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