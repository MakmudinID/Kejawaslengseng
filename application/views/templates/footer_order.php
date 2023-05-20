<div class="quick-sidebar">
	<a href="#" class="close-quick-sidebar">
		<i class="flaticon-cross"></i>
	</a>
	<div class="quick-sidebar-wrapper">
		<div class="tab-content mt-3">
			<div class="tab-chat tab-pane fade show active" id="messages" role="tabpanel">
				<div class="messages-contact">
					<div class="quick-wrapper">
						<div class="quick-scroll scrollbar-outer">
							<div class="quick-content contact-content">
								<span class="category-title mt-0">Masukkan Kode Lacak Pesanan</span>
								<div class="avatar-group">
									<input type="text" class="form-control" placeholder="Masukkan kode lacak">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<!--   Core JS Files   -->
<script src="<?= base_url('assets/');  ?>assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Atlantis JS -->
<script src="<?= base_url('assets/');  ?>assets/js/atlantis2.min.js"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="<?= base_url('assets/');  ?>assets/js/setting-demo.js"></script>


<!-- Moment JS -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/moment/moment.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/gmaps/gmaps.js"></script>


<!-- Fullcalendar -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

<!-- DateTimePicker -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Bootstrap Tagsinput -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<!-- Summernote -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/summernote/summernote-bs4.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<!-- Owl Carousel -->
<script src="<?= base_url('assets/');  ?>/assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

<script>
	$('#timepicker').datetimepicker({
		format: 'h:mm A',
	});
</script>
<script>
	$(document).ready(function() {
		$("#form-input").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
		$("#form-sekarang").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
		$(".detail").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
			if ($("input[name='status']:checked").val() == "lebihawal") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
				$("#form-input").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
			} else {
				$("#form-input").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
			}

			if ($("input[name='status']:checked").val() == "sekarang") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
				$("#form-sekarang").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
			} else {
				$("#form-sekarang").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
			}
		});
	});
</script>

<script type="text/javascript">
	var timeout = 3000; // in miliseconds (3*1000)
	$('.tutup').delay(timeout).fadeOut(300);
	$(document).ready(function() {
		$('.add_cart').click(function() {
			var menu_id = $(this).data("menuid");
			var menu_nama = $(this).data("menunama");
			var menu_harga = $(this).data("menuharga");
			var menu_foto = $(this).data("menufoto");
			var stok = $(this).data("stok");
			var quantity = $('#' + menu_id).val();
			$.ajax({
				url: "<?php echo base_url(); ?>order/add_to_cart",
				method: "POST",
				data: {
					menu_id: menu_id,
					menu_nama: menu_nama,
					menu_harga: menu_harga,
					menu_foto: menu_foto,
					stok: stok,
					quantity: quantity
				},
				success: function(data) {
					$('#detail_pesanan').html(data);
				}
			});
		});

		$('#owl-demo3').owlCarousel({
			center: true,
			items: 2,
			loop: true,
			margin: 10,
			responsive: {
				600: {
					items: 4
				}
			}
		});
		// Load shopping cart
		$('#detail_pesanan').load("<?php echo base_url(); ?>order/load_cart");

		//Konfirmasi
		$(document).on('click', '.konfirmasi', function() {
			// Load shopping cart
			$('#tablecart').load("<?php echo base_url(); ?>order/load_tablecart");
		});

		//tampil_di_dapur
		$(document).on('click', '.proses_pesanan', function() {
			$('#daftar_pesanan').load("<?php echo base_url(); ?>order/load_pesanan");
		});

		//Hapus
		$(document).on('click', '.hapus_cart', function() {
			var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
			$.ajax({
				url: "<?php echo base_url(); ?>order/hapus_cart",
				method: "POST",
				data: {
					row_id: row_id
				},
				success: function(data) {
					$('#detail_pesanan').html(data);
				}
			});
		});

		//Minus Item Cart
		$(document).on('click', '.min_cart', function() {
			var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
			var qty_now = $(this).data("qtynow");
			$.ajax({
				url: "<?php echo base_url(); ?>order/min_cart",
				method: "POST",
				data: {
					row_id: row_id,
					qty_now: qty_now
				},
				success: function(data) {
					$('#detail_pesanan').html(data);
				}
			});
		});

		//Plus Item Cart
		$(document).on('click', '.plus_cart', function() {
			var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
			var qty_now = $(this).data("qtynow");
			var stok = $(this).data("stok");
			$.ajax({
				url: "<?php echo base_url(); ?>order/plus_cart",
				method: "POST",
				data: {
					row_id: row_id,
					stok: stok,
					qty_now: qty_now
				},
				success: function(data) {
					$('#detail_pesanan').html(data);
				}
			});
		});


	});
</script>
<script>
	//== Class definition
	var SweetAlert2Demo = function() {
		//== Demos
		var initDemos = function() {
			<?php foreach ($byMenu as $i) : ?>
				$('#alert<?= $i['id']; ?>').click(function(e) {
					swal({
						title: '<?= $i['nama_menu']; ?>',
						text: 'Berhasil Dipilih',
						icon: "success",
						timer: 1000,
						showCancelButton: false,
						showConfirmButton: false,
						buttons: false,
					});
				});
			<?php endforeach; ?>
		};
		return {
			//== Init
			init: function() {
				initDemos();
			},
		};
	}();
	//== Class Initialization
	jQuery(document).ready(function() {
		SweetAlert2Demo.init();
	});
</script>
</body>

</html>