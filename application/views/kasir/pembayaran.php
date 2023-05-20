<div class="main-panel">
	<div class="container container-full">
		<div class="page-inner">
			<div class="row row-projects">
				<?php $i = 1;
				foreach ($listPesanan as $rp) : ?>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-body pt-2">
								<div class="row">
									<div class="col-lg-12">
										<h3 class="mb-1 fw-bold">Pesanan No: <span style="background-color: black; color: white; padding:2px;">K<?= $rp['id']; ?></span> | <a href="<?= base_url('kasir/konfirmasi/' . $rp['id']) ?>" style="text-decoration: none;"><span style="background-color: red; color: white; padding:2px;">Detail</span></a></h3>
										<h4 class="mb-1 mt-4">Pemesan: <?= $rp['atas_nama']; ?></h4>
										<h1 class="mb-1 fw-bold">Total : Rp <?= number_format($rp['total_harga'], 0, ',', '.'); ?></h1>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<?php if ($rp['status'] == 1) : ?>
											<br><span class="text-muted text-primary fw-bold">Makan Ditempat</span>
										<?php elseif ($rp['status'] == "0") : ?>
											<br><span class="text-info fw-bold">Bawa Pulang</span>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<?php if ($listPesanan == null) : ?>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-body pt-2">
								<div class="row">
									<div class="col-lg-8">
										<h3 class="mb-1 fw-bold mt-3"><span style="background-color: red; color: white; padding:2px;">Tidak ada Tagihan</span></h3>
									</div>
								</div>
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