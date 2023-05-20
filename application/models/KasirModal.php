<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KasirModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getkasirNow()
    {
        $q = "SELECT pesanan.*, `status`.`simbol`,`status`.`keterangan`,`status`.`class`
         FROM pesanan, `status`
         WHERE pesanan.id_status =2
        AND pesanan.id_status = `status`.`id`   
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }
    
    public function delete_struk($id)
    {
        $this->db->where('id', $this->db->escape_str($id));
        $this->db->delete('pesanan');
        
        $this->db->where('id_pesanan', $this->db->escape_str($id));
        $this->db->delete('detail_pesanan');
    }

    public function getPesananLuar()
    {
        $q = "SELECT pesanan.*, `status`.`simbol`,`status`.`keterangan`,`status`.`class`
         FROM pesanan, `status`
         WHERE pesanan.id_status =2
         AND pesanan.id_status2=4
        AND pesanan.id_status = `status`.`id`    
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }

    public function getRiwayat()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $query = "SELECT id, atas_nama, day(tanggal) as tgl, month(tanggal) as bulan, year(tanggal) as tahun, total_harga, jumlah_pesanan, ppn, service, diskon, total_harga-diskon as pendapatan,metode_bayar, kasir, keterangan_diskon, jumlah_bayar, kembalian
        FROM pesanan
        WHERE id_status = 3
        AND id_status2 = 3
        AND tanggal >='$now' ";
        return $this->db->query($query)->result_array();
    }

    public function getkasirDone()
    {
        $q = "SELECT pesanan.*, `status`.`simbol`,`status`.`keterangan`,`status`.`class`, karyawan.nama  FROM pesanan, `status`, karyawan WHERE pesanan.id_status = 3
        AND pesanan.id_status = `status`.`id`   
        AND pesanan.server = `karyawan`.`id`  
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }

    public function getDetail($id)
    {
        $q = "SELECT detail_pesanan.*, SUM(jumlah) as totalqty FROM detail_pesanan
            WHERE id_pesanan = $id
            group by id_menu";
        return $this->db->query($q);
    }

    public function getPesanan($id)
    {
        $q = "SELECT * FROM pesanan WHERE id = $id";
        return $this->db->query($q);
    }
    public function getGantiKs($id)
    {
        $q = "SELECT pesanan.*, `status`.`keterangan` FROM pesanan, `status` WHERE
        pesanan.id_status = `status`.`id` AND
        pesanan.id = $id
        ";

        return $this->db->query($q);
    }
}
