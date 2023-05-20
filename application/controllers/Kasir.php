<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    // cek_login();
    $this->load->model('KasirModal');

    $who = $this->session->userdata('role_id');
    if ($who != 4 and $who != 1) {
      redirect('auth/nakal');
    }
  }

  public function index()
  {
    $data['title'] = 'Pembayaran';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['listPesanan'] = $this->KasirModal->getkasirNow()->result_array();
    $data['pilihan2'] = $this->db->get('status')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kasir/pembayaran', $data);
    $this->load->view('templates/footer', $data);
  }
  
  public function delete_struk($id)
  {
    $this->KasirModal->delete_struk($id);
    echo json_encode(array("status" => TRUE));
  }

  public function pesanan_luar()
  {
    $data['title'] = 'Pembayaran';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['listPesananLuar'] = $this->KasirModal->getPesananLuar()->result_array();
    $data['pilihan2'] = $this->db->get('status')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kasir/pesanan_luar', $data);
    $this->load->view('templates/footer', $data);
  }

  public function konfirmasi($id)
  {
    $data['title'] = 'Konfirmasi Pembayaran';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $karyawan = $data['saya_karyawan']['nama'];
    $data['listPesanan'] = $this->KasirModal->getDetail($id)->result_array();
    $data['Pesanan'] = $this->KasirModal->getPesanan($id)->row_array();
    $data['metode'] = $this->db->get_where('metode_bayar', ['is_active' => 1])->result_array();

    $this->form_validation->set_rules('jumlahbayar', 'Jumlah Bayar', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('kasir/konfirmasi', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $a = htmlspecialchars($this->input->post('jumlahbayar'), ENT_QUOTES);
      $b = htmlspecialchars($this->input->post('diskon'), ENT_QUOTES);
      $c = $this->input->post('ppn');
      $s = $this->input->post('service');
      $d = htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES);
      $metodebayar = htmlspecialchars($this->input->post('metode'), ENT_QUOTES);
      $e = $this->input->post('kembalian');

      $bayar = str_replace(".", "", "$a");
      $diskon = str_replace(".", "", "$b");

      $ppn = str_replace(",00", "", "$c");
      $change_ppn = preg_replace("/[^0-9]/", "", $ppn);
      
      $service = str_replace(",00", "", "$s");
      $change_service = preg_replace("/[^0-9]/", "", $service);

      $kembalian = str_replace(",00", "", "$e");
      $change_kembalian = preg_replace("/[^0-9]/", "", $kembalian);

      if ($kembalian < 0) {
        $this->session->set_flashdata('message', '<div class="tutup alert alert-danger" role="alert">Jumlah uang bayar tidak mencukupi!</div>');
        redirect('kasir/konfirmasi/' . $id);
      } else {
        $update = [
          'id_status' => 3,
          'kasir' => $karyawan,
          'diskon' => $diskon,
          'ppn' => $change_ppn,
          'service' => $change_service,
          'keterangan_diskon' => $d,
          'jumlah_bayar' => $bayar,
          'kembalian' => $change_kembalian,
          'metode_bayar' => $metodebayar
        ];
        $this->db->where('id', $id);
        $this->db->update('pesanan', $update);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran Lunas</div>');
        redirect('kasir/konfirmasi/' . $id);
      }
    }
  }

  public function riwayat()
  {
    $data['title'] = 'Riwayat Pembayaran';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['listPesanan'] = $this->KasirModal->getkasirDone()->result_array();
    $data['lp_riwayat'] = $this->KasirModal->getRiwayat();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('kasir/riwayat', $data);
    $this->load->view('templates/footer', $data);
  }
  public function cek_kembalian()
  {
    $this->form_validation->set_rules('cek', 'Cek', 'required|trim');
    if ($this->form_validation->run() == false) {
      redirect('detail_ks');
    } else {
    }
  }
}
