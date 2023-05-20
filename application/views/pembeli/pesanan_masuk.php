<?php if($menunggu['now'] > 0):?>
    <audio autoplay>
      <source src="<?=base_url('assets/that-was-quick.mp3');?>">
    </audio>
<?php endif; ?>

<div class="main-panel">
    <div class="container container-full">
        <div class="page-inner">
			<div class="row row-projects">
			    <?php $i = 1; foreach ($listPesanan as $rp) : ?>
				<div class="col-sm-6 col-lg-4">
					<div class="card">
						<div class="card-body pt-2">
						    <div class="row">
						        <div class="col-lg-6">
						            <h3 class="mb-1 fw-bold latar">Pesanan No:</h3>
							        <h1 class="mb-1 fw-bold latar"><span style="background-color: black; color: white; padding:2px;">K<?= $rp['id']; ?></span></h1>
						        </div>
						        <div class="col-lg-6 text-right">
						           <div style="height:100%;">
											<button class="<?= $rp['class2']; ?>" style="height:100%;">
											    <b><?= $rp['ket']; ?></b> 
											</button>
										
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
                                  text-align: left;
                                  border-bottom: 1px solid #ddd;
                                }
                            </style>
						    <table style="width:100%;" class="mt-2">
						        <tr>
						            <th width="10%">No</th>
						            <th>Nama Pesanan</th>
						            <th width="10%">Qty</th>
						        </tr>
						        <?php
                                    $id = $rp['id'];
                                    $datapesanan= "SELECT detail_pesanan.*, menu.nama_menu
                                    FROM `detail_pesanan` JOIN `menu`
                                    ON `detail_pesanan`.`id_menu` = `menu`.`id`
                                    WHERE `detail_pesanan`.`id_pesanan` = $id
                                    ";
                                    $data = $this->db->query($datapesanan)->result_array();
                                ?>
                                <?php $j=1; foreach ($data as $dp) : ?>
                                <tr>
                                    <td valign="top"><?= $j++; ?></td>
                                    <td><?=$dp['nama_menu'];?></td>
                                    <td valign="top"><?=$dp['jumlah'];?></td>
                                </tr>
                                <?php endforeach; ?>
						    </table>
						        
				             <?php if($rp['status'] == 1) : ?>
				                <br><span class="text-muted text-primary fw-bold">Makan Ditempat</span>
				             <?php elseif($rp['status'] == "0") : ?>
				                <br><span class="text-info fw-bold">Bawa Pulang</span>
				             <?php endif;?>
						            
						    <?php if($rp['note'] != null) : ?>
                                <br><span class="text-muted text-danger">Catatan : <?=$rp['note'];?></span>
                            <?php endif;?>
                            <p><a href="http://wa.me/6285875787869">Klik Disini</a>Untuk konfirmasi pembayaran anda </p>
						</div>
					</div>
				</div>
				<?php endforeach;?>
				
				<?php if($listPesanan == null):?>
				<div class="col-sm-6 col-lg-4">
					<div class="card">
						<div class="card-body pt-2">
						    <div class="row">
						        <div class="col-lg-8">
						            <h3 class="mb-1 fw-bold mt-3"><span style="background-color: red; color: white; padding:2px;">Tidak ada pesanan</span></h3>
						        </div>
						    </div>
						</div>
					</div>
				</div>
				<?php endif;?>
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



