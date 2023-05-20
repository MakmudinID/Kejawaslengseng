<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="page-pretitle">
                                Pembelian Bahan
                            </h6>
                            <h4 class="page-title"><?= $bahan['judul']; ?></h4>
                        </div>
                        <div class="col-auto">
                            <a href="<?=base_url('gudang')?>" class="btn btn-light btn-border">
                                Kembali
                            </a>
                        </div>
                    </div>
                    <div class="page-divider"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-invoice">
                                <div class="card-header">
                                    <div class="invoice-header">
                                        
                                            <div class="col-md-4">
                                                <h5 class="sub">Tgl. Pembelian</h5>
                                                <h5 class="sub">Penanggung Jawab</h5>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="sub">: <?= $bahan['tgl']; ?></h5>
                                                <h5 class="sub">: <?= $bahan['nama']; ?></h5>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="separator-solid"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice-detail">
                                                <div class="invoice-top">
                                                    <h3 class="title"><strong>Ringkasan Pembelian</strong></h3>
                                                </div>
                                                <div class="invoice-item">
                                                    <div class="table-responsive">
                                                    <style>
                                                    table, td, th {  
                                                      border: 1px solid #ddd;
                                                    }
                                                    
                                                    table {
                                                      border-collapse: collapse;
                                                      width: 100%;
                                                    }
                                                    
                                                    th, td {
                                                      padding: 10px;
                                                    }
                                                    </style>
						                            <table style="width:100%;">
                                                                <tr align="center">
                                                                    <th>No</th>
                                                                    <th>Nama Bahan</th>
                                                                    <th>Jumlah Beli</th>
                                                                    <th>Harga Beli</th>
                                                                </tr>
                                                                <?php $i = 1;
                                                                $ttl = 0;
                                                                foreach ($listBahan as $rp) : ?>
                                                                    <tr>
                                                                        <td align="center"><?= $i; ?></td>
                                                                        <td><?= $rp['nama_bahan']; ?></td>
                                                                        <td align="center"><?= $rp['jumlah']; ?></td>
                                                                        <td>Rp. <?= number_format($rp['harga']);
                                                                                $ttl += $rp['harga']; ?></td>

                                                                    </tr>
                                                                <?php $i += 1;
                                                                endforeach; ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                            <div class="separator-solid  mb-3"></div>
                                        </div>	
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-12 transfer-total">
                                            <h5 class="sub">Total</h5>
                                            <div class="price">Rp. <?= number_format($ttl); ?></div>
                                        </div>
                                    </div>
                                    <div class="separator-solid"></div>
                                    <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                                        Notes
                                    </h6>
                                    <p class="text-muted mb-0">
                                        <?= $bahan['Catatan']; ?>
                                    </p>
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
                <?=date('Y')?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>				
        </div>
    </footer>
</div>
