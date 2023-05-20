<div class="main-panel">
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Halo, <?= $saya_karyawan['nama']; ?>! <br> Ini kabar terbaru dari restomu</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?= base_url('admin/tambah_menu'); ?>" class="btn btn-white btn-border btn-round mr-2">Tambah Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Rangkuman Statistik</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-1"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Pengguna Aplikasi</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-2"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Kategori Menu</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-3"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Menu Makanan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Total Pendapatan & Statistik <small>*dalam seminggu</small></div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Total Pendapatan</h6>
                                        <h3 class="fw-bold"><?php
                                                            $total = 0;
                                                            $disc =0;
                                                            foreach ($penghasilan as $jmlh) :
                                                                $subtotal = $jmlh['pendapatan'];
                                                                $diskon = $jmlh['diskon'];
                                                                $total += $subtotal;
                                                                $disc += $diskon;
                                                            ?>
                                            <?php endforeach; ?>
                                            Rp <?= number_format($total-$disc, 0, ',', '.'); ?></h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Total Pajak</h6>
                                        <h3 class="fw-bold"><?php
                                                            $total1 = 0;
                                                            foreach ($penghasilan as $jmlh) :
                                                                $subtotal1 = $jmlh['ppn'];
                                                                $total1 += $subtotal1;
                                                            ?>
                                            <?php endforeach; ?>
                                            Rp <?= number_format($total1, 0, ',', '.'); ?></h3>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="chart-container">
                                        <canvas id="totalIncomeChart"></canvas>
                                    </div>
                                </div>
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
                <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>
        </div>
    </footer>
</div>