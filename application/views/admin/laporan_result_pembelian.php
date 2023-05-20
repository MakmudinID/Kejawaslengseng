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
                        <a href="<?=base_url('admin/laporan')?>"><?= $title ?></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?php if($this->session->userdata('filter') == 1){ 
                                        echo "Laporan Pendapatan";
                                    }
                                    elseif ($this->session->userdata('filter') == 2){
                                        echo "Laporan Pembelian Bahan";
                                    }
                                    elseif ($this->session->userdata('filter') == 3){ 
                                        echo "Riwayat Pesanan";
                                    }
                                    ?>
                        </a>
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
    										<option value="1" <?php if($this->session->userdata('filter') == 1) echo "selected"?>>Laporan Pendapatan</option>
    										<option value="2" <?php if($this->session->userdata('filter') == 2) echo "selected"?>>Laporan Pembelian Bahan </option>
    										<option value="3" <?php if($this->session->userdata('filter') == 3) echo "selected"?>>Riwayat Pesanan</option>
    									</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dari</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control"  name="dari" value="<?=$this->session->userdata('dari')?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Sampai</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="sampai" value="<?=$this->session->userdata('sampai')?>">
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

            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                         <div class="card-header">
                            <div class="card-head-row">
                                <?php 
                                $dari=date_create($this->session->userdata('dari'));
                                $sampai=date_create($this->session->userdata('sampai'));
                                $r_dari=date_format($dari,"d/m/Y");
                                $r_sampai=date_format($sampai,"d/m/Y");
                                ?>
                                <div class="card-title">Pembelian Bahan : <?=$r_dari;?> - <?=$r_sampai;?> </div>
         <!--                       <div class="card-tools">-->
									<!--<form method="post" action="<?= base_url('admin/cetak_pembelian') ?>" target="_blank">-->
									<!-- <input type="hidden" value="<?=$this->session->userdata('dari')?>" name="dari">-->
									<!-- <input type="hidden" value="<?=$this->session->userdata('sampai')?>" name="sampai">-->
									<!--<button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-print mr-2"></i>Cetak</button>-->
									<!--</form>-->
         <!--                       </div>-->
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $j=1; foreach($lp_pembelian as $pd):?>
                            <div class="row">
                                <div class="col-md-1 text-center">
                                    <h3><b><?=$j++;?>)</b></h3>
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                        if ($pd['bulan'] == "1") {
                                            $bulan = "Januari";
                                        } elseif ($pd['bulan'] == "2") {
                                            $bulan = "Februari";
                                        } elseif ($pd['bulan'] == "3") {
                                            $bulan = "Maret";
                                        } elseif ($pd['bulan'] == "4") {
                                            $bulan = "April";
                                        } elseif ($pd['bulan'] == "5") {
                                            $bulan = "Mei";
                                        } elseif ($pd['bulan'] == "6") {
                                            $bulan = "Juni";
                                        } elseif ($pd['bulan'] == "7") {
                                            $bulan = "Juli";
                                        } elseif ($pd['bulan'] == "8") {
                                            $bulan = "Agustus";
                                        } elseif ($pd['bulan'] == "9") {
                                            $bulan = "September";
                                        } elseif ($pd['bulan'] == "10") {
                                            $bulan = "Oktober";
                                        } elseif ($pd['bulan'] == "11") {
                                            $bulan = "November";
                                        } elseif ($pd['bulan'] == "12") {
                                            $bulan = "Desember";
                                        }
                                    ?>
                                    <h3 class="text-weight"><b>Judul : <?=$pd['judul'];?></b></h3>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-1 text-center"></div>
                                    <div class="col-md-3">
                                        Tanggal Pembelian : <?=$pd['tgl'];?> <?=$bulan;?> <?=$pd['tahun'];?> <br>
                                        Diinput Oleh : <?=$pd['nama_pj'];?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 text-center"></div>
                                    <div class="col-md-11">                                     
                                        <div class="table-responsive ">
                                        <style>
                                        table, td, th {  
                                          border: 1px solid #ddd;
                                        }
                                        
                                        table {
                                          border-collapse: collapse;
                                          width: 100%;
                                        }
                                        
                                        th, td {
                                          padding: 10px;
                                        }
                                        </style>
						                <table style="width:100%;" class="mt-2">
                                                <tr align="center"> 
                                                    <th width="10%">No</th>
                                                    <th>Daftar Pembelian</th>
                                                    <th width="10%">Jumlah</th>
                                                    <th width="20%">Harga Beli</th>
                                                </tr>
                                                <?php
                                                $idp=$pd['id'];
                                                $q = "SELECT detail_bahan.* 
                                                        FROM detail_bahan, bahan
                                                        WHERE bahan.id = detail_bahan.id_bahan
                                                        AND id_bahan = $idp
                                                ";
                                                $detail = $this->db->query($q)->result_array();?>
                                                <?php $i=1; foreach($detail as $dt):?>
                                                <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr>
                                                    <td align="center"><?=$i++;?></td>
                                                    <td><?=$dt['nama_bahan'];?></td>
                                                    <td align="center"><?=$dt['jumlah'];?></td>
                                                    <td align="right"><?=number_format($dt['harga']);?></td>
                                                </tr>
                                                <?php endforeach;?>
                                                <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <tr>
                                                    <td align="right" colspan="3"><b>Total Pembelian (Rp.)</b></td>
                                                    <td align="right"><b><?=number_format($pd['total_harga']);?></b></td>
                                                </tr>
                                                <?php if($pd['Catatan'] != null):?>
                                                <tr>
                                                    <td colspan="4"> Catatan : <?=$pd['Catatan'];?> </td>
                                                </tr>
                                                <?php endif;?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="separator-solid"></div>
                        <?php endforeach;?>
                        <?php if ($lp_pembelian==null) echo "Data tidak ditemukan pada hasil filter pencarian.";?>
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


