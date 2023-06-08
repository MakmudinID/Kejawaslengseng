<!-- footer -->
</div>

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

    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {
            <?php if (isset($byMenu)) : ?>
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
            <?php endif; ?>
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

    $('#birth').datetimepicker({
        format: 'MM/DD/YYYY'
    });

    <?php if (isset($listPesanan)) : ?>
        <?php foreach ($listPesanan as $rp) : ?>
            $('#basic<?= $rp['id']; ?>').select2({
                theme: "bootstrap"
            });
        <?php endforeach; ?>
    <?php endif; ?>
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
</body>

</html>