<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-4">
                    <form method="post" action="<?= base_url('gudang/tambah_bahan'); ?>">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"><i class="far fa-edit"></i> Entri Pembelian Bahan</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mb-2">Nama Bahan</label>
                                    <input type="text" class="form-control" name="nama" id="nama" required>
                                    <label class="mb-2">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" id="jumlah" required>
                                    <label class="mb-2">Harga Beli</label>
                                    <input type="text" class="form-control" name="harga" id="rupiah" required>
                                </div>
                                <button type="submit" class=" add_cart btn btn-primary btn-round ml-auto mt-3" style="width: 100%;">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Daftar Pembelian</div>
                            </div>
                        </div>
                        <div class="card-body">
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
                                            <th>Hapus</th>
                                        </tr>
                                        <?php $i = 1;
                                        $ttl = 0;
                                        foreach ($listBahan as $rp) : ?>
                                            <tr>
                                                <td align="center"><?= $i; ?></td>
                                                <td><?= $rp['nama_bahan']; ?></td>
                                                <td align="center"><?= $rp['jumlah']; ?></td>
                                                <td align="right"><?= number_format($rp['harga']);
                                                        $ttl += $rp['harga']; ?></td>
                                                <td align="center"><a href="<?= base_url('gudang/hapus'); ?>/<?= $rp['idbahan']; ?>">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a></td>
                                            </tr>
                                        <?php $i += 1;
                                        endforeach; ?>
                                            <tr>
                                                <td colspan="3" align="right"><b>Total (Rp)</b></td>
                                                <td align="right"><b><?= number_format($ttl); ?></b></td>
                                            </tr>
                                </table>
                            </div>
                            <div class="separator-dashed"></div>
                            <?php if($ttl != "0"):?>
                            <center>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" data-toggle="modal" data-target="#checkout" class=" btn btn-primary btn-round btn-border" style="width:100%;"><b>Checkout</b></button>
                                    </div>
                                </div>
                            </center>
                            <?php endif;?>
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

<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Konfirmasi</span> 
                    <span class="fw-light">
                    Pembelian
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-7">
                        <div class="table-responsive">
                            <table class="table table-striped" border="1">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Beli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $ttl = 0;
                                    foreach ($listBahan as $rp) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $rp['nama_bahan']; ?></td>
                                            <td><?= $rp['jumlah']; ?></td>
                                            <td align="right"><?= number_format($rp['harga']);
                                                    $ttl += $rp['harga']; ?></td>
                                        </tr>
                                    <?php $i += 1;
                                    endforeach; ?>
                                        <tr>
                                            <td colspan="3" align="right"><b>Total (Rp)</b></td>
                                            <td align="right"><b><?= number_format($ttl); ?></b></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-5">
                        <form action="<?= base_url('gudang/konfirmasi'); ?>" method="post">
                            <div class="form-group form-group-default">
                                <label>Judul/No.Invoice</label>
                                <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukkan judul/No.Invoice" required>
                            </div>
                            <div class="form-group form-group-default">
                                <label>Catatan</label>
                                <input id="catatan" name="catatan" type="text" class="form-control" placeholder="Catatan (optional)">
                            </div>
                            <div class="form-group form-group-default">
                            <button type="submit" class=" btn btn-primary btn-round" style="width:100%;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
