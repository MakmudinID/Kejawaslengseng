<!-- footer -->
</div>
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

<!-- Summernote -->
<script src="<?= base_url('assets/');  ?>assets/js/plugin/summernote/summernote-bs4.min.js"></script>

<script>
    $('#tambahmenu').on('shown.bs.modal', function() 
    {
        $('#summernote').summernote({toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['para', ['ul', 'ol']]
    ],
    height:90});
    });
</script>

<?php foreach ($kategori as $dk) : ?>
<script>
    $('#<?=$dk['id'];?>').on('shown.bs.modal', function() 
    {
        $('#summernote_edit').summernote({toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['para', ['ul', 'ol']]
    ],
    height:90});
    });
</script>
<?php endforeach; ?>

<!-- Bootstrap Notify
<script src="<?= base_url('assets/');  ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

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
<script src="<?= base_url('assets/'); ?>assets/js/format_rupiah.js"></script>
<script src="<?= base_url('assets/'); ?>assets/js/format_rupiah2.js"></script>

<!-- Banner JS -->
<script src="<?= base_url('assets/'); ?>assets/js/banner.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="<?= base_url('assets/');  ?>assets/js/setting-demo.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/demo.js"></script>

<script>
    // This will create a single gallery from all elements that have class "gallery-item"
    $('.image-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        removalDelay: 300,
        gallery: {
            enabled: true,
        },
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
</script>
</body>

</html>