<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ServerModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $q = "SELECT COUNT(id) as jmh FROM user";
        return $this->db->query($q);
    }
    public function getStatusMasak()
    {
        $q = "SELECT * FROM karyawan";
        return $this->db->query($q);
    }

    public function cekAwal($id)
    {
        $q = "SELECT * FROM pesanan WHERE id_status =1
        AND server = $id
        ";
        return $this->db->query($q)->row_array();
    }

    public function getPaket()
    {
        $q = "SELECT * FROM `menu`
                where id_kategori=8
        ";
        return $this->db->query($q)->result_array();
    }

    public function listPesanan($id)
    {
        $q = "SELECT detail_pesanan.*, menu.nama_menu, menu.harga, menu.foto, menu.stok, menu.deskripsi FROM detail_pesanan, menu WHERE id_pesanan = $id AND detail_pesanan.id_menu = menu.id ";
        return $this->db->query($q)->result_array();
    }
    public function cekMenu($id)
    {
        return $this->db->get_where('menu', ['id' => $id])->row_array();
    }
    public function cekDetPesanan($id)
    {
        return $this->db->get_where('detail_pesanan', ['id' => $id])->row_array();
    }

    //riwayat
    public function riwayat()
    {
        $idk=$this->session->userdata('id_karyawan');
        $q = "SELECT pesanan.*, karyawan.*, `status`.*, status2.*, pesanan.id as idpesanan
        FROM pesanan, karyawan, `status`, `status2` 
        WHERE pesanan.server = karyawan.id
        AND pesanan.id_status = `status`.`id`
        AND pesanan.id_status2 = status2.id
        AND karyawan.id=$idk
        AND pesanan.id_status=2
        ";
        return $this->db->query($q)->result_array();
    }

    public function getProgress($id)
    {
        $q = "SELECT pesanan.*, karyawan.nama, status.keterangan, status2.caption
        FROM pesanan, karyawan, status,status2 
        WHERE pesanan.server = karyawan.id
        AND pesanan.id_status = status.id
        AND pesanan.id_status2 = status2.id
        AND pesanan.id=$id
        ";
        return $this->db->query($q)->row_array();
    }

    public function getKonfirmasi()
    {
        $q = "SELECT * FROM pesanan WHERE id_status = 1   
        ";
        $pesanan = $this->db->query($q)->row_array();
        $id_pesanan = $pesanan['id'];

        $qu = "SELECT * FROM detail_pesanan, menu 
        WHERE id_pesanan = $id_pesanan
        AND detail_pesanan.id_menu = menu.id
        ";
        return $this->db->query($qu)->result_array();
    }

    //-----------------------------new
    public function getMenuBy($id)
    {
        return $this->db->query("SELECT * FROM menu WHERE id_kategori = $id ORDER BY nama_menu ASC")->result_array();
    }
}
