<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DapurModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDapur()
    {
        $q = "SELECT pesanan.*, `status2`.`ket`,`status2`.`class2`, `status2`.`simbol2`, status2.id as idstatus
        FROM pesanan, `status2`
        WHERE pesanan.id_status2 <> 3 
        AND pesanan.id_status2 <> 4 
        AND pesanan.id_status2 <> 5
        AND pesanan.id_status2 = `status2`.`id`   
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }

    public function getDapurPesanan()
    {
        $q = "SELECT pesanan.*, `status2`.`ket`,`status2`.`class2`, `status2`.`simbol2`, status2.id as idstatus, status.keterangan
        FROM pesanan, `status2`, status
        WHERE pesanan.id_status = 2
        AND status.id = pesanan.id_status
        AND pesanan.id_status2 = `status2`.`id`   
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }

    public function getTotalPesanan()
    {
        $q = "SELECT count(*) as now
        FROM pesanan
        WHERE id_status2 = 1
        ";
        return $this->db->query($q);
    }

    public function getRiwayatMasakan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');

        $q = "SELECT pesanan.*, `status2`.`ket`,`status2`.`class2`, `status2`.`simbol2`, karyawan.nama FROM pesanan, `status2`, karyawan 
        WHERE pesanan.id_status2 = 3
        AND pesanan.id_status2 = `status2`.`id`   
        AND karyawan.id = `pesanan`.`server`  
        AND pesanan.tanggal >='$now'
        ORDER BY id DESC
        ";
        return $this->db->query($q);
    }



    public function getDetail($id)
    {
        $q = "SELECT detail_pesanan.*, menu.nama_menu FROM detail_pesanan, menu WHERE id_pesanan = $id
        AND detail_pesanan.id_menu = menu.id";
        return $this->db->query($q);
    }
    public function getGanti($id)
    {
        $q = "SELECT pesanan.*, status2.ket FROM pesanan, status2
        WHERE pesanan.id = $id AND
        pesanan.id_status2 = status2.id 
        
        ";
        return $this->db->query($q);
    }
}
