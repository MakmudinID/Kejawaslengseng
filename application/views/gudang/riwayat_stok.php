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
                                <h4 class="card-title">Riwayat Perubahan Stok</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Tgl</th>
                                            <th>Menu</th>
                                            <th>Kategori</th>
                                            <th>Stok Sebelumnya</th>
                                            <th>Stok Diubah</th>
                                            <th>Penanggung Jawab</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;foreach ($historyStok as $rp) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $rp['tgl']; ?></td>
                                            <td><?= $rp['nama_menu']; ?></td>
                                            <td><?= $rp['nama_kategori']; ?></td>
                                            <td align="center"><?= number_format($rp['sebelum']); ?></td>
                                            <td align="center"><?= number_format($rp['sesudah']); ?></td>
                                            <td><?= $rp['nama']; ?></td>

                                        </tr>
                                    <?php $i += 1; endforeach; ?>
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
                        <a class="nav-link" href="http://www.themekita.com">
                            Rumah Makan
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
            </div>				
        </div>
    </footer>
</div>    
