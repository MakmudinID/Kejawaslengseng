<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $title; ?></h4>
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
                        <a href="#">Kasir</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= $title; ?></a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Riwayat Pembayaran: <?= date('d-m-Y'); ?> </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $j = 1;
                            $grandtotal = 0;
                            $diskon = 0;
                            $ppn_total = 0;
                            $service_total = 0;
                            foreach ($lp_riwayat as $pd) : $total = $pd['total_harga'];
                                $disc    = $pd['diskon'];
                                $tax     = $pd['ppn'];
                                $service = $pd['service'];
                                $grandtotal     += $total;
                                $diskon         += $disc;
                                $ppn_total      += $tax; 
                                $service_total  += $service;
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
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
                                        <h3 class="text-weight"><b><?= $j++; ?>) Pembelian No: K<?= $pd['id']; ?></b></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        Tanggal Pembelian : <?= $pd['tgl']; ?> <?= $bulan; ?> <?= $pd['tahun']; ?> <br>
                                        Nama Pembeli : <?= $pd['atas_nama']; ?><br>
                                        Kasir : <?= $pd['kasir']; ?>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#<?= $pd['id']; ?>"><i class="fas fa-print mr-2"></i>Cetak Struk</button>
                                        <?php if($this->session->userdata('role_id')==1):?>
                                            <button class="btn btn-danger btn-sm mt-2" onclick="delete_('<?=$pd['id'];?>', '<?=$pd['atas_nama'];?>')"><i class="fas fa-trash mr-2"></i>Delete</button>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive ">
                                            <table style="width:100%;" class="mt-2 table-bordered">
                                                <tr style="padding:10px;" align="center">
                                                    <th width="10%">No</th>
                                                    <th>Daftar Pembelian</th>
                                                    <th width="10%">Jumlah</th>
                                                    <th width="20%">Sub Total</th>
                                                </tr>
                                                <?php
                                                $idp = $pd['id'];
                                                $q = "SELECT SUM(jumlah) as totalqty, detail_pesanan.* 
                                                        FROM detail_pesanan, pesanan
                                                        WHERE pesanan.id = detail_pesanan.id_pesanan
                                                        AND id_pesanan = $idp
                                                        group by id_menu
                                                ";
                                                $detail = $this->db->query($q)->result_array(); ?>
                                                <?php $i = 1;
                                                foreach ($detail as $dt) : ?>
                                                    <tr style="padding:10px;">
                                                        <td align="center"><?= $i++; ?></td>
                                                        <td><?= $dt['nama_menu']; ?></td>
                                                        <td align="center"><?= $dt['totalqty']; ?></td>
                                                        <td align="right"><?= number_format($dt['harga'] * $dt['totalqty'], 0, ',', '.'); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr style="padding:10px;">
                                                    <td align="right" colspan="3"><b>Total (<?= $pd['jumlah_pesanan'] ?> items) </b></td>
                                                    <td align="right"><b><?= number_format($pd['total_harga'], 0, ',', '.'); ?></b></td>
                                                </tr>
                                                <tr style="padding:10px;">
                                                    <?php if ($pd['diskon'] != "0") : ?>
                                                </tr>
                                                <tr style="padding:10px;">
                                                    <td align="right" colspan="3"><b>Diskon</b></td>
                                                    <td align="right"><b><?= number_format($pd['diskon'], 0, ',', '.'); ?></b></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td align="right" colspan="3"><b>Service 5%</b></td>
                                                <td align="right"><b><?= number_format($service = $pd['service'], 0, ',', '.'); ?></b></td>
                                            </tr>
                                            
                                            <tr>
                                                <td align="right" colspan="3"><b>PPN 10%</b></td>
                                                <td align="right"><b><?= number_format($ppn = $pd['ppn'], 0, ',', '.'); ?></b></td>
                                            </tr>

                                            <tr>
                                                <td align="right" colspan="3"><b>Grand Total</b></td>
                                                <td align="right"><b><?= number_format(($pd['total_harga'] + $ppn + $service) - $pd['diskon'], 0, ',', '.'); ?></b></td>
                                            </tr>

                                            <tr style="padding:10px;">
                                            <tr>
                                                <td align="right" colspan="3"><b>Bayar (<?= $pd['metode_bayar']; ?>)</b></td>
                                                <td align="right"><b><?= number_format($pd['jumlah_bayar'], 0, ',', '.'); ?></b></td>
                                            </tr>
                                            <tr style="padding:10px;">
                                            <tr>
                                                <td align="right" colspan="3"><b>Kembalian</b></td>
                                                <td align="right"><b><?= number_format($pd['kembalian'], 0, ',', '.'); ?></b></td>
                                            </tr>
                                            <?php if ($pd['keterangan_diskon'] != null) : ?>
                                                <tr style="padding:10px;">
                                                <tr>
                                                    <td align="left" colspan="4"><b>Keterangan Diskon : <?= $pd['keterangan_diskon']; ?></b></td>
                                                </tr>
                                            <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator-solid"></div>
                            <?php endforeach; ?>
                            <?php if ($lp_riwayat == null) echo "Tidak ada riwayat pembayaran."; ?>
                            <div class="row">
                                <div class="col-md-1 text-center"></div>
                                <div class="col-md-11">
                                    <?php if ( $this->session->userdata('role_id') == 1 ) : ?>
                                    <div class="table-responsive ">
                                        <table style="width:100%;" class="mt-2">
                                            <tr align="right">
                                                <td colspan="3">
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <td width="20%">
                                                    <h4><b>Rp <?= number_format($total = $grandtotal, 0, ',', '.'); ?></b></h4>
                                                </td>
                                            </tr>
                                            <tr align="right">
                                                <td colspan="3">
                                                    <h4><b>Diskon</b></h4>
                                                </td>
                                                <td width="20%">
                                                    <h4><b>Rp <?= number_format($diskon, 0, ',', '.'); ?></b></h4>
                                                </td>
                                            </tr>
                                            <tr align="right">
                                                <td colspan="3">
                                                    <h4><b>Tax</b></h4>
                                                </td>
                                                <td width="20%">
                                                    <h4><b>Rp <?= number_format($ppn_total, 0, ',', '.'); ?></b></h4>
                                                </td>
                                            </tr>
                                            <tr align="right">
                                                <td colspan="3">
                                                    <h4><b>Grand Total</b></h4>
                                                </td>
                                                <td width="20%">
                                                    <h4><b>Rp<?= number_format(($total - $diskon ) + $ppn_total + $service_total, 0, ',', '.'); ?></b></h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php endif ?>
                                </div>
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
                            Rumah Makan
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.wehoot.store">Wehoot</a>
            </div>
        </div>
    </footer>
