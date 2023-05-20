<div class="main-panel">
    <div class="container container-full">
        <div class="page-navs bg-white">
            <div class="nav-scroller">
                <div class="nav nav-tabs nav-line nav-color-primary d-flex align-items-center justify-contents-center w-100">
                    <?php foreach ($kategori as $kat) : ?>
                        <?php if ($this->session->userdata('id_def') == $kat['id']) :?>
                            <a class="nav-link active show" href="<?= base_url('pembeli/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php else:?>
                            <a class="nav-link" href="<?= base_url('pembeli/temp') ?>/<?= $kat['id']; ?>"><?= $kat['nama_kategori'] ?></a>
                        <?php endif;?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <div class="row row-projects">
                <?php foreach ($byMenu as $i) : ?>
    				<div class="col-sm-6 col-lg-3">
    					<div class="card">
    						<div class="p-2">
    						    <img class="card-img-top rounded" src="<?= base_url('assets'); ?>/img_menu/<?= $i['foto']; ?>" alt="<?= $i['nama_menu']; ?>" style="height: 180px;>
    						</div>
    						<div class="card-body pt-2">
    							<h4 class="mb-1 fw-bold text-center mt-3"><?= $i['nama_menu']; ?></h4>
    							<p class="text-muted small mb-2 text-center"><?= $i['deskripsi']; ?></p>
    							<h3 class="mb-1 fw-bold text-center">Rp. <?= number_format($i['harga']); ?></h3>
    							<p class="text-muted small mb-2 text-center">
    							    <?php if ($i['stok']!="0"):?>
                                         Tersisa <?= $i['stok']; ?> porsi
                                    <?php else:?>
                                        <span class="text-muted small mb-2 text-center text-danger fw-bold">HABIS</span>
                                    <?php endif;?>
                                </p>
                                <?php if ($i['stok']!="0"):?>
    							<center>
								<form method="post">
                                    <div class="input-group text-center mb-2" style="width:200px;">
                                        <input type="hidden" name="id_b" id="id_b" value="<?= $i['id']; ?>">
                                        <input class="form-control text-center" type="number" min="1" value="1" name="qty" id="qty" placeholder="Qty" required><br>
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary btn-sm" type="submit" name="btn_qty" id="btn_qty"><small> Tambah </small></button>
                                        </div>
                                    </div>
                                </form>
                                </center>
                                <?php endif;?>
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
                                    <tr align="center">
                                        <th scope="col">Menu</th>
                                        <th scope="col" style="width:10%;">Qty</th>
                                        <th scope="col" style="width:25%;">Total (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $ttl = 0;
                                    foreach ($listPesanan as $k) :
                                    ?>
                                        <tr>
                                            <td><?= $k['nama_menu']; ?></td>
                                            <td align="center"><?= $k['jumlah']; ?></td>
                                            <?php $tot = $k['harga'] * $k['jumlah'];
                                            $ttl += $tot; ?>
                                            <td align="right"><?= number_format($tot); ?></td>
                                        </tr>
                                    <?php $i += 1;
                                    endforeach; ?>
                                        <tr align="right">
                                            <td colspan="2"><b>Total Pembayaran</b></td>
                                            <td><b><?= number_format($ttl); ?></b></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <form method="post" action="<?= base_url('pembeli/konfirmasi/'.$k['id_pesanan']); ?>">
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
                                <button type="submit" class="btn btn-primary" style="width:100%;">Proses Pesanan</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Jumlah -->
<?php $i = 1; $ttl = 0; foreach ($listPesanan as $lp) : $ttl += $lp['harga'] * $lp['jumlah']?>
<div class="modal fade" id="<?= $lp['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Ubah</span> 
                    <span class="fw-light">
                    Jumlah Pesanan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('pembeli/update_qty/'.$lp['id']); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="avatar avatar-online">
									<img src="<?= base_url('assets'); ?>/img_menu/<?= $lp['foto']; ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1"><?= $lp['nama_menu']; ?></h6>
                                    <span class="text-muted"><?= $lp['deskripsi'];?></span><br>
                                    Rp. <?= number_format($lp['harga']); ?><br>
                                    Stok : <?= $lp['stok']; ?>
                                </div>
                                <div class="float-right pt-1">
                                    <div class="input-group">
                                        <input class="form-control" type="number" min="1" value="<?= $lp['jumlah']; ?>" name="qty" id="qty" placeholder="Qty" required style="width:75px;"><br>
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary btn-sm" type="submit" name="btn_qty" id="btn_qty"><small> Update </small></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>

