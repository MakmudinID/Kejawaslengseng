<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminModal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAdmin()
    {
        return $this->db->query("SELECT karyawan.*, active.keterangan, active.warna, karyawan_role.role FROM karyawan,active, karyawan_role
        WHERE karyawan.role_id = karyawan_role.id AND karyawan.is_active = active.id
        ORDER BY karyawan.is_active ASC
        ")->result_array();
    }

    public function getPendapatan($dari, $sampai)
    {
        $q = "SELECT id, day(tanggal) as tgl, month(tanggal) as bulan, year(tanggal) as tahun, count(id) as pesanan, sum(diskon) as diskon, sum(ppn) as ppn, sum(total_harga) as pendapatan
        FROM pesanan
        WHERE id_status = 3
        AND id_status2 = 3
        AND tanggal >= '$dari'
        AND tanggal <= '$sampai'
        GROUP BY tgl, bulan, tahun
        ORDER BY tanggal ASC
        ";
        return $this->db->query($q)->result_array();
    }

    public function cekNotif()
    {
        $q = "SELECT max(id) as jumlah from pesanan WHERE id_status=2 and id_status2=1";
        return $this->db->query($q)->row_array();
    }

    public function getWeekly()
    {
        $q = "SELECT sum(total_harga) as pendapatan, sum(diskon) as diskon, sum(ppn) as ppn, DATE(r.tanggal) tanggal, DATE_FORMAT(r.tanggal, '%a') hari 
            FROM pesanan r 
            WHERE YEARWEEK(r.tanggal, 1) = YEARWEEK(NOW(), 1) 
            AND r.id_status=3
            AND r.id_status2=3
            GROUP BY DATE(r.tanggal) 
            ORDER BY DATE(r.tanggal) ASC
        ";
        return $this->db->query($q)->result_array();
    }

    public function getRiwayat($dari, $sampai)
    {
        $q = "SELECT id, atas_nama, day(tanggal) as tgl, month(tanggal) as bulan, year(tanggal) as tahun, ppn, service, jumlah_pesanan, total_harga, diskon, metode_bayar, keterangan_diskon, total_harga-diskon as pendapatan, kasir, jumlah_bayar, kembalian
                FROM pesanan
                WHERE id_status = 3
                AND id_status2 = 3
                AND tanggal >= '$dari'
                AND tanggal <= '$sampai'
                ORDER BY tanggal ASC
        ";
        return $this->db->query($q)->result_array();
    }

    public function getDetPendapatan($id)
    {

        $q = "SELECT detail_pesanan.* 
                FROM detail_pesanan, pesanan
                WHERE pesanan.id = detail_pesanan.id_pesanan
                AND pesanan.id = $id
                
        ";
        return $this->db->query($q)->result_array();
    }

    public function getPembelian($dari, $sampai)
    {
        $q = "SELECT id, judul, day(tgl) as tgl, month(tgl) as bulan, year(tgl) as tahun, total_harga, nama_pj, Catatan
                FROM bahan
                WHERE status = 2
                AND tgl >= '$dari'
                AND tgl <= '$sampai'
                ORDER BY tgl DESC
        ";
        return $this->db->query($q)->result_array();
    }

    public function getDetPembelian($id)
    {
        $q = "SELECT detail_bahan.* 
                FROM detail_bahan, bahan
                WHERE bahan.id = detail_bahan.id_bahan
                AND id_bahan = $id
        ";
        return $this->db->query($q)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->query("SELECT karyawan.*, active.keterangan, karyawan_role.role FROM karyawan,active, karyawan_role
        WHERE karyawan.role_id = karyawan_role.id AND karyawan.is_active = active.id AND karyawan.id = $id
        ")->row_array();
    }
    public function getMenu()
    {
        return $this->db->query("SELECT * FROM kategori WHERE kategori_aktif =1")->result_array();
    }
    public function getKategori($id)
    {
        $q = "SELECT kategori.nama_kategori, menu.* FROM kategori, menu
        WHERE kategori.id = menu.id_kategori AND menu.id_kategori = $id
        ";
        return $this->db->query($q)->result_array();
    }

    public function menuAll()
    {
        $q = "SELECT kategori.nama_kategori, menu.* FROM kategori, menu
        WHERE kategori.id = menu.id_kategori
        ";
        return $this->db->query($q)->result_array();
    }

    public function getKategoriOnly($id)
    {
        return $this->db->query("SELECT * FROM kategori WHERE id = $id")->row_array();
    }
    public function getPerKategori($id)
    {
        return $this->db->get_where('menu', ['id' => $id])->row_array();
    }
    public function getKat()
    {
        return $this->db->query("SELECT * FROM kategori WHERE kategori_aktif =1")->result_array();
    }
}
