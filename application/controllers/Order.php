<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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

    //   $who = $this->session->userdata('role_id');
    //     if ($who != 2 and $who!=1) {
    //         redirect('auth/nakal');
    //     }
  }


  public function index()
  {
    $data = [
      'id_def' => 2
    ];
    $this->session->set_userdata($data);
    redirect('order/online');
  }

  public function online()
  {
    $data = [
      'id_def' => 2
    ];
    $this->session->set_userdata($data);
    $data['title'] = 'e-Order Resto Kejawa';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['gallery'] = $this->db->get('gallery')->result_array();
    $this->load->view('templates/header_order', $data);
    $this->load->view('templates/navbar_order', $data);
    $this->load->view('order/index', $data);
    $this->load->view('templates/footer_order', $data);
  }

  public function lokasi()
  {
    $data['title'] = 'Lokasi Resto Kejawa';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $this->load->view('templates/header_order', $data);
    $this->load->view('templates/navbar_order', $data);
    $this->load->view('order/lokasi', $data);
    $this->load->view('templates/footer', $data);
  }

  public function about()
  {
    $data['title'] = 'Tentang Resto Kejawa';
    $data['gallery'] = $this->db->get('gallery')->result_array();
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $this->load->view('templates/header_order', $data);
    $this->load->view('templates/navbar_order', $data);
    $this->load->view('order/profile', $data);
    $this->load->view('templates/footer', $data);
  }

  public function menu()
  {
    $data['title'] = 'Menu';
    $def = $this->session->userdata('id_def');
    if (empty($def)) {
      $def = 2;
      $this->session->set_userdata('id_def', $def);
    }
    $data['judulMenu'] = $this->db->get('kategori', ['id' => $def])->row_array();
    $data['byMenu'] =  $this->ServerModal->getMenuBy($def);
    $data['kategori'] = $this->AdminModal->getMenu();
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();

    $this->load->view('templates/header_order', $data);
    $this->load->view('templates/navbar_order', $data);
    $this->load->view('order/order_online', $data);
    $this->load->view('order/listpesanan', $data);
    $this->load->view('templates/footer_order', $data);
  }

  function add_to_cart()
  { //fungsi Add To Cart
    $data = array(
      'id' => $this->input->post('menu_id'),
      'name' => htmlspecialchars($this->input->post('menu_nama')),
      'price' => $this->input->post('menu_harga'),
      'qty' => $this->input->post('quantity'),
      'stok' => $this->input->post('stok'),
      'foto' => $this->input->post('menu_foto'),
    );
    $this->cart->insert($data);
    echo $this->show_cart(); //tampilkan cart setelah added
  }

  function show_cart()
  { //Fungsi untuk menampilkan Cart
    $output = '';
    $no = 0;
    foreach ($this->cart->contents() as $items) {
      $no++;
      $output .= '
        <div class="d-flex">
            <div class="avatar avatar-online">
              <img src="' . base_url('assets/img_menu/') . $items['foto'] . '" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="flex-1 ml-3 pt-1">
                <span class="category-title"><h6 class="text-uppercase fw-bold mb-1">' . $items['name'] . '</h6></span>
                <div class="contact-list contact-list-recent">
                    <span class="text-muted">Rp. ' . number_format($items['subtotal'], 0, ',', '.') . '</span><br>
                    <a href="javascript:void(0)" id="' . $items['rowid'] . '" data-qtynow="' . $items['qty'] . '" class="min_cart badge badge-info mt-2"><i class="fas fa-minus"></i></a>
                      <span class="badge badge-count mt-2">' . $items['qty'] . '</span>
                    <a href="javascript:void(0)" id="' . $items['rowid'] . '" data-qtynow="' . $items['qty'] . '" data-stok="' . $items['stok'] . '"  class="plus_cart badge badge-info mt-2"><i class="fas fa-plus"></i></a>
                    <a href="javascript:void(0)" id="' . $items['rowid'] . '" class="hapus_cart badge badge-danger mt-2 float-right"><i class="fas fa-trash"></i> Batal</a>
                </div>
            </div>
        </div>
        <hr>
		';
    }
    if ($this->cart->total() != '0') {
      $output .= '
    <h4 class="fw-bold mt-2 text-center">' . 'Total : Rp ' . number_format($this->cart->total(), 0, ',', '.') . '</h4>
    <button type="button" data-toggle="modal" class="konfirmasi btn btn-border btn-primary mt-1" data-target="#konfirmasi" class="btn btn-primary btn-border mt-1" style="width:100%;"><b>Pesan Sekarang</b></button>
    ';
    } else {
      $output .= '
	  <h4 class="fw-bold mt-2 mb-2 text-center">Tidak ada pesanan</h4>
	  ';
    }
    return $output;
  }

  function show_tablecart()
  { //Fungsi untuk menampilkan Cart
    $output = '';
    $no = 0;
    foreach ($this->cart->contents() as $items) {
      $no++;
      $output .= '
      <tr>
        <td>' . $items['name'] . '</td>
        <td align="center">' . number_format($items['qty'], 0, ',', '.') . '</td>
        <td align="right">' . number_format($items['subtotal'], 0, ',', '.') . '</td>
      </tr>
		';
    }
    $output .= '
	  <tr>
        <td colspan="2" align="right"><b>Total (' . $no . ' items)</b></td>
        <td align="right"><b>' . number_format($ttl = $this->cart->total(), 0, ',', '.') . '</b></td>
    </tr>';
    return $output;
  }

  function load_cart()
  { //load data cart
    echo $this->show_cart();
  }

  function load_tablecart()
  { //load data cart
    echo $this->show_tablecart();
  }

  function hapus_cart()
  { //fungsi untuk menghapus item cart
    $data = array(
      'rowid' => $this->input->post('row_id'),
      'qty' => 0,
    );
    $this->cart->update($data);
    echo $this->show_cart();
  }

  function min_cart()
  { //fungsi untuk mengurangi item cart -1
    $data = array(
      'rowid' => $this->input->post('row_id'),
      'qty' => $this->input->post('qty_now') - 1,
    );
    if ($this->input->post('qty_now') > 1) {
      $this->cart->update($data);
    }
    echo $this->show_cart();
  }

  function plus_cart()
  { //fungsi untuk menambah item cart +1
    $data = array(
      'rowid' => $this->input->post('row_id'),
      'qty' => $this->input->post('qty_now') + 1,
    );
    if ($this->input->post('qty_now') + 1 <= $this->input->post('stok')) {
      $this->cart->update($data);
    }
    echo $this->show_cart();
  }

  public function temp($id)
  {
    $data = [
      'id_def' => $id
    ];
    $this->session->set_userdata($data);
    redirect('order/menu');
  }

  public function konfirmasi()
  {
    if ($this->input->post('layanan') == null) {
      redirect('order/menu');
    }
    $namapemesan = $this->input->post('namapemesan');
    $status = $this->input->post('status');
    $waktu = $this->input->post('waktu');
    $catatan = $this->input->post('catatan');
    $layanan = $this->input->post('layanan');
    $nomor = $this->input->post('nomorkontak');
    $email = $this->input->post('email');
    if ($layanan == 1) {
      $layanan = "Dine In";
      $datasesi = [
        'namapemesan' => htmlspecialchars($namapemesan, ENT_QUOTES),
        'status' => htmlspecialchars($status, ENT_QUOTES),
        'waktu' => htmlspecialchars($waktu, ENT_QUOTES),
        'catatan' => htmlspecialchars($catatan, ENT_QUOTES),
        'layanan' => htmlspecialchars($layanan, ENT_QUOTES),
        'nomor' => htmlspecialchars($nomor, ENT_QUOTES),
      ];
      $this->session->set_userdata($datasesi);
      $data['title'] = 'Konfirmasi Pesanan';
      $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
      $this->load->view('templates/header_order', $data);
      $this->load->view('templates/navbar_order', $data);
      $this->load->view('order/konfirmasi', $data);
      $this->load->view('templates/footer', $data);
    } elseif ($layanan == 0) {
      $layanan = "Take Away";
      $datasesi = [
        'namapemesan' => htmlspecialchars($namapemesan, ENT_QUOTES),
        'status' => htmlspecialchars($status, ENT_QUOTES),
        'waktu' => htmlspecialchars($waktu, ENT_QUOTES),
        'catatan' => htmlspecialchars($catatan, ENT_QUOTES),
        'layanan' => htmlspecialchars($layanan, ENT_QUOTES),
        'nomor' => htmlspecialchars($nomor, ENT_QUOTES),
        'email' => htmlspecialchars($email, ENT_QUOTES),
      ];
      $this->session->set_userdata($datasesi);
      $data['title'] = 'Konfirmasi Pesanan';
      $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
      $this->load->view('templates/header_order', $data);
      $this->load->view('templates/navbar_order', $data);
      $this->load->view('order/konfirmasi', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function proses()
  {
    date_default_timezone_set('Asia/Jakarta');
    $tgl2 = date("Y-m-d H:i:s");
    $no = 0;
    foreach ($this->cart->contents() as $item) {
      $no++;
    }

    if ($this->session->userdata('status') == "lebihawal") {
      $inp = [
        'atas_nama' => htmlspecialchars($this->session->userdata('namapemesan'), ENT_QUOTES),
        'jumlah_pesanan' => $no,
        'tanggal' => $tgl2,
        'total_harga' => $this->cart->total(),
        'id_status' => 2, //status server&kasie
        'id_status2' => 4, //status dapur
        'server' => 1,
        'note' => htmlspecialchars($this->session->userdata('catatan') . ' - Jam ' . $this->session->userdata('waktu') . '<br> Kontak. ' . $this->session->userdata('nomor'), ENT_QUOTES),
        'status' => htmlspecialchars($this->session->userdata('layanan'), ENT_QUOTES),
        'pembeli_luar' => 1,
      ];
    } else {
      $inp = [
        'atas_nama' => htmlspecialchars($this->session->userdata('namapemesan'), ENT_QUOTES),
        'jumlah_pesanan' => $no,
        'tanggal' => $tgl2,
        'total_harga' => $this->cart->total(),
        'id_status' => 2, //status server&kasie
        'id_status2' => 4, //status dapur
        'server' => 1,
        'note' => htmlspecialchars($this->session->userdata('catatan') . ' - NOW', ENT_QUOTES),
        'status' => htmlspecialchars($this->session->userdata('layanan'), ENT_QUOTES),
        'pembeli_luar' => 1,
      ];
    }
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
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Halo ' . $this->session->userdata('namapemesan') . ', Pesananmu Berhasil Dibuat!</div>');
    redirect('order/menu');
  }
}
