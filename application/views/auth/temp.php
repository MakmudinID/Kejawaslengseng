<form class="user" method="post" action=" <?= base_url('auth/temp'); ?> ">



    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="username" placeholder="username" name="username">
        <?= form_error('username', '<small class="text-danger pl-3">', '</small>');  ?>
        <!-- value=" <?= set_value('username'); ?> " -->
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">


            </ul>
        </div>

    </div>


    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
        Register Account
    </button>

</form>