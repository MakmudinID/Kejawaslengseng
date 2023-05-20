<div class="main-panel">
	<div class="bg-primary2 pt-4 pb-5">
		<div class="container text-white py-2">
			<div class="d-flex align-items-center">
				<div class="mr-3">
					<h1 class="mb-3">Tentang Kami <?= $profil['nama_resto']; ?></h1>
					<h5 class="op-7 mb-3"><?= htmlspecialchars_decode($profil['alamat_resto']); ?></h5>
				</div>
				<div class="ml-auto">
					<?php if (!empty($profil['ig'])) : ?>
						<a href="<?= $profil['ig'] ?>" target="_blank"><i class="fab fa-instagram fa-2x text-white"></i></a>
					<?php elseif (!empty($profil['fb'])) : ?>
						<a href="<?= $profil['fb'] ?>" target="_blank"><i class="fab fa-facebook fa-2x text-white ml-2"></i></a>
					<?php elseif (!empty($profil['twitter'])) : ?>
						<a href="<?= $profil['twitter'] ?>" target="_blank"><i class="fab fa-twitter fa-2x text-white ml-2"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt--5">
		<div class="page-inner mt--3">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body p-3">
							<?= htmlspecialchars_decode($profil['tentang_resto']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Gallery <?= $profil['nama_resto']; ?></h4>
					</div>
					<div class="card-body">
						<div id="owl-demo3" class="owl-carousel owl-theme owl-img-responsive">
							<?php $i = 1;
							foreach ($gallery as $g) : ?>
								<div class="item"><img class="img-fluid" src="<?= base_url('assets'); ?>/img_gallery/<?= $g['foto']; ?>" alt="Owl Image"></div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="copyright ml-auto">
					<?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.wehoot.stpre">Wehoot</a>
				</div>
			</div>
		</footer>
	</div>
</div>