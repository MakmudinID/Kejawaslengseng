<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?=$title;?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Gudang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?=$title;?></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Pembelian</h4>
                                <a href="<?=base_url('gudang/tambah_bahan')?>" class="btn btn-primary btn-round ml-auto btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Tambah Pembelian
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr align="center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Jumlah</th>
                                        <th>Total Pembelian</th>
                                        <th>Created By</th>
                                        <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                            foreach ($bahan as $rp) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $rp['tgl']; ?></td>
                                                    <td><?= $rp['judul']; ?></td>
                                                    <td align="center"><?= $rp['jumlah_bahan']; ?></td>
                                                    <td align="right">Rp.<?= number_format($rp['total_harga']); ?></td>
                                                    <td><?= $rp['nama_pj']; ?></td>
                                                    <td align="center"><a href="<?= base_url('gudang/s_detail'); ?>/<?= $rp['id']; ?>" data-toggle="tooltip" data-original-title="Detail Pembelian">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a></td>
                                                </tr>
                                            <?php $i += 1;
                                            endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

<div class="modal fade" id="tambahmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tambah</span> 
                    <span class="fw-light">
                    Kategori Menu
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Form Tambah Kategori Menu
                </p>
                <form method="post" action="<?= base_url('admin/tambah_kategori'); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama Kategori</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama kategori menu" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="<?=$dk['id'];?>" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
