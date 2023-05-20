<div class="wrapper wrapper-login">
  <div class="container container-login animated fadeIn">
    <div class="text-center"><img src="<?= base_url('assets/img_profil/') . $profil['foto_resto']; ?>" style="width: 150px;"></div>
    <?= $this->session->flashdata('message');  ?>
    <div class="login-form">
      <form class="user" method="post" action=" <?= base_url('admin/laporan'); ?> ">
        <div class="form-group">
          <label for="password" class="placeholder text-center"><b>Privilege Akses</b></label>
          <!-- <a href="#" class="link float-right">Forget Password ?</a> -->
          <div class="position-relative input-icon">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password...">
            <span class="input-icon-addon show-password">
              <i class="icon-eye"></i>
            </span>
          </div>
        </div>
        <div class="form-group form-action-d-flex">
          <button type="submit" class="btn btn-primary btn-user btn-block">
            Masuk
          </button>
        </div>
        <div class="form-group">
            <a href="<?= base_url('admin/index')?>" class="btn btn-danger btn-user btn-block">
                Batal
            </a>
         </div>
      </form>
    </div>
  </div>
</div>
</div>