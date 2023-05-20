<!-- Custom template | don't include it in your project! -->
	<div class="custom-template">
		<div class="title">Daftar Pesanan</div>
		<div class="custom-content">
			<?php $i = 1; $ttl = 0; foreach ($listPesanan as $lp) : $ttl += $lp['harga'] * $lp['jumlah']?>
                <style>
                    table {
                      border-collapse: collapse;
                      width: 100%;
                    }
                    
                    th {
                      padding: 5px;
                      text-align: center;
                      border-bottom: 1px solid #ddd;
                    }
                    td {
                      padding: 5px;
                      border-bottom: 1px solid #ddd;
                    }
                </style>
			    <table style="width:100%;">
			        <tr>
			            <td>
                            <div class="d-flex">
                                <div class="avatar avatar-online">
    								<img src="<?= base_url('assets'); ?>/img_menu/<?= $lp['foto']; ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <span class="category-title"><h6 class="text-uppercase fw-bold mb-1"><?= $lp['nama_menu']; ?></h6></span>
                                    <div class="contact-list contact-list-recent">
                                        <span class="text-muted">Rp. <?= number_format($lp['harga'] * $lp['jumlah']);?></span><br>
                                        <a href="<?= base_url(); ?>server/hapus_barang/<?= $lp['id']; ?>" class="badge badge-danger mt-2"><i class="fas fa-trash"></i> Batal</a>
                                        <a href="#<?= $lp['id']; ?>" class="badge badge-info mt-2" data-toggle="modal"><i class="fas fa-edit"></i> Ubah</a>
                                    </div>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted fw-bold">
                                        x <?= $lp['jumlah']; ?>
                                    </small>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="separator-dashed"></div>
            <?php $i += 1; endforeach; ?>
                <?php if($ttl=="0"):?>
                    <h6 class="text-uppercase fw-bold mt-3">Tidak ada data pesanan</h6>
                <?php else:?>
                    <div class="d-flex">
                        <div class="flex-1 pt-1">
                            <h6 class="text-uppercase fw-bold mt-3">Total : Rp. <?= number_format($ttl);?></h6>
                        </div>
                        <div class="float-right">
                            <div class="text-muted fw-bold">
                                <button type="button" data-toggle="modal" class="btn btn-border btn-primary mt-3" data-target="#konfirmasi" class="btn btn-primary btn-border mt-2"><b>Pesan</b></button>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
		</div>
		<div class="custom-toggle">
			<!--<i class="flaticon-settings"></i>--> <small>List</small> 
		</div>
	</div>
<!-- End Custom template -->