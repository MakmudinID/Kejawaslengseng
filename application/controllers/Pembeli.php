<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembeli extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // cek_login();
    $this->load->library('form_validation');
    $this->load->model('ServerModal');
    $this->load->model('AdminModal');
    $this->load->model('PembeliModal');
    

    // $this->load->model('chart_model');
  }


  public function index()
  {
    $data = [
      'id_def' => 4
    ];
    $this->session->set_userdata($data);
    redirect('pembeli/home');
  }
  public function temp($id)
  {
    $data = [
      'id_def' => $id
    ];
    $this->session->set_userdata($data);
    redirect('pembeli/home');
  }

  public function home()
  {
    $data['title']='Pembeli';
    $def = $this->session->userdata('id_def');
    $id_pembeli = $this->session->userdata('id_karyawan');

    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $id_pembeli])->row_array();

    $cek_awal = $this->ServerModal->cekAwal($id_pembeli);
    //klo ga ada
    if (!$cek_awal) {
      $isi = [
        'id_status' => 1,
        'server' => $id_pembeli
      ];
      $this->db->insert('pesanan', $isi);
      //klo ada
    }

    $ada = $this->ServerModal->cekAwal($id_pembeli);
    $id = $ada['id'];
    $data['listPesanan'] = $this->ServerModal->listPesanan($id);
    $data['kategori'] = $this->AdminModal->getMenu();
    $data['judulMenu'] = $this->db->get('kategori', ['id' => $def])->row_array();
    $data['byMenu'] =  $this->ServerModal->getMenuBy($def);
    $data['konfirm'] = $this->ServerModal->getKonfirmasi();

    $this->form_validation->set_rules('qty', 'Qty', 'required|trim|integer');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pembeli/top_home', $data);
      $this->load->view('templates/listpesanan', $data);
      $this->load->view('templates/footer');
    } else {
      $jmh_brg = $this->input->post('qty');
      $id_men = $this->input->post('id_b');

      $cekDulu = $this->db->query("SELECT * FROM detail_pesanan WHERE id_menu = $id_men AND id_pesanan = $id")->row_array();
      $id_det = $cekDulu['id'];
      $dikeranjang_skrg = $cekDulu['jumlah'];

      //cek stok barang
      $cekMenu = $this->ServerModal->cekMenu($id_men);
      $stokMenu = $cekMenu['stok'];
      if ($stokMenu < $jmh_brg) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Stok Tidak Cukup !</div>');
        redirect('pembeli/home');
      }

      //nambah barang yg udh ada
      if ($cekDulu) {

        $upd_jmh = $dikeranjang_skrg + $jmh_brg;
        $this->db->set('jumlah', $upd_jmh);
        $this->db->where('id', $id_det);
        $this->db->update('detail_pesanan');

        $upd_stok = $stokMenu - $jmh_brg;
        $this->db->set('stok', $upd_stok);
        $this->db->where('id', $id_men);
        $this->db->update('menu');

        //nambah braang baru
      } else {
        $datamenu = $this->db->get_where('menu', ['id' => $id_men])->row_array();
        $nama_menu = $datamenu['nama_menu'];
        $harga = $datamenu['harga'];
        $isi = [
          'id_pesanan' => $id,
          'id_menu' => $id_men,
          'nama_menu' => $nama_menu,
          'jumlah' => $jmh_brg,
          'harga' => $harga,
        ];
        $this->db->insert('detail_pesanan', $isi);
        $cek_menu = $this->db->get_where('menu', ['id' => $id_men])->row_array();
        $stok_now = $cek_menu['stok'];
        $stok_update = $stok_now - $jmh_brg;

        $this->db->set('stok', $stok_update);
        $this->db->where('id', $id_men);
        $this->db->update('menu');
      }

      redirect('pembeli/home');
    }
  }
  
  public function riwayat()
  {
    $id_pembeli = $this->session->userdata('id_karyawan');
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $id_pembeli])->row_array();
    
    $data['title']='Daftar Pesanan';
    $data['listPesanan'] = $this->PembeliModal->getRiwayat($id_pembeli)->result_array();
    $data['menunggu'] = $this->PembeliModal->getTotalPesanan($id_pembeli)->row_array();
    $data['pilihan'] = $this->db->get('status2')->result_array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('pembeli/pesanan_masuk', $data);
    $this->load->view('templates/footer');

  }
  
  public function hapus_barang($id)
  {
    $cekDetPesanan = $this->ServerModal->cekDetPesanan($id);
    $id_men = $cekDetPesanan['id_menu'];
    $jmh = $cekDetPesanan['jumlah'];

    $cekMenu = $this->ServerModal->cekMenu($id_men);
    $stokMenu = $cekMenu['stok'];
    $upd_stok = $stokMenu + $jmh;

    $this->db->set('stok', $upd_stok);
    $this->db->where('id', $id_men);
    $this->db->update('menu');


    $this->db->where('id', $id);
    $this->db->delete('detail_pesanan');


    redirect('pembeli/home');
  }
  
   public function konfirmasi($id_pesanan)
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    // $ini_pesanan = $this->db->get_where('pesanan', ['id_status' => 1])->row_array();
    // $id_pesanan = $ini_pesanan['id'];

    $data['konfirm'] = $this->ServerModal->getKonfirmasi();
    $temp =  $data['konfirm'];
    $i = 1;
    $j = 0;
    $tot = 0;

    foreach ($temp as $t) {
      $j = $t['harga'] * $t['jumlah'];
      $tot += $j;
      $i += 1;
    }

    $jmh = count($temp);
    date_default_timezone_set('Asia/Jakarta');
    $tgl2 = date("Y-m-d H:i:s");

    $nama = $this->input->post('nama');
        
      $inp = [
        'atas_nama' => $nama,
        'jumlah_pesanan' => $jmh,
        'tanggal' => $tgl2,
        'total_harga' => $this->input->post('total_harga'),
        'id_status' => 2, //status server&kasie
        'id_status2' => 1, //status dapur
        'server' => $this->session->userdata('id_karyawan'),
        'note' => $this->input->post('note'),
        'status' => $this->input->post('status'),
        'pembeli_luar' => 1
      ];
    
      $this->db->where('id', $id_pesanan);
      $this->db->update('pesanan', $inp);
    
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Halo '.$nama.', Selamat Pesananmu Berhasil Dibuat.. Mohon Tunggu yaa!</div>');
      redirect('server/home');
  }
  
}

