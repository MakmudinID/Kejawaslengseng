<div class="main-header no-box-shadow" data-background-color="blue2">
	<div class="nav-top">
		<div class="container d-flex flex-row">
			<button class="navbar-toggler sidenav-toggler2 ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<i class="icon-menu"></i>
				</span>
			</button>
			<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			<!-- Logo Header -->
			<a href="<?=base_url('order/online');?>" class="logo d-flex align-items-center">
				<img src="<?= base_url('assets'); ?>/kejawa-logo.png" alt="navbar brand" style="height:80px;" class="navbar-brand">
			</a>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header-left navbar-expand-lg p-0">
				<ul class="navbar-nav page-navigation pl-md-3">
					<h3 class="title-menu d-flex d-lg-none"> 
						Resto Kejawa
						<div class="close-menu"> <i class="flaticon-cross"></i></div>
					</h3>
					<li class="nav-item <?php if($title == 'Menu'):?> active <?php endif;?>">
						<a class="nav-link" href="<?=base_url('order/menu');?>"  role="button" aria-haspopup="true" aria-expanded="false">
							Menu
						</a>
					</li>
					<li class="nav-item <?php if($title == 'Lokasi Resto Kejawa'):?> active <?php endif;?>">
						<a class="nav-link" href="<?=base_url('order/lokasi');?>"  role="button" aria-haspopup="true" aria-expanded="false">
							Lokasi Resto
						</a>
					</li>
					<li class="nav-item <?php if($title == 'Tentang Resto Kejawa'):?> active <?php endif;?>">
						<a class="nav-link" href="<?=base_url('order/about');?>"  role="button" aria-haspopup="true" aria-expanded="false">
							Tentang Kami
						</a>
					</li>
				</ul>
			</nav>
			<nav class="navbar navbar-header navbar-expand-lg p-0">
				<div class="container-fluid p-0">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item">
							<a href="#" class="nav-link quick-sidebar-toggler">
								<i class="fas fa-exchange-alt"></i> Lacak Pesanan
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
	</div>
</div>