</div>

<!-- Modal Cetak -->
<?php $j = 1;
foreach ($lp_riwayat as $lp) : ?>
    <?php
    if ($lp['bulan'] == "1") {
        $bulan = "Januari";
    } elseif ($lp['bulan'] == "2") {
        $bulan = "Februari";
    } elseif ($lp['bulan'] == "3") {
        $bulan = "Maret";
    } elseif ($lp['bulan'] == "4") {
        $bulan = "April";
    } elseif ($lp['bulan'] == "5") {
        $bulan = "Mei";
    } elseif ($lp['bulan'] == "6") {
        $bulan = "Juni";
    } elseif ($lp['bulan'] == "7") {
        $bulan = "Juli";
    } elseif ($lp['bulan'] == "8") {
        $bulan = "Agustus";
    } elseif ($lp['bulan'] == "9") {
        $bulan = "September";
    } elseif ($lp['bulan'] == "10") {
        $bulan = "Oktober";
    } elseif ($lp['bulan'] == "11") {
        $bulan = "November";
    } elseif ($lp['bulan'] == "12") {
        $bulan = "Desember";
    }
    ?>
    <div class="modal fade" id="<?= $lp['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Struk</span>
                        <span class="fw-light">
                            Pembelian
                        </span>
                    </h5>
                    <button type="button" class="close" target="javascript:void(0);" onclick="printPageArea('content<?= $lp['id']; ?>')">
                        <span aria-hidden="true"><small>Print <i class="fas fa-print"></i></small></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="content<?= $lp['id']; ?>">
                        <div class="col-md-12">
                            <div class="card card-invoice">

                                <div class="card-header">
                                    <center>
                                        <font size="2">
                                            <p>
                                                <img src="<?= base_url('assets/img_profil/') . $profil['foto_resto']; ?>" style="width: 100px;">
                                            </p>
                                            <?= htmlspecialchars_decode($profil['alamat_resto']); ?><font size="2"> HP. <?= $profil['kontak_resto']; ?></font>
                                        </font>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <hr>
                                    <font size="2">Date : <?= $lp['tgl']; ?>-<?= $lp['bulan']; ?>-<?= $lp['tahun']; ?><br>Receipt No. : K<?= $lp['id']; ?><br>Cashier : <?= $lp['kasir']; ?></font>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice-detail">
                                                <div class="invoice-item">
                                                    <div class="table-responsive">
                                                        <table style="width:100%;">
                                                            <tbody>
                                                                <font size="2">
                                                                    <?php
                                                                        $idp = $lp['id'];
                                                                        $q = "SELECT SUM(jumlah) as totalqty, detail_pesanan.* 
                                                                            FROM detail_pesanan, pesanan
                                                                            WHERE pesanan.id = detail_pesanan.id_pesanan
                                                                            AND id_pesanan = $idp
                                                                            group by id_menu
                                                                ";
                                                                    $detail = $this->db->query($q)->result_array(); ?>
                                                                    <?php $i = 1;
                                                                    foreach ($detail as $k) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <font size="2"><?= $k['nama_menu']; ?></font>
                                                                            </td>
                                                                            <td width="10%">
                                                                                <font size="2"><?= $k['totalqty']; ?></font>
                                                                            </td>
                                                                            <?php $tot = $k['harga'] * $k['totalqty']; ?>
                                                                            <td align="right">
                                                                                <font size="2"><?= number_format($tot, 0, ',', '.'); ?></font>
                                                                            </td>
                                                                        </tr>
                                                                    <?php $i += 1;
                                                                    endforeach; ?>
                                                                </font>
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                        <table style="width:100%;">
                                                            <tbody>

                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Total (<?= $lp['jumlah_pesanan'] ?> items)</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($lp['total_harga'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <?php if ($lp['diskon'] > 0) : ?>
                                                                    <tr class="fw-bold">
                                                                        <td colspan="3" width="80%;">
                                                                            <font size="2">
                                                                                <font size="2">Diskon</font>
                                                                        </td>
                                                                        <td align="right">
                                                                            <font size="2"><?= number_format($lp['diskon'], 0, ',', '.'); ?></font>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Service 5%</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($lp['service'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">PPN 10%</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($lp['ppn'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">
                                                                            <font size="2">Grand Total</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format(($lp['total_harga'] + $lp['ppn'] + $lp['service'] ) - $lp['diskon'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">
                                                                            <font size="2">Bayar (<?= $lp['metode_bayar']; ?>)</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($lp['jumlah_bayar'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Kembalian</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($lp['kembalian'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                </font>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <center>
                                        <font size="2">
                                            <p class="text-uppercase fw-bold text-muted mb-0">
                                                Terimakasih <br>
                                                Atas Kunjungan Anda
                                            </p>
                                        </font>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    function delete_(id, nama) {
        swal({
            title: 'Yakin Dihapus?',
            text: "Transaksi "+nama+ " Akan Dihapus Permanen!",
            type: 'warning',
            buttons:{
                confirm: {
                    text : 'Hapus',
                    className : 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    text : 'Batal',
                    className: 'btn btn-danger'
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo site_url('kasir/delete_struk') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        swal({
                                title: nama,
                                text: 'Berhasil Dihapus',
                                icon: "success",
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                buttons: false,
                            }
                        );
                        setInterval(function(){ location.reload(true); }, 1000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });
    }
</script>