<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Pembelian Bahan</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        hr.line-title{
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

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #1269DB;
  color: white;
}
</style>
</head><body>
    <table style="width:100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1; font-weight: bold;" class="impact">
                <h2>Resto Kejawa</h2></span>
                 <span class="impact">Yogyakarta, Indonesia. Telp. xxx-xxx</span>
                
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <br>
    <h3 class="impact" align="center"> <b>Laporan Pembelian Bahan</b></h3>
    <?php 
    $dari1=date_create($dari);
    $sampai1=date_create($sampai);
    $r_dari=date_format($dari1,"d/m/Y");
    $r_sampai=date_format($sampai1,"d/m/Y");
    ?>
    <p class="impact" align="center"> Periode : <?=$r_dari;?> - <?=$r_sampai?></p>
    <?php $j=1; foreach($lp_pembelian as $pd):?>
                <h3><b><?=$j++;?>)</b></h3>
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
                <h3 class="impact"><b>Judul : <?=$pd['judul'];?></b></h3>
                    Tanggal Pembelian : <?=$pd['tgl'];?> <?=$bulan;?> <?=$pd['tahun'];?> <br>
                    Diinput Oleh : <?=$pd['nama_pj'];?>
	                <table style="width:100%;" id="customers" class="mt-2">
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
    <?php endforeach;?>
    <?php if ($lp_pembelian==null) echo "Data tidak ditemukan pada hasil filter pencarian.";?>
</table>
<br><br><br>
<span class="impact">
    Tanggal Cetak : <?php date_default_timezone_set('Asia/Jakarta'); echo date('d/m/Y H:i:s');?>
</span><br>
<span class="impact">
    Oleh : <?= $saya_karyawan['nama'];?>
</span>
</body></html>