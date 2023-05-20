<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="#" class="logo">
           <span class="text-white fw-bold text-uppercase"><?=$profil['nama_resto'];?></span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="<?= base_url('assets/');  ?>assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                     <div class="avatar-lg"> <img src="<?= base_url('assets/');  ?>assets/img/profile.png" alt="..." class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4><?= $saya_karyawan['nama']; ?></h4>
                                        <?php 
                                            $role=$saya_karyawan['role_id'];
                                            $query="SELECT karyawan_role.role 
                                            FROM karyawan_role, karyawan 
                                            WHERE karyawan.role_id = karyawan_role.id 
                                            AND karyawan.role_id=$role";
                                            $posisi = $this->db->query($query)->row_array();
                                        ?>
                                        <p class="text-muted"><?= $posisi['role']; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <?php if($saya_karyawan['role_id']==2):?>
                                <a class="dropdown-item" data-toggle="modal" href="#logout">Logout</a>
                                <?php else:?>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                                <?php endif;?>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Konfirmasi</span> 
                    <span class="fw-light">
                    Logout
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="login-form">
        <form class="user" method="post" action="<?= base_url('auth/cek'); ?>">
            <div class="form-group">
                <label for="username" class="placeholder"><b>Username</b></label>
                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label for="password" class="placeholder"><b>Password</b></label>
                <!-- <a href="#" class="link float-right">Forget Password ?</a> -->
                <div class="position-relative input-icon">
                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password...">
                <!-- <span class="input-icon-addon show-password">
                    <i class="icon-eye"></i>
                </span> -->
                </div>
            </div>
            <div class="form-group form-action-d-flex mb-1">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                        <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </form>
			</div>
            </div>
        </div>
    </div>
</div>