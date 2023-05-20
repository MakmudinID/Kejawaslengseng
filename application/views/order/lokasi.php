<div class="main-panel">
	<div class="bg-primary2 pt-4 pb-5">
		<div class="container text-white py-2">
			<div class="d-flex align-items-center">
				<div class="mr-3">
					<h1 class="mb-3">Lokasi <?= $profil['nama_resto']; ?></h1>
					<h5 class="op-7 mb-3"><?= htmlspecialchars_decode($profil['alamat_resto']); ?></h5>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt--5">
		<div class="page-inner mt--3">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body p-3 text-center">
							<?=htmlspecialchars_decode($profil['plugin_resto']);?>
						</div>
					</div>
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