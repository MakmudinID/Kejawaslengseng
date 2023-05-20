<div class="wrapper wrapper-login">
  <div class="container container-login animated fadeIn">
    <div class="text-center"><img src="<?= base_url('assets/img_profil/') . $profil['foto_resto']; ?>" style="width: 150px;"></div>
    <div class="login-form">
      <form class="user" method="post" action=" <?= base_url('auth'); ?> ">
        <div class="form-group">
          <label for="username" class="placeholder"><b>Username</b></label>
          <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan username">
        </div>
        <div class="form-group">
          <label for="password" class="placeholder"><b>Password</b></label>
          <!-- <a href="#" class="link float-right">Forget Password ?</a> -->
          <div class="position-relative input-icon">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password...">
            <span class="input-icon-addon show-password">
              <i class="icon-eye"></i>
            </span>
          </div>
        </div>
        <div class="form-group form-action-d-flex mb-1">
          <button type="submit" class="btn btn-primary btn-user btn-block">
            Masuk
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>