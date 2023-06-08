<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url('assets/');  ?>assets/img/icon.ico" type="image/x-icon" />
    <?php if ($title == "Daftar Pesanan") : ?>
        <meta http-equiv="refresh" content="10" />
    <?php elseif ($title == "Pembayaran") : ?>
        <meta http-equiv="refresh" content="10" />
    <?php endif; ?>
    <!-- Fonts and icons -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url('assets/');  ?>assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <script>
        function printPageArea(areaID) {
            var printContent = document.getElementById(areaID);
            var WinPrint = window.open('', '', 'width=550,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
            document.location.href = "<?= base_url('kasir'); ?>";
        }
    </script>


    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/');  ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/');  ?>assets/css/atlantis.css">
    <link rel="stylesheet" href="<?= base_url('assets/');  ?>assets/css/jquery-ui.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url('assets/');  ?>assets/css/demo.css">

    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/');  ?>assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery-3.3.1.js ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Moment JS -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/tabel.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/select.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/select2.js"></script>

    <!-- chart -->
    <script src="<?= base_url('assets/');  ?>js/chartjs.js"></script>

    <!-- Summernote -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/summernote/summernote-bs4.min.js"></script>

    <!-- Bootstrap Toggle -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Dropzone -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/dropzone/dropzone.min.js"></script>

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

    <!-- Select2 -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="<?= base_url('assets/'); ?>assets/js/form_validation.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/alert.js"></script>

    <!-- Owl Carousel -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

    <!-- Magnific Popup -->
    <script src="<?= base_url('assets/');  ?>assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Atlantis JS -->
    <script src="<?= base_url('assets/');  ?>assets/js/atlantis.min.js"></script>

    <!-- Menu JS -->
    <script src="<?= base_url('assets/'); ?>assets/js/menu.js"></script>

    <!-- Format Rupiah JS -->
    <script src="<?= base_url('assets/'); ?>assets/js/variable_rupiah.js"></script>
    <script src="<?= base_url('assets/'); ?>assets/js/format_rupiah.js"></script>


    <!-- Banner JS -->
    <script src="<?= base_url('assets/'); ?>assets/js/banner.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="<?= base_url('assets/');  ?>assets/js/setting-demo.js"></script>
    <script src="<?= base_url('assets/');  ?>assets/js/demo.js"></script>


</head>

<body>
    <div class="wrapper sidebar_minimize">