<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GudangModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getBahan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $query = "SELECT *
        FROM bahan
        WHERE tgl >='$now'
        AND status = 2
        ORDER BY tgl DESC";
        return $this->db->query($query)->result_array();
    }
    public function getCek($nama)
    {
        $q = "SELECT bahan.* FROM bahan,karyawan
        WHERE bahan.pj = karyawan.id
        AND bahan.status = 1
        AND bahan.pj = '$nama'
        ";
        return $this->db->query($q)->row_array();
    }

    public function getListBahan($id)
    {
        $q = "SELECT detail_bahan.*, bahan.*, detail_bahan.id as idbahan
        FROM bahan, detail_bahan
        WHERE detail_bahan.id_bahan = bahan.id
        AND detail_bahan.id_bahan = $id
        ";
        return $this->db->query($q)->result_array();
    }
    public function getDetail($id)
    {
        $q = "SELECT bahan.*, karyawan.nama FROM bahan,karyawan
        WHERE bahan.pj = karyawan.id
        AND bahan.id = $id
        ";
        return $this->db->query($q)->row_array();
    }

    public function getDetailMenu($id)
    {
        return $this->db->get_where('menu', ['id' => $id])->row_array();
    }
    public function getHistoryStok()
    {
        $q = "SELECT history_stok.*, menu.nama_menu, kategori.nama_kategori, karyawan.nama
            FROM menu, history_stok, kategori, karyawan
            WHERE history_stok.id_menu = menu.id
            AND history_stok.id_kategori = kategori.id
            AND history_stok.pj = karyawan.id
        ";
        return $this->db->query($q)->result_array();
    }
}
