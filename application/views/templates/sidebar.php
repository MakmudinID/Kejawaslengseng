        <!-- Sidebar -->
        <?php
        //Join
        $role_id = $this->session->userdata('role_id');
        $query_menu = "SELECT karyawan_menu.*
                        FROM karyawan_menu JOIN `karyawan_access_menu`
                        ON `karyawan_menu`.`id` = `karyawan_access_menu`.`menu_id`
                        WHERE `karyawan_access_menu`.`role_id`= $role_id
                    ";
        //nagambil semua yg ada di db
        $menu = $this->db->query($query_menu)->result_array();
        ?>
        <div class="sidebar">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="<?= base_url('assets/');  ?>assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <span class="user-level"><?= $saya_karyawan['nama']; ?>
                                        <?php 
                                            $role=$saya_karyawan['role_id'];
                                            $query="SELECT karyawan_role.role 
                                            FROM karyawan_role, karyawan 
                                            WHERE karyawan.role_id = karyawan_role.id 
                                            AND karyawan.role_id=$role";
                                            $posisi = $this->db->query($query)->row_array();
                                        ?>
                                    </span>
                                        <?=$posisi['role'];?>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <!-- Looping Menu -->
                        <?php
                        foreach ($menu as $m) : ?>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section"> <?= $m["menu"]; ?></h4>
                            </li>
                            <!-- Siapkan Sub Menu sesuai menu -->
                            <?php
                                $m_id = $m['id'];
                                $query_sub_menu = "SELECT *
                                FROM `karyawan_sub_menu` JOIN `karyawan_menu`
                                ON `karyawan_sub_menu`.`menu_id` = `karyawan_menu`.`id`
                                WHERE `karyawan_sub_menu`.`menu_id` = $m_id
                                AND `karyawan_sub_menu`.`is_active`= 1
                                ";
                                $sub_menu = $this->db->query($query_sub_menu)->result_array();
                            ?>
                            <?php foreach ($sub_menu as $sub) : ?>
                                        <?php if ($title == $sub['title'] ):?>
                                            <li class="nav-item active">
                                        <?php else : ?>
                                            <li class="nav-item">
                                        <?php endif; ?>
                                                <a href="<?= base_url($sub['url']); ?>">
                                                            <i class="<?= $sub['icon']; ?>"></i>
                                                            <p><?= $sub['title']; ?></p>
                                                </a>
                                            </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->