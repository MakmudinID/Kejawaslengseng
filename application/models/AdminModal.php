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

    public function limitRows_($table, $select, $column_order, $column_search, $order, $join, $filter)
    {
        $this->selectField_($table, $select, $column_order, $column_search, $order, $join, $filter);
        if (isset($_POST['length'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    protected function selectField_($table, $select, $column_order, $column_search, $order, $join, $filter)
    {
        $this->db->select($select);
        $this->db->from($table);

        if ($join != NULL) {
            for ($i = 0; $i < count($join); $i++) {
                $this->db->join($join[$i][0], $join[$i][1], 'left');
            }
        };
        
        if ($filter == 'now') {
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
            $this->db->where('DATE(tanggal)',$curr_date);//use date function
        }else if($filter == 'week'){
            $this->db->where('DATE(tanggal) >=', date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d')))) );//use date function
        }else if($filter == 'month'){
            $this->db->where('MONTH(tanggal)', date('m'));//use date function
        }else{
            //year
            $this->db->where('YEAR(tanggal)', date('Y'));//use date function
        };

        $i = 0;
        foreach ($column_search as $item) {
            if (isset($_POST['search'])) {
                if ($_POST['search']['value']) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if (count($column_search) - 1 == $i) {
                        $this->db->group_end();
                    }
                }
            }
            $i++;
        }

        $this->db->group_by('menu.id');
        
        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function countFiltered_($table, $select, $column_order, $column_search, $order, $join, $filter)
    {
        $this->selectField_($table, $select, $column_order, $column_search, $order, $join, $filter);
        return $this->db->count_all_results();
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
