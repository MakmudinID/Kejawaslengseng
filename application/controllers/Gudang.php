<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('GudangModal');
        $this->load->model('ServerModal');
        $this->load->model('AdminModal');
        // cek_login();
           $who = $this->session->userdata('role_id');
        if ($who != 5 and $who!=1) {
            redirect('auth/nakal');
        }
    }
    public function index()
    {
        $data['title']='Pembelian Bahan';
        $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $data['bahan'] = $this->GudangModal->getBahan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('gudang/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_bahan()
    {
        $data['title']='Pembelian Bahan';
        $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $id =  $data['saya_karyawan']['id'];
        $nama =  $data['saya_karyawan']['nama'];

        $cek = $this->GudangModal->getCek($id);
        if ($cek) {
            $id_bhn = $cek['id'];
            $data['listBahan'] = $this->GudangModal->getListBahan($id_bhn);
        } else {
            $buat = [
                'pj' => $id,
                'nama_pj' => $nama,
                'status' => 1
            ];
            $this->db->insert('bahan', $buat);

            $cek = $this->GudangModal->getCek($id);
            $id_bhn = $cek['id'];
            $data['listBahan'] = $this->GudangModal->getListBahan($id_bhn);
        }

        $this->form_validation->set_rules('nama', 'Nama', 'trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim');
        $this->form_validation->set_rules('harga', 'Harga', 'trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('gudang/tambah_bahan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rp = $this->input->post('harga');
            $harga = str_replace(".","","$rp");
            $add = [
                'id_bahan' => $id_bhn,
                'nama_bahan' => $this->input->post('nama'),
                'jumlah' => $this->input->post('jumlah'),
                'harga' => $harga
            ];
            $this->db->insert('detail_bahan', $add);
            redirect('gudang/tambah_bahan');
        }
    }

    public function konfirmasi()
    {
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $id =  $data['saya_karyawan']['id'];
        $cek = $this->GudangModal->getCek($id);
        $id_bhn = $cek['id'];
        $data['listBahan'] = $this->GudangModal->getListBahan($id_bhn);
        $i = 0;
        $total = 0;
        foreach ($data['listBahan'] as $cek) {
            $i += 1;
            $total += $cek['harga'];
        }
            date_default_timezone_set('Asia/Jakarta');
            $tgl2 = date("Y-m-d H:i:s");
            $oke = [
                'judul' => $this->input->post('judul'),
                'tgl' => $tgl2,
                'jumlah_bahan' => $i,
                'total_harga' => $total,
                'catatan' => $this->input->post('catatan'),
                'status' => 2
            ];
            $this->db->where('id', $id_bhn);
            $this->db->update('bahan', $oke);
            $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Menambahkan Bahan!</div>');
            redirect('gudang/index');
    }

    public function s_detail($id)
    {
        $data = [
            'id_detail' => $id
        ];
        $this->session->set_userdata($data);
        redirect('gudang/detail');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('detail_bahan');
        redirect('gudang/tambah_bahan');
    }

    public function detail()
    {
        $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
        $data['title']='Pembelian Bahan';
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $id_detail = $this->session->userdata('id_detail');
        $data['bahan'] = $this->GudangModal->getDetail($id_detail);
        $data['listBahan'] = $this->GudangModal->getListBahan($id_detail);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('gudang/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function daftar_stok()
    {
        $data = [
            'id_def' => 2
        ];
        $this->session->set_userdata($data);
        redirect('gudang/daftar_stok2');
    }
    public function temp($id)
    {
        $data = [
            'id_def' => $id
        ];
        $this->session->set_userdata($data);
        redirect('gudang/daftar_stok2');
    }

    public function daftar_stok2()
    {
        $data['title']='Kelola Stok';
        $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $def = $this->session->userdata('id_def');
        $data['byMenu'] =  $this->ServerModal->getMenuBy($def);
        $data['kategori'] = $this->AdminModal->getMenu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('gudang/daftar_stok', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ubah_stok($id)
    {
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $data['i'] = $this->GudangModal->getDetailMenu($id);
        $namamenu= $this->db->get_where('menu', ['id' => $id])->row_array();

            $upd = [
                'stok' => $this->input->post('stok')
            ];
            $this->db->where('id', $id);
            $this->db->update('menu', $upd);

            date_default_timezone_set('Asia/Jakarta');
            $tgl2 = date("Y-m-d H:i:s");

            $inp = [
                'tgl' => $tgl2,
                'id_menu' => $data['i']['id'],
                'id_kategori' => $data['i']['id_kategori'],
                'sebelum' => $data['i']['stok'],
                'sesudah' => $this->input->post('stok'),
                'pj' => $this->session->userdata('id_karyawan')
            ];
            $this->db->insert('history_stok', $inp);

            $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Stok <b>'.$namamenu['nama_menu'].'</b> berhasil dirubah!</div>');
            redirect('gudang/daftar_stok2');
    }

    public function riwayat_stok()
    {
        $data['title']='Riwayat Perubahan Stok';
        $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
        $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
        $data['historyStok'] = $this->GudangModal->getHistoryStok();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('gudang/riwayat_stok', $data);
        $this->load->view('templates/footer', $data);
    }
}
