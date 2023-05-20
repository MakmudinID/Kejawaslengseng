<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Pendapatan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        hr.line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

    <style>
        .impact {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }
    </style>

    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #1269DB;
            color: white;
        }
    </style>
</head><body>
    <img src="assets/img_profil/<?= $profil['foto_resto']; ?>" class="text-center" style="position: absolute; width:100px; height:auto;">
    <table style="width:100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1; font-weight: bold;" class="impact">
                    <font size="16"><?= $profil['nama_resto']; ?></font>
                </span>
                <br><br><span class="impact"><?= htmlspecialchars_decode($profil['alamat_resto']); ?><font size="2"> HP. <?= $profil['kontak_resto']; ?></font></span>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <br>
    <h3 class="impact" align="center"> <b>Laporan Pendapatan</b></h3>
    <?php
    $dari1 = date_create($dari);
    $sampai1 = date_create($sampai);
    $r_dari = date_format($dari1, "d/m/Y");
    $r_sampai = date_format($sampai1, "d/m/Y");
    ?>
    <p class="impact" align="center"> Periode : <?= $r_dari; ?> - <?= $r_sampai ?></p>
    <table style="width:100%;" id="customers" class="mt-2">
        <tr align="center">
            <th style="width: 10%">No.</th>
            <th>Tanggal Transaksi</th>
            <th style="width: 30%">Jumlah Transaksi</th>
            <th style="width: 30%">Pendapatan</th>
        </tr>
        <?php $i = 1;
        $totalpendapatan = 0;
        $totaldiskon = 0;
        $ppn = 0;
        $service = 0;
        foreach ($lp_pendapatan as $pd) :
            $subtotal = $pd['pendapatan'];
            $pajak = $pd['ppn'];
            $service1 = $pd['service'];
            $totalpendapatan += $subtotal;
            $disc = $pd['diskon'];
            $totaldiskon += $disc;
            $ppn += $pajak;
            $service += $service1;
        ?>
            <tr>
                <td align="center"><?= $i; ?></td>
                <td align="left"><?php
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
                    <?= $pd['tgl']; ?> <?= $bulan; ?> <?= $pd['tahun']; ?></td>
                <td align="center"><?= $pd['pesanan']; ?></td>
                <td align="right">Rp <?= number_format($pd['pendapatan'], 0, ',', '.'); ?></td>
            </tr>
        <?php $i += 1;
        endforeach; ?>
        <?php if ($lp_pendapatan == null) : ?>
            <tr>
                <td colspan="4" align="center"><b>Data tidak ditemukan pada hasil filter pencarian.</b></td>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="3" align="right"><b>Total</b></td>
                <td align="right"><b>Rp. <?= number_format($totalpendapatan, 0, ',', '.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>Diskon</b></td>
                <td align="right"><b>Rp. <?= number_format($totaldiskon, 0, ',', '.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>Service</b></td>
                <td align="right"><b>Rp. <?= number_format($service1, 0, ',', '.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>Tax</b></td>
                <td align="right"><b>Rp. <?= number_format($ppn, 0, ',', '.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>Grand Total</b></td>
                <td align="right"><b>Rp. <?= number_format(($totalpendapatan - $totaldiskon)+$ppn+$service1, 0, ',', '.') ?></b></td>
            </tr>
        <?php endif; ?>
    </table>
    <br><br><br>
    <span class="impact">
        Tanggal Cetak : <?php date_default_timezone_set('Asia/Jakarta');
                        echo date('d/m/Y H:i:s'); ?>
    </span><br>
    <span class="impact">
        Oleh : <?= $saya_karyawan['nama']; ?>
    </span>
</body></html>