<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-header">
                        <h4 class="page-title"><a href="<?= base_url('kasir/index') ?>" style="text-decoration: none;">Pembayaran</a></h4>
                        <ul class="breadcrumbs">
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Detail</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#"><?= $title; ?> <?= $Pesanan['atas_nama']; ?></a>
                            </li>

                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Pesanan No: <B>K<?= $Pesanan['id']; ?> / <?= $Pesanan['atas_nama']; ?></B></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message');  ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th scope="col" width="10%">Line</th>
                                            <th scope="col">Nama Menu</th>
                                            <th scope="col" width="10%">Qty</th>
                                            <th scope="col" width="23%">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $ttl = 0;
                                        foreach ($listPesanan as $k) : ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $k['nama_menu']; ?></td>
                                                <td align="center"><?= $k['totalqty']; ?></td>
                                                <?php $tot = $k['harga'] * $k['totalqty'];
                                                $ttl += $tot; ?>
                                                <td align="right"><?= number_format($tot, 2, ',', '.'); ?></td>
                                            </tr>
                                        <?php $i += 1;
                                        endforeach; ?>
                                        <tr>
                                            <td colspan="3" align="right"><b>Total (<?= $i - 1; ?> items)</b></td>
                                            <td align="right"><b><?= number_format($ttl, 2, ',', '.'); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <?php if ($Pesanan['id_status'] != '3') : ?>
                                        Pembayaran
                                </div>
                            <?php else : ?>
                                Struk Pembayaran
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="printPageArea('content')"><i class="fas fa-print"></i> Print</a>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($Pesanan['id_status'] != '3') : ?>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                            <form name="pembayaran" method="post" action="<?= base_url('kasir/konfirmasi/' . $Pesanan['id']); ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                                <div class="accordion accordion-black">
                                                    <div class="card">
                                                        <div class="card-header collapsed" id="heading<?= $Pesanan['id']; ?>" data-toggle="collapse" data-target="#collapse<?= $Pesanan['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $Pesanan['id']; ?>" role="button">
                                                            <div class="span-title fw-bold">
                                                                PPN - Service - Diskon
                                                            </div>
                                                            <div class="span-mode"></div>
                                                        </div>
                                                        <div id="collapse<?= $Pesanan['id']; ?>" class="collapse" aria-labelledby="collapse" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <div class="form-group form-group-default">
                                                                    <label>PPN 10%</label>
                                                                    <input type="text" name="ppn" id="ppn" value="<?= 'Rp ' . number_format($ttl * 10 / 100, 2, ',', '.'); ?>" class="input form-control mt-1 mb-1" style="text-align:right; font-weight:bold; font-size:24px;" readonly>
                                                                </div>
                                                                <div class="form-group form-group-default">
                                                                    <label>Service 5%</label>
                                                                    <input type="text" name="service" id="service" value="<?= 'Rp ' . number_format($ttl * 5 / 100, 2, ',', '.'); ?>" class="input form-control mt-1 mb-1" style="text-align:right; font-weight:bold; font-size:24px;" readonly>
                                                                </div>
                                                                <div class="form-group form-group-default">
                                                                    <label>Potongan Diskon (Rp)</label>
                                                                    <input name="diskon" id="diskon" type="text" value="0" style="text-align:right; font-weight:bold; font-size:24px;;" class="input form-control" required>
                                                                </div>
                                                                <div class="form-group form-group-default">
                                                                    <label>Keterangan Diskon</label>
                                                                    <input name="keterangan" type="text" class="form-control" placeholder="Masukkan keterangan diskon..">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" id="total" name="total" class="input form-control" value="<?= $ttl; ?>">
                                        <div class="form-group form-group-default">
                                            <label>Grand Total</label>
                                            <input type="text" name="grandtotal" id="grandtotal" value="<?= 'Rp ' . number_format($ttl + (($ttl * 10 / 100)+($ttl * 5 / 100)), 2, ',', '.'); ?>" class="input form-control mt-1 mb-1" style="text-align:right; font-weight:bold; font-size:24px;" readonly>
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Jumlah Bayar</label>
                                            <input name="jumlahbayar" id="jumlahbayar" type="text" class="input form-control" style="text-align:right; font-weight:bold; font-size:24px;" required autofocus autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Kembalian</label>
                                            <input type="text" name="kembalian" id="kembalian" value="" class="input form-control mt-1 mb-1" style="text-align:right; font-weight:bold; font-size:24px;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Metode Bayar</label>
                                            <select id="is_active" name="metode" class="form-control" required>
                                                <?php foreach ($metode as $st) : ?>
                                                    <option value="<?= $st['metode']; ?>"><?= $st['metode']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn mt-2 mb-1 btn-success btn-sm text-center fw-bold" style="height:50px; width:100%;">
                                            <center>
                                                <font size="3">Bayar</font>
                                            </center>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php else : ?>
                            <div id="content">
                                <div class="card-header">
                                    <center>
                                        <font size="2">
                                            <p>
                                                <img src="<?= base_url('assets'); ?>/img_profil/<?= $profil['foto_resto']; ?>" style="width: 100px;">
                                            </p>
                                            <?= htmlspecialchars_decode($profil['alamat_resto']); ?>HP.<?= $profil['kontak_resto']; ?><br />
                                        </font>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <hr>
                                    <font size="2">Date : <?= $Pesanan['tanggal']; ?><br>Receipt No. : K<?= $Pesanan['id']; ?><br>Cashier : <?= $saya_karyawan['nama']; ?></font>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice-detail">
                                                <div class="invoice-item">
                                                    <div class="table-responsive">
                                                        <table style="width:100%;">
                                                            <tbody>
                                                                <font size="2">
                                                                    <?php $i = 1;
                                                                    $ttl = 0;
                                                                    foreach ($listPesanan as $k) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <font size="2"><?= $k['nama_menu']; ?></font>
                                                                            </td>
                                                                            <td width="10%">
                                                                                <font size="2"><?= $k['jumlah']; ?></font>
                                                                            </td>
                                                                            <?php $tot = $k['harga'] * $k['jumlah'];
                                                                            $ttl += $tot; ?>
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
                                                                        <font size="2">Total (<?= $Pesanan['jumlah_pesanan'] ?> items) </font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($Pesanan['total_harga'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Service 5%</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($Pesanan['service'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <?php if ($Pesanan['diskon'] > 0) : ?>
                                                                    <tr class="fw-bold">
                                                                        <td colspan="3" width="80%;">
                                                                            <font size="2">
                                                                                <font size="2">Diskon</font>
                                                                        </td>
                                                                        <td align="right">
                                                                            <font size="2"><?= number_format($Pesanan['diskon'], 0, ',', '.'); ?></font>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">PPN 10%</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($Pesanan['ppn'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Grand Total</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format(($Pesanan['total_harga'] - $Pesanan['diskon']) + $Pesanan['ppn'] + $Pesanan['service'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">
                                                                            <font size="2">Bayar (<?= $Pesanan['metode_bayar']; ?>)</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($Pesanan['jumlah_bayar'], 0, ',', '.'); ?></font>
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold">
                                                                    <td colspan="3" width="80%;">
                                                                        <font size="2">Kembalian</font>
                                                                    </td>
                                                                    <td align="right">
                                                                        <font size="2"><?= number_format($Pesanan['kembalian'], 0, ',', '.'); ?></font>
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
                        <?php endif; ?>
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
            <?= date('Y') ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
        </div>
    </div>
</footer>
</div>
<script type="text/javascript">
    $(".input").on('input', function() {
        var total = document.getElementById('total').value;
        total = parseInt(total);

        var diskon = document.getElementById('diskon').value;
        diskon = parseInt(diskon.replace(/,.*|[^0-9]/g, ''), 10);

        var service = document.getElementById('service').value;
        service = (total - diskon) * 5 / 100;
        service = parseInt(service);
        //250

        var ppn = document.getElementById('ppn').value;
        ppn = ((total - diskon) + service) * 10 / 100;
        ppn = parseInt(ppn);
        //525

        var grandtotal = document.getElementById('grandtotal').value;
        grandtotal = parseInt(grandtotal.replace(/,.*|[^0-9]/g, ''), 10);

        var jumlahbayar = document.getElementById('jumlahbayar').value;
        jumlahbayar = parseInt(jumlahbayar.replace(/,.*|[^0-9]/g, ''), 10);

    
        document.getElementById('service').value = service.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR'
        });

        document.getElementById('ppn').value = ppn.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR'
        });

        var v_grandtotal = (total - diskon) + ppn + service;
        document.getElementById('grandtotal').value = v_grandtotal.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR'
        });

        var v_kembalian = jumlahbayar - v_grandtotal;
        document.getElementById('kembalian').value = v_kembalian.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR'
        });
        
    })
</script>