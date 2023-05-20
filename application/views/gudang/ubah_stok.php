    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Mengubah Kategori</h1><br>

    </div>

    <!-- mulai dari sini -->
    <div class="container-fluid">
        <?= $this->session->flashdata('message');  ?>
        <!-- Page Heading -->


        <div class="row">





            <!-- Brand Buttons -->
            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="card mb-3" style="width: 86;">
                        <img style="width: 220px" ; height="100px" src="<?= base_url('assets'); ?>/img_menu/<?= $i['foto']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $i['nama_menu']; ?></b></h5>
                            <p class="card-text"><?= $i['deskripsi']; ?></p>
                            <p>Rp. <?= $i['harga']; ?></p>
                            <table class="table table-boorderless">
                                <form method="post" action="<?= base_url('gudang/ubah_stok'); ?>">
                                    <th><input type="hidden" name="id_b" id="id_b" value="<?= $i['id']; ?>"></th>
                                    <tr><input class="form-control" type="number" value="<?= $i['stok']; ?>" readonly></tr>

                                    <tr><input class="form-control mt-3" type="number" placeholder="Stok baru" min="0" name="stok" id="stok" required></tr>
                                    <th><button type="submit" class="btn btn-primary">Ubah</button></th>

                                </form>
                            </table>
                        </div>
                    </div>

                </div>
            </div>





        </div>

    </div>

    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->