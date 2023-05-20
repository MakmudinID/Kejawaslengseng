<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    //cek_login();

    $this->load->library('form_validation');
    $this->load->model('AdminModal');
    //cek_login();
    // $this->load->model('chart_model');
    $who = $this->session->userdata('role_id');
    if ($who != 1) {
      redirect('auth/nakal');
    }
  }


  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['jumlah_user'] = $this->db->count_all('karyawan');
    $data['jumlah_kategori'] = $this->db->count_all('kategori');
    $data['jumlah_menu'] = $this->db->count_all('menu');
    $data['penghasilan'] = $this->AdminModal->getWeekly();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/home_ad', $data);
    $this->load->view('templates/footer', $data);
  }

  public function profil()
  {
    $data['title'] = 'Profil Restoran';
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/profil', $data);
    $this->load->view('templates/footer', $data);
  }

  public function gallery()
  {
    $data['title'] = 'Gallery Resto';
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['gallery'] = $this->db->get('gallery')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/gallery', $data);
    $this->load->view('templates/footer', $data);
  }
  
  public function log_pesanan()
  {
    $this->load->view('templates/404');
  }

  public function tambah_gallery()
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    if ($_FILES['gambar']['error'] <> 4) {
      $nmfile = strtolower(url_title($this->input->post('judul'))) . date('YmdHis');
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size']     = '2548';
      $config['upload_path'] = './assets/img_gallery/';
      $config['file_name']        = $nmfile; //nama yang terupload nantinya

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('message', '<div class="tutup alert alert-danger alert" role="alert">' . $error['error'] . '</div>');
        $this->gallery();
      } else {
        $gambar = $this->upload->data();
        $nama = $data['saya_karyawan']['nama'];
        $add = [
          'judul' => htmlspecialchars($this->input->post('judul')),
          'foto' => $nmfile . $gambar['file_ext'],
          'created' => htmlspecialchars($nama)
        ];
        $this->db->insert('gallery', $add);
        $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil menambahkan ' . $this->input->post('judul') . ' !</div>');
        redirect('admin/gallery');
      }
    }
  }

  public function hapus_gallery($id)
  {
    $caripath = $this->db->get_where('gallery', ['id' => $id])->row_array();
    $hapusfoto = $caripath['foto'];
    if ($caripath != null) {
      unlink("./assets/img_gallery/$hapusfoto");
    }
    $this->db->where('id', $id);
    $this->db->delete('gallery');
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil menghapus foto!</div>');
    redirect('admin/gallery');
  }

  public function foto()
  {
    $data['profil'] = $this->db->get('profil')->row_array();
    $cek = $data['profil']['foto_resto'];
    if (empty($cek)) {
      if ($_FILES['gambar']['error'] <> 4) {
        $nmfile = strtolower(url_title($this->input->post('nama'))) . date('YmdHis');
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img_profil';
        $config['file_name']   = $nmfile; //nama yang terupload nantinya

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('message', '<div class="tutup alert alert-danger alert" role="alert">' . $error['error'] . '</div>');
          $this->profil();
        } else {
          $gambar = $this->upload->data();
          $add = [
            'foto_resto' => $nmfile . $gambar['file_ext']
          ];
          $this->db->where('id', 1);
          $this->db->update('profil', $add);
          $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil merubah logo resto!</div>');
          redirect('admin/profil');
        }
      }
    } else {
      if ($_FILES['gambar']['error'] <> 4) {
        $nmfile = strtolower(url_title($this->input->post('nama'))) . date('YmdHis');
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img_profil';
        $config['file_name']        = $nmfile; //nama yang terupload nantinya

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('message', '<div class="tutup alert alert-danger alert" role="alert">' . $error['error'] . '</div>');
          $this->profil();
        } else {
          $gambar = $this->upload->data();
          $add = [
            'foto_resto' => $nmfile . $gambar['file_ext']
          ];
          $this->db->where('id', 1);
          $this->db->update('profil', $add);
          $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil merubah logo resto!</div>');
          redirect('admin/profil');
        }
      }
    }
  }

  public function update_profil()
  {
    $data['profil'] = $this->db->get('profil')->row_array();
    $cek = $data['profil'];
    $nama = $this->input->post('nama');
    $nomor = $this->input->post('nomor');
    $tentang = $this->input->post('keterangan');
    $ig = $this->input->post('ig');
    $fb = $this->input->post('fb');
    $twitter = $this->input->post('twitter');
    $alamat = $this->input->post('alamat');
    $plugin = $this->input->post('plugin');

    if (empty($cek)) {
      $isi = [
        'nama_resto' => htmlspecialchars($nama, ENT_QUOTES),
        'kontak_resto' => htmlspecialchars($nomor, ENT_QUOTES),
        'tentang_resto' => htmlspecialchars($tentang, ENT_QUOTES),
        'ig' => htmlspecialchars($ig, ENT_QUOTES),
        'fb' => htmlspecialchars($fb, ENT_QUOTES),
        'twitter' => htmlspecialchars($twitter, ENT_QUOTES),
        'alamat_resto' => htmlspecialchars($alamat, ENT_QUOTES),
        'plugin_resto' => htmlspecialchars($plugin, ENT_QUOTES)
      ];
      $this->db->insert('profil', $isi);
    } else {
      $isi = [
        'nama_resto' => htmlspecialchars($nama, ENT_QUOTES),
        'kontak_resto' => htmlspecialchars($nomor, ENT_QUOTES),
        'tentang_resto' => htmlspecialchars($tentang, ENT_QUOTES),
        'ig' => htmlspecialchars($ig, ENT_QUOTES),
        'fb' => htmlspecialchars($fb, ENT_QUOTES),
        'twitter' => htmlspecialchars($twitter, ENT_QUOTES),
        'alamat_resto' => htmlspecialchars($alamat, ENT_QUOTES),
        'plugin_resto' => htmlspecialchars($plugin, ENT_QUOTES)
      ];
      $this->db->where('id', 1);
      $this->db->update('profil', $isi);
    }
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Data Profil Resto Berhasil Disimpan!</div>');
    redirect('admin/profil');
  }
  
  public function privilege()
  {
     $this->form_validation->set_rules('username', 'Username', 'required|trim');
     $this->form_validation->set_rules('password', 'Password', 'required|trim');

     $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
     if ($this->form_validation->run() == false) {
        $data['title'] = 'Privilage Access';
        $this->load->view('templates/header_login', $data);
        $this->load->view('admin/privilege');
        $this->load->view('templates/footer_login');
     } else {
        $this->laporan();
     }
  }

  public function laporan()
  {
    $password = $this->input->post('password');
    $user     = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    if(empty($password)){
        redirect('admin/privilege');
    }else{
        if (password_verify($password, $user['password'])) {
            if ($user['role_id'] == 1) {
                $data['title'] = 'Laporan';
                $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
                $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('admin/laporan');
                $this->load->view('templates/footer');
            }else{
                redirect('auth/logout');
            } 
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah !</div>');
            redirect('admin/privilege');
        }
    }
  }

  public function tes()
  {
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $data['dari'] = $dari;
    $data['sampai'] = $sampai;
    $data['lp_riwayat'] = $this->AdminModal->getRiwayat($dari, $sampai);

    $this->load->view('admin/cetak_riwayat', $data);
  }

  public function cetak_pendapatan()
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->load->library('dompdf_gen');
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $data['dari'] = $dari;
    $data['sampai'] = $sampai;
    $data['lp_pendapatan'] = $this->AdminModal->getPendapatan($dari, $sampai);
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $this->load->view('admin/cetak_pendapatan', $data);

    $dari1 = date_create($dari);
    $sampai1 = date_create($sampai);
    $r_dari = date_format($dari1, "d/m/Y");
    $r_sampai = date_format($sampai1, "d/m/Y");

    $paper_size = 'A4';
    $orientation = 'potrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("LaporanPendapatan$r_dari - $r_sampai.pdf", array('Attachment' => 0));
  }

  public function cetak_riwayat()
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->load->library('dompdf_gen');
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $data['dari'] = $dari;
    $data['sampai'] = $sampai;
    $data['lp_riwayat'] = $this->AdminModal->getRiwayat($dari, $sampai);

    $this->load->view('admin/cetak_riwayat', $data);

    $dari1 = date_create($dari);
    $sampai1 = date_create($sampai);
    $r_dari = date_format($dari1, "d/m/Y");
    $r_sampai = date_format($sampai1, "d/m/Y");

    $paper_size = 'A4';
    $orientation = 'potrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("RiwayatPesanan $r_dari - $r_sampai.pdf", array('Attachment' => 0));
  }

  public function cetak_pembelian()
  {
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $this->load->library('dompdf_gen');
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $data['dari'] = $dari;
    $data['sampai'] = $sampai;
    $data['lp_pembelian'] = $this->AdminModal->getPembelian($dari, $sampai);

    $this->load->view('admin/cetak_pembelian', $data);

    $dari1 = date_create($dari);
    $sampai1 = date_create($sampai);
    $r_dari = date_format($dari1, "d/m/Y");
    $r_sampai = date_format($sampai1, "d/m/Y");

    $paper_size = 'A4';
    $orientation = 'potrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("LaporanPembelian $r_dari - $r_sampai.pdf", array('Attachment' => 0));
  }

  public function laporan_result()
  {
    $data['title'] = 'Laporan';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $range = [
      'filter' => $this->input->post('filter'),
      'dari' => $this->input->post('dari'),
      'sampai' => $this->input->post('sampai')
    ];
    $this->session->set_userdata($range);

    if ($this->session->userdata('filter') == "1") {
      $data['lp_pendapatan'] = $this->AdminModal->getPendapatan($this->session->userdata('dari'), $this->session->userdata('sampai'));
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/laporan_result_pendapatan', $data);
      $this->load->view('templates/footer', $data);
    } elseif ($this->session->userdata('filter') == "2") {
      $data['lp_pembelian'] = $this->AdminModal->getPembelian($this->session->userdata('dari'), $this->session->userdata('sampai'));
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/laporan_result_pembelian', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $data['lp_riwayat'] = $this->AdminModal->getRiwayat($this->session->userdata('dari'), $this->session->userdata('sampai'));
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/laporan_result_riwayat', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function daftar_karyawan()
  {
    $data['title'] = 'Kelola Karyawan';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['active'] = $this->db->get('active')->result_array();
    $data['status'] = $this->db->get('karyawan_role')->result_array();
    $data['daftarKaryawan'] = $this->AdminModal->getAdmin();

    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
    $this->form_validation->set_rules('no_hp', 'No_hp', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'trim');
    $this->form_validation->set_rules('posisi', 'Posisi', 'required|trim');
    $this->form_validation->set_rules('is_active', 'Is_active', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/daftar_karyawan', $data);
      $this->load->view('templates/footer');
    } else {
      $cekusername = $this->db->get_where('karyawan', ['username' => $this->input->post('username')])->row_array();
      if ($cekusername != null) {
        $this->session->set_flashdata('message', '<div class="tutup alert alert-danger" role="alert">User <b>' . $this->input->post('username') . '</b> sudah terdaftar!</div>');
        redirect('admin/daftar_karyawan');
      }
      $tambah = [
        'nama' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'no_hp' => $this->input->post('no_hp'),
        'role_id' => $this->input->post('posisi'),
        'is_active' => $this->input->post('is_active'),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'is_active' => 1
      ];
      $this->db->insert('karyawan', $tambah);
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Karyawan <b>' . $this->input->post('nama') . '</b> berhasil ditambahkan!</div>');
      redirect('admin/daftar_karyawan');
    }
  }

  public function detail($id)
  {
    $data['detail'] = $this->AdminModal->getDetail($id);
    $pass_value = $this->input->post('password');
    if ($pass_value != null) {
      $edit = [
        'nama' => $this->input->post('nama'),
        'no_hp' => $this->input->post('no_hp'),
        'role_id' => $this->input->post('posisi'),
        'is_active' => $this->input->post('is_active'),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
      ];
      $this->db->where('id', $id);
      $this->db->update('karyawan', $edit);
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Data Karyawan <b>' . $this->input->post('nama') . '</b> Berhasil diubah!</div>');
      redirect('admin/daftar_karyawan');
    } else {
      //klo ga masukin pass (ga ganti pass)
      $edit = [
        'nama' => $this->input->post('nama'),
        'no_hp' => $this->input->post('no_hp'),
        'role_id' => $this->input->post('posisi'),
        'is_active' => $this->input->post('is_active'),
      ];
      $this->db->where('id', $id);
      $this->db->update('karyawan', $edit);
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Data Karyawan <b>' . $this->input->post('nama') . '</b> Berhasil diubah!</div>');
      redirect('admin/daftar_karyawan');
    }
  }

  public function kategori_menu()
  {
    $data['title'] = 'Kategori Menu';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['kategori'] = $this->AdminModal->getMenu();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/daftar_menu');
    $this->load->view('templates/footer');
  }

  public function edit_kategori($id)
  {
    $edit = [
      'nama_kategori' => $this->input->post('nama')
    ];
    $this->db->where('id', $id);
    $this->db->update('kategori', $edit);
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Kategori <b>' . $this->input->post('nama') . '</b> berhasil diubah!</div>');
    redirect('admin/kategori_menu');
  }

  public function tambah_kategori()
  {
    $add = [
      'nama_kategori' => $this->input->post('nama'),
      'kategori_aktif' => 1

    ];
    $this->db->insert('kategori', $add);
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Kategori <b>' . $this->input->post('nama') . '</b> Berhasil di tambahkan!</div>');
    redirect('admin/kategori_menu');
  }

  public function before_per_kategori($id)
  {
    $flag = ['id_kategori' => $id];
    $this->session->set_userdata($flag);
    redirect('admin/per_kategori');
  }

  public function per_kategori()
  {
    $data['title'] = 'Kategori Menu';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $id = $this->session->userdata('id_kategori');
    $data['kategori'] = $this->AdminModal->getKategori($id);
    $data['kategoriOnly'] = $this->AdminModal->getKategoriOnly($id);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/per_kategori');
    $this->load->view('templates/footer_addkategori', $data);
  }

  public function tambah_menu()
  {
    $data['title'] = 'Tambah Menu';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['menu'] = $this->AdminModal->menuAll();
    $data['kategori'] = $this->AdminModal->getKat();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/tambah_menu');
    $this->load->view('templates/footer', $data);
  }

  public function metodebayar()
  {
    $data['title'] = 'Metode Pembayaran';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['metode'] = $this->db->get('metode_bayar')->result_array();

    $this->form_validation->set_rules('metode', 'Metode Bayar', 'required|trim');
    $this->form_validation->set_rules('no_bayar', 'Nomor Pembayaran', 'required|trim');
    $this->form_validation->set_rules('is_active', 'Status', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/metodebayar', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $add = [
        'metode' => htmlspecialchars($this->input->post('metode'), ENT_QUOTES),
        'nomor_pembayaran' => htmlspecialchars($this->input->post('no_bayar'), ENT_QUOTES),
        'is_active' => htmlspecialchars($this->input->post('is_active'), ENT_QUOTES)
      ];
      $this->db->insert('metode_bayar', $add);
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Metode Pembayaran <b>' . $this->input->post('metode') . '</b> Berhasil ditambah!</div>');
      redirect('admin/metodebayar');
    }
  }

  public function hapus_metodebayar($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('metode_bayar');
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Menghapus Metode Bayar</div>');
    redirect('admin/metodebayar');
  }

  public function editmetodebayar($id)
  {
    $add = [
      'metode' => htmlspecialchars($this->input->post('metode'), ENT_QUOTES),
      'nomor_pembayaran' => htmlspecialchars($this->input->post('no_bayar'), ENT_QUOTES),
      'is_active' => htmlspecialchars($this->input->post('is_active'), ENT_QUOTES)
    ];
    $this->db->where('id', $id);
    $this->db->update('metode_bayar', $add);
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Mengedit Metode Bayar</div>');
    redirect('admin/metodebayar');
  }

  public function before_edit_per_kategori($id)
  {
    $flag = ['id' => $id];
    $this->session->set_userdata($flag);
    redirect('admin/edit_per_kategori');
  }

  public function edit_per_kategori()
  {
    $data['title'] = 'Kategori Menu';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $id = $this->session->userdata('id');
    $data['perKategori'] = $this->AdminModal->getPerKategori($id);
    $data['kategori'] = $this->AdminModal->getKat();

    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('kategori', 'Kategori', 'trim');
    $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('admin/edit_per_kategori');
      $this->load->view('templates/footer', $data);
    } else {
      if ($_FILES['gambar']['error'] <> 4) {
        $nmfile = strtolower(url_title($this->input->post('nama'))) . date('YmdHis');
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = '1548';
        $config['upload_path'] = './assets/img_menu/';
        $config['file_name']        = $nmfile; //nama yang terupload nantinya

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('message', '<div class="tutup alert alert-danger alert" role="alert">' . $error['error'] . '</div>');
          $this->edit_per_kategori();
        } else {
          $gambar = $this->upload->data();
          $caripath = $this->db->get_where('menu', ['id' => $id])->row_array();
          $hapusfoto = $caripath['foto'];
          if ($caripath != null) {
            unlink("./assets/img_menu/$hapusfoto");
          }

          $rp = $this->input->post('harga');
          $harga = str_replace(".", "", "$rp");

          $nama_menu = $this->input->post('nama');
          $rplc1 = str_replace("(", ": ", "$nama_menu");
          $rplc2 = str_replace(")", "", "$rplc1");
          $rplc3 = str_replace("[", ": ", "$rplc2");
          $rplc4 = str_replace(",", "", "$rplc3");
          $rplc5 = str_replace(".", "", "$rplc4");
          $nama2 = str_replace("]", "", "$rplc5");


          $edit = [
            'nama_menu' => htmlspecialchars($nama2),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_kategori' => $this->input->post('kategori'),
            'harga' => $harga,
            'foto' => $nmfile . $gambar['file_ext']
          ];
          $this->db->where('id', $id);
          $this->db->update('menu', $edit);
          $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Menu <b>' . $nama2 . '</b> Berhasil diubah!</div>');
          redirect('admin/per_kategori');
        }
      } else {
        $rp = $this->input->post('harga');
        $harga = str_replace(".", "", "$rp");

        $nama_menu = $this->input->post('nama');
        $rplc1 = str_replace("(", ": ", "$nama_menu");
        $rplc2 = str_replace(")", "", "$rplc1");
        $rplc3 = str_replace("[", ": ", "$rplc2");
        $rplc4 = str_replace(",", "", "$rplc3");
        $rplc5 = str_replace(".", "", "$rplc4");
        $nama2 = str_replace("]", "", "$rplc5");

        $edit = [
          'nama_menu' => htmlspecialchars($nama2),
          'deskripsi' => $this->input->post('deskripsi'),
          'id_kategori' => $this->input->post('kategori'),
          'harga' => $harga
        ];
        $this->db->where('id', $id);
        $this->db->update('menu', $edit);
        $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Menu <b>' . $nama2 . '</b> Berhasil diubah!</div>');
        redirect('admin/per_kategori');
      }
    }
  }

  public function hapus_per_kategori($id)
  {
    $foto = $this->db->get_where('menu', ['id' => $id])->row_array();
    $path = $foto['foto'];
    unlink('./assets/img_menu/' . $path);
    $this->db->where('id', $id);
    $this->db->delete('menu');

    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Menghapus Data Menu</div>');
    redirect('admin/per_kategori');
  }

  public function hapus_karyawan($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('karyawan');

    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Menghapus Data Karyawan</div>');
    redirect('admin/daftar_karyawan');
  }
  public function hapus_kategori($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('kategori');

    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Menghapus Kategori</div>');
    redirect('admin/kategori_menu');
  }


  public function proses_tambahmenu()
  {
    if ($_FILES['gambar']['error'] <> 4) {
      $nmfile = strtolower(url_title($this->input->post('nama'))) . date('YmdHis');
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size']     = '1548';
      $config['upload_path'] = './assets/img_menu/';
      $config['file_name']        = $nmfile; //nama yang terupload nantinya

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('message', '<div class="tutup alert alert-danger alert" role="alert">' . $error['error'] . '</div>');
        $this->per_kategori();
      } else {
        $gambar = $this->upload->data();
        $rp = $this->input->post('harga');
        $harga = str_replace(".", "", "$rp");
        $nama_menu = $this->input->post('nama');
        $rplc1 = str_replace("(", ": ", "$nama_menu");
        $rplc2 = str_replace(")", "", "$rplc1");
        $rplc3 = str_replace("[", ": ", "$rplc2");
        $rplc4 = str_replace(",", "", "$rplc3");
        $rplc5 = str_replace(".", "", "$rplc4");
        $nama2 = str_replace("]", "", "$rplc5");

        $add = [
          'nama_menu' => htmlspecialchars($nama2),
          'deskripsi' => $this->input->post('deskripsi'),
          'id_kategori' => $this->input->post('kategori'),
          'harga' => $harga,
          'foto' => $nmfile . $gambar['file_ext']
        ];
        $this->db->insert('menu', $add);
        $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil menambahkan menu ' . $nama2 . ' !</div>');
        redirect('admin/before_per_kategori/' . $this->input->post('kategori'));
      }
    }
  }
}
