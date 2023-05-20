<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Server extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // cek_login();
    $this->load->library('form_validation');
    $this->load->model('ServerModal');
    $this->load->model('AdminModal');
    $this->load->model('DapurModal');

    // $this->load->model('chart_model');

    // $who = $this->session->userdata('role_id');
    // if ($who != 2 and $who != 1 ) {
    //   redirect('auth/login');
    // }
  }

  public function index()
  {
    $data = [
      'id_def' => 2
    ];
    $this->session->set_userdata($data);
    redirect('server/home');
  }

  public function temp($id)
  {
    $data = [
      'id_def' => $id
    ];
    $this->session->set_userdata($data);
    redirect('server/home');
  }

  public function dapur()
  {
    $data['title'] = 'Batal Tambah Pesanan';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['listPesanan'] = $this->DapurModal->getDapurPesanan()->result_array();
    $data['menunggu'] = $this->DapurModal->getTotalPesanan()->row_array();
    $data['pilihan'] = $this->db->get('status2')->result_array();
    $data['daftarmenu'] = $this->db->get('menu')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('server/pesanan_dapur', $data);
    $this->load->view('templates/footer', $data);
  }

  public function hapus_barang_dapur($id)
  {
    $cekDetPesanan = $this->ServerModal->cekDetPesanan($id);
    $id_men = $cekDetPesanan['id_menu'];
    $jmh = $cekDetPesanan['jumlah'];
    $harga = $cekDetPesanan['harga'];
    $idpesanan = $cekDetPesanan['id_pesanan'];

    $cekMenu = $this->ServerModal->cekMenu($id_men);
    $stokMenu = $cekMenu['stok'];
    $upd_stok = $stokMenu + $jmh;

    $this->db->set('stok', $upd_stok);
    $this->db->where('id', $id_men);
    $this->db->update('menu');

    $cek_data = $this->db->get_where('pesanan', ['id' => $idpesanan])->row_array();
    $total_harga = $cek_data['total_harga'];
    $jumlahpesanan = $cek_data['jumlah_pesanan'] - 1;
    $total_harga_now = $total_harga - ($jmh * $harga);
    $pajaknow = $total_harga_now * 10 / 100;
    $updt  = array(
      'total_harga' => $total_harga_now,
      'ppn' => $pajaknow,
      'jumlah_pesanan' => $jumlahpesanan
    );
    $this->db->where('id', $idpesanan);
    $this->db->update('pesanan', $updt);

    //hapus
    $this->db->where('id', $id);
    $this->db->delete('detail_pesanan');
    redirect('server/dapur');
  }

  public function home()
  {
    $data['title'] = 'Pemesanan';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $def = $this->session->userdata('id_def');
    if (empty($def)) {
      $def = 2;
      $this->session->set_userdata('id_def', $def);
    }
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['judulMenu'] = $this->db->get('kategori', ['id' => $def])->row_array();
    $data['byMenu'] =  $this->ServerModal->getMenuBy($def);
    $data['kategori'] = $this->AdminModal->getMenu();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('server/top_home', $data);
    $this->load->view('order/listpesanan', $data);
    $this->load->view('templates/footer_order', $data);
  }

  public function tambah_orderan()
  {
    $jmh_brg = $this->input->post('jumlah');
    $menu = $this->input->post('menu');
    $idpesanan = $this->input->post('idpesanan');

    $CekDetailPesanan = $this->db->query("SELECT * FROM detail_pesanan WHERE id_menu = $menu AND id_pesanan = $idpesanan AND status=0")->row_array();
    $CekStatusPesanan = $this->db->query("SELECT * FROM pesanan WHERE id_status2 = 3 AND id = $idpesanan")->row_array();
    $datamenu = $this->db->get_where('menu', ['id' => $menu])->row_array();
    $nama_menu = $datamenu['nama_menu'];
    $harga = $datamenu['harga'];

    $id_det = $CekDetailPesanan['id'];
    $dikeranjang_skrg = $CekDetailPesanan['jumlah'];

    //cek stok barang
    $cekMenu = $this->ServerModal->cekMenu($menu);
    $stokMenu = $cekMenu['stok'];
    if ($stokMenu < $jmh_brg) {
      $this->session->set_flashdata('message', '<div class="tutup alert alert-warning" role="alert">Jumlah Pesanan tidak mencukupi stok yang tersedia di dapur!</div>');
      redirect('server/dapur');
    }

    //nambah barang yg udh ada di detail pesanan dan belum di masak
    if ($CekDetailPesanan) {

      $upd_jmh = $dikeranjang_skrg + $jmh_brg;
      $this->db->set('jumlah', $upd_jmh);
      $this->db->where('id', $id_det);
      $this->db->update('detail_pesanan');

      $upd_stok = $stokMenu - $jmh_brg;
      $this->db->set('stok', $upd_stok);
      $this->db->where('id', $menu);
      $this->db->update('menu');

      $cek_total_harga = $this->db->get_where('pesanan', ['id' => $idpesanan])->row_array();
      $total_sebelum_tambah = $cek_total_harga['total_harga'];
      $totalnow = $total_sebelum_tambah + ($harga * $jmh_brg);
      $pajaknow = $totalnow * 10 / 100;

      // update total harga dan pajak
      $updt  = array(
        'total_harga' => $totalnow,
        'ppn' => $pajaknow,
      );
      $this->db->where('id', $idpesanan);
      $this->db->update('pesanan', $updt);

      //nambah braang baru
    } else {
      $isi = [
        'id_pesanan' => $idpesanan,
        'id_menu' => $menu,
        'nama_menu' => $nama_menu,
        'jumlah' => $jmh_brg,
        'harga' => $harga,
      ];
      $this->db->insert('detail_pesanan', $isi);
      $id_detail_pesanan = $this->db->insert_id();
      $cek_data_detail = $this->db->get_where('detail_pesanan', ['id' => $id_detail_pesanan])->row_array();
      $jumlah_di_detail = $cek_data_detail['jumlah'];
      $harga_di_detail = $cek_data_detail['harga'];

      $cek_total_harga = $this->db->get_where('pesanan', ['id' => $idpesanan])->row_array();
      $jumlahpesanan = $cek_total_harga['jumlah_pesanan'];
      $total_sebelum_tambah = $cek_total_harga['total_harga'];
      $totalnoww = $total_sebelum_tambah + ($harga_di_detail * $jumlah_di_detail);
      $pajaknoww = $totalnoww * 10 / 100;

      // update total harga
      $updt  = array(
        'total_harga' => $totalnoww,
        'ppn' => $pajaknoww,
        'jumlah_pesanan' => $jumlahpesanan + 1
      );
      $this->db->where('id', $idpesanan);
      $this->db->update('pesanan', $updt);

      if ($CekStatusPesanan) {
        $this->db->set('id_status2', 2);
        $this->db->where('id', $idpesanan);
        $this->db->update('pesanan');
      }
    }
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil menambahkan order menu ' . $nama_menu . '!</div>');
    redirect('server/dapur');
  }

  public function konfirmasi()
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    date_default_timezone_set('Asia/Jakarta');
    $tgl2 = date("Y-m-d H:i:s");
    $karyawan = $data['saya_karyawan']['nama'];
    $nama = $this->input->post('nama');
    $catatan = $this->input->post('note');

    $no = 0;
    foreach ($this->cart->contents() as $item) {
      $no++;
    }

    $inp = [
      'atas_nama' => htmlspecialchars($nama, ENT_QUOTES),
      'jumlah_pesanan' => $no,
      'tanggal' => $tgl2,
      'total_harga' => $this->cart->total(),
      'id_status' => 2, //status server&kasie
      'id_status2' => 1, //status dapur
      'server' => htmlspecialchars($karyawan, ENT_QUOTES),
      'note' => htmlspecialchars($catatan, ENT_QUOTES),
      'status' => $this->input->post('status')
    ];
    $this->db->insert('pesanan', $inp);
    $id_pesanan = $this->db->insert_id();

    $no = 0;
    foreach ($this->cart->contents() as $item) {
      //item[name]
      $data = array(
        'id_pesanan' => $id_pesanan,
        'id_menu' => $item['id'],
        'nama_menu' => $item['name'],
        'jumlah' => $item['qty'],
        'harga' => $item['price'],
        'status' => 0,
      );
      $this->db->insert('detail_pesanan', $data);
    }
    $this->cart->destroy();
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Halo ' . $nama . ', Pesananmu Berhasil Dibuat!</div>');
    redirect('server/home');
  }
}
