$(function () {

    $('.tomboladdmenu').on('click', function () {
        $('#exampleModalLabel').html('Tambah Menu Baru');
        $('.modal-footer button[type=submit]').html('Tambah Menu');
    });

    $('.tomboladdsubmenu').on('click', function () {
        $('#exampleModalLabel').html('Tambah Sub Menu Baru');
        $('.modal-footer button[type=submit]').html('Tambah Sub Menu');
    });

    $('.tampil_modal_editsub').on('click', function () {
        $('#titel').html('Edit Sub Menu');
        $('#editket').html('Melakukan Edit Sub Menu, pastikan semua terisi dengan benar.');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-content form').attr('action', 'http://localhost/tajeer-store/menu/editsub');

        const id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/mstore/menu/geteditsub',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#submenu').val(data.submenu);
                $('#id_menu').val(data.id_menu);
                $('#url').val(data.url);
                $('#iconmenu').val(data.icon);
                $('#status').val(data.status);
                $('#id').val(data.id);
            }
        });
    });

    $('.modal_edit').on('click', function () {
        $('#titel').html('Edit Menu');
        $('#editket').html('Melakukan edit menu, pastikan semua terisi dengan benar.');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-content form').attr('action', 'http://localhost/tajeer-store/menu/edit');


        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/tajeer-store/menu/getedit',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#menu').val(data.menu);
                $('#id').val(data.id);
                $('#role').val(data.role);
            }
        });
    });
});

