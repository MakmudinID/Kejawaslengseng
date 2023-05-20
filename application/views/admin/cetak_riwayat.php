<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Riwayat Pesanan</title>
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
  background-color: #4CAF50;
  color: white;
}

#total th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #ddd;
  color: black;
}
</style>
</head><body>
   <?php $j=1; foreach($lp_riwayat as $pd):?>
            <?php
                $idp=$pd['id'];
                $q = "SELECT detail_pesanan.* 
                        FROM detail_pesanan, pesanan
                        WHERE pesanan.id = detail_pesanan.id_pesanan
                        AND id_pesanan = $idp
                ";
                $detail = $this->db->query($q)->result_array();
            ?>
            <hr class="line-title">
            <table id="customers">
                        <tr align="center"> 
                            <th width="10%">No</th>
                            <th>Daftar Pembelian</th>
                            <th width="10%">Jumlah</th>
                            <th width="20%">Harga Beli</th>
                        </tr>
                        <?php $i=1; foreach($detail as $dt):?>
                        <?php if ($pd['id'] == $dt['id_pesanan']):?>
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr>
                            <td align="center"><?=$i++;?></td>
                            <td> <?=$dt['nama_menu'];?> </td>
                            <td align="center"><?=$dt['jumlah'];?></td>
                            <td align="right"><?=number_format($dt['harga']);?></td>
                        </tr>
                        <?php endif;?>
                        <?php endforeach;?>
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <tr>
                            <td align="right" colspan="3"><b>Total (Rp.)</b></td>
                            <td align="right"><b><?=number_format($pd['total_harga']);?></b></td>
                        </tr>
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <tr>
                            <td align="right" colspan="3"><b>Diskon</b></td>
                            <td align="right"><b><?=number_format($pd['diskon']);?></b></td>
                        </tr>
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <tr>
                            <td align="right" colspan="3"><b>Pendapatan</b></td>
                            <td align="right"><b><?=number_format($pd['pendapatan']);?></b></td>
                        </tr>
                    </table>
                    
            <?php endforeach;?>
<span class="impact">
    Tanggal Cetak : <?php date_default_timezone_set('Asia/Jakarta'); echo date('d/m/Y H:i:s');?>
</span><br>
<span class="impact">
    Oleh : <?= $saya_karyawan['nama'];?>
</span>
</body></html>