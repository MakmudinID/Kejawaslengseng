    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Detail Karyawan</h1><br>

    </div>

    <!-- mulai dari sini -->
    <div class="container-fluid">
        <?= $this->session->flashdata('message');  ?>
        <!-- Page Heading -->


        <div class="row">

            <div class="col-lg-6">



                <!-- Brand Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info"><?= $detail['nama']; ?></h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('admin/detail'); ?>">
                            <div class="form-group">
                                <label for="nama" class="m-0 font-weight-bold text-primary">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $detail['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="m-0 font-weight-bold text-primary">No HP</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP" value="<?= $detail['no_hp']; ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="posisi" class="m-0 font-weight-bold text-primary">Posisi</label>
                                    <select id="posisi" name="posisi" class="form-control">
                                        <!-- <option selected>Choose...</option> -->
                                        <?php foreach ($status as $st) : ?>
                                            <?php if ($st['role'] == $detail['role']) : ?>
                                                <option value="<?= $st['role']; ?>" selected><?= $st['role']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $st['role']; ?>"><?= $st['role']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="is_active" class="m-0 font-weight-bold text-primary">Status Aktif</label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <!-- <option selected>Choose...</option> -->
                                        <?php foreach ($active as $ac) : ?>
                                            <?php if ($ac['keterangan'] == $detail['keterangan']) : ?>
                                                <option value="<?= $ac['keterangan']; ?>" selected><?= $ac['keterangan']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $ac['keterangan']; ?>"><?= $ac['keterangan']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput" class="m-0 font-weight-bold text-primary">Password Saat ini</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Password Lama" value="<?= $detail['password']; ?>" readonly>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="m-0 font-weight-bold text-primary">Password Lama</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password Lama">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password1" class="m-0 font-weight-bold text-primary">Password Baru</label>
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password Baru">
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?= base_url('admin/daftar_karyawan'); ?>" class="btn btn-google btn-block">Batal</a>

                                </div>
                                <div class="col-md-6">

                                    <button type="submit" class="btn btn-facebook btn-block">Oke</button>
                                </div>
                            </div>
                        </form>
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