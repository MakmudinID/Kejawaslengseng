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
    $('#summernote').summernote({
        height: 250,
        onImageUpload: function(image) {
            uploadImage(image[0]);
        },
        onMediaDelete: function(target) {
            deleteImage(target[0].src);
        }
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('admin/upload_image') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('#summernote').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src
            },
            type: "POST",
            url: "<?php echo site_url('admin/delete_image') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>

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
<script src="<?= base_url('assets/'); ?>assets/js/variable_rupiah.js"></script>
<script src="<?= base_url('assets/'); ?>assets/js/format_rupiah.js"></script>


<!-- Banner JS -->
<script src="<?= base_url('assets/'); ?>assets/js/banner.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="<?= base_url('assets/');  ?>assets/js/setting-demo.js"></script>
<script src="<?= base_url('assets/');  ?>assets/js/demo.js"></script>

<script>
    var timeout = 3000; // in miliseconds (3*1000)
    $('.tutup').delay(timeout).fadeOut(300);

    $('#keterangan').summernote({
        height: 250,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']]
        ]
    });
    $('#alamat').summernote({
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']]
        ]
    });
</script>

<script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: <?= $jumlah_user; ?>,
        maxValue: 100,
        width: 7,
        text: <?= $jumlah_user; ?>,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: <?= $jumlah_kategori; ?>,
        maxValue: 100,
        width: 7,
        text: <?= $jumlah_kategori; ?>,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: <?= $jumlah_menu; ?>,
        maxValue: 100,
        width: 7,
        text: <?= $jumlah_menu; ?>,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: [<?php
                        if (count($penghasilan) > 0) {
                            foreach ($penghasilan as $data) {
                                // $hasil = $data['hari'];
                                if ($data['hari'] == "Sun") {
                                    echo "\"Minggu\",";
                                } else if ($data['hari'] == "Mon") {
                                    echo "\"Senin\",";
                                } else if ($data['hari'] == "Tue") {
                                    echo "\"Selasa\",";
                                } else if ($data['hari'] == "Wed") {
                                    echo "\"Rabu\",";
                                } else if ($data['hari'] == "Thu") {
                                    echo "\"Kamis\",";
                                } else if ($data['hari'] == "Fri") {
                                    echo "\"Jum'at\",";
                                } else if ($data['hari'] == "Sat") {
                                    echo "\"Sabtu\",";
                                }
                            }
                        }
                        ?>],
            datasets: [{
                label: "Total Pendapatan",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [<?php
                        if (count($penghasilan) > 0) {
                            foreach ($penghasilan as $data) {
                                echo $data['pendapatan'] - $data['diskon'] . ", ";
                            }
                        }
                        ?>],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>
<script>
    $('#birth').datetimepicker({
        format: 'MM/DD/YYYY'
    });

    <?php foreach ($listPesanan as $rp) : ?>
        $('#basic<?= $rp['id']; ?>').select2({
            theme: "bootstrap"
        });
    <?php endforeach; ?>
    /* validate */

    // validation when select change
    $("#state").change(function() {
        $(this).valid();
    })

    // validation when inputfile change
    $("#uploadImg").on("change", function() {
        $(this).parent('form').validate();
    })

    $("#exampleValidation").validate({
        validClass: "success",
        rules: {
            gender: {
                required: true
            },
            confirmpassword: {
                equalTo: "#password"
            },
            birth: {
                date: true
            },
            uploadImg: {
                required: true,
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
    });
</script>
<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id_prov = $('#provinsi').val();
            if (id_prov != '') {
                $.ajax({
                    url: "<?= base_url() . 'alamat/fetch_kabupaten'; ?>",
                    method: "POST",
                    data: {
                        id_prov: id_prov
                    },
                    success: function(data) {
                        $('#kabupaten').html(data);

                    }
                })
            } else {
                $('#kabupaten').html('<option value="">Pilih Kota/Kabupaten</option>');
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
            }
        });
        $('#kabupaten').change(function() {
            var id_kab = $('#kabupaten').val();
            if (id_kab != '') {
                $.ajax({
                    url: "<?= base_url() . 'alamat/fetch_kecamatan'; ?>",
                    method: "POST",
                    data: {
                        id_kab: id_kab
                    },
                    success: function(data) {
                        $('#kecamatan').html(data);

                    }
                })
            } else {
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
            }
        });
        $('#kecamatan').change(function() {
            var id_kec = $('#kecamatan').val();
            if (id_kec != '') {
                $.ajax({
                    url: "<?= base_url() . 'alamat/fetch_kelurahan'; ?>",
                    method: "POST",
                    data: {
                        id_kec: id_kec
                    },
                    success: function(data) {
                        $('#kelurahan').html(data);
                    }
                })
            }
        });

    });
</script>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.add_cart').click(function() {
            var menu_id = $(this).data("menuid");
            var menu_nama = $(this).data("menunama");
            var menu_harga = $(this).data("menuharga");
            var menu_foto = $(this).data("menufoto");
            var quantity = $('#' + menu_id).val();
            $.ajax({
                url: "<?php echo base_url(); ?>order/add_to_cart",
                method: "POST",
                data: {
                    menu_id: menu_id,
                    menu_nama: menu_nama,
                    menu_harga: menu_harga,
                    menu_foto: menu_foto,
                    quantity: quantity
                },
                success: function(data) {
                    $('#detail_pesanan').html(data);
                }
            });
        });

        // Load shopping cart
        $('#detail_pesanan').load("<?php echo base_url(); ?>order/load_cart");

        //Hapus Item Cart
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
            $.ajax({
                url: "<?php echo base_url(); ?>order/plus_cart",
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