<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $title ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="<?= base_url('admin/index') ?>">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Admin</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= $title ?></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Laporan</h4>
                        </div>
                        <form method="post" action="<?= base_url('admin/laporan_result') ?> ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter">Filter</label>
                                        <select class="form-control form-control" id="filter" name="filter">
											<option value="1">Laporan Pendapatan</option>
											<option value="2">Laporan Pembelian Bahan </option>
											<option value="3">Riwayat Pesanan</option>
										</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dari</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="dari" value="<?=date('Y-m-d', strtotime('previous month'));?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Sampai</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="sampai" value="<?php echo date('Y-m-d');?>">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tampilkan</label>
                                        <div class="input-group">
                                            <button type="submit" class="form-control btn btn-primary">
                                                Tampilkan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Resto Kejawa
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                <?=date('Y')?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>				
        </div>
    </footer>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Konfirmasi</span> 
                    <span class="fw-light">
                    Akses Laporan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action=" <?= base_url('admin/laporan'); ?> ">
                    <div class="form-group">
                      <label for="password" class="placeholder"><b>Password</b></label>
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
<script type="text/javascript">
    $(window).on('load',function(){
        $('#konfirmasi').modal('show');
    });
</script>