<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PembeliModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getRiwayat($id)
    {
        $q = "SELECT pesanan.*, `status2`.`ket`,`status2`.`class2`, `status2`.`simbol2`, status2.id as idstatus, `status`.`keterangan`
        FROM pesanan, `status2`, `status`
        WHERE pesanan.id_status2=`status2`.`id`  
        AND pesanan.id_status=`status`.`id`
        AND pesanan.server = $id
        ORDER BY id ASC
        ";
        
        return $this->db->query($q);
    }
    
     public function getTotalPesanan($id)
    {
        $q = "SELECT count(*) as now
        FROM pesanan
        WHERE id_status2 = 1
        AND pesanan.server = $id
        ";
        return $this->db->query($q);
    }
    
}

