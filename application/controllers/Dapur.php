<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dapur extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    // cek_login();
    $this->load->model('DapurModal');

    $who = $this->session->userdata('role_id');
    if ($who != 3 and $who != 1 and $who != 4) {
      redirect('auth/nakal');
    }
  }


  public function index()
  {
    $data['title'] = 'Daftar Pesanan';
    $data['profil'] = $this->db->get_where('profil', ['id' => 1])->row_array();
    $data['saya_karyawan'] = $this->db->get_where('karyawan', ['id' => $this->session->userdata('id_karyawan')])->row_array();
    $data['listPesanan'] = $this->DapurModal->getDapur()->result_array();
    $data['menunggu'] = $this->DapurModal->getTotalPesanan()->row_array();
    $data['pilihan'] = $this->db->get('status2')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dapur/pesanan_masuk', $data);
    $this->load->view('templates/footer');
  }

  public function proses_selesai($id)
  {
    $this->db->set('status', 1);
    $this->db->where('id', $id);
    $this->db->update('detail_pesanan');

    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Proses selesai !</div>');
    redirect('dapur');
  }

  public function proses_pesananluar($id)
  {
    $id_s = 1;
    $this->db->set('id_status2', $id_s);
    $this->db->where('id', $id);
    $this->db->update('pesanan');
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Mengubah Status</div>');
    redirect('kasir/pesanan_luar');
  }

  public function batalkan_pesananluar($id)
  {
    $id_s = 5;
    $this->db->set('id_status2', $id_s);
    $this->db->where('id', $id);
    $this->db->update('pesanan');
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Mengubah Status</div>');
    redirect('kasir/pesanan_luar');
  }

  public function proses_belum($id)
  {

    $this->db->set('status', 0);
    $this->db->where('id', $id);
    $this->db->update('detail_pesanan');

    $this->session->set_flashdata('message', '<div class="tutup alert alert-danger" role="alert">Proses belum selesai!</div>');
    redirect('dapur');
  }

  public function selesai($id)
  {
    $cekDulu = $this->db->query("SELECT * FROM detail_pesanan WHERE id_pesanan =$id and status='0'")->row_array();
    if ($cekDulu != null) {
      $this->session->set_flashdata('message', '<div class="tutup alert alert-danger" role="alert">Pesanan No: K' . $id . ' belum lengkap! Periksa lagi Chef..</div>');
      redirect('dapur');
    } else {
      $id_s = 3;
      $this->db->set('id_status2', $id_s);
      $this->db->where('id', $id);
      $this->db->update('pesanan');
      $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Mengubah Status</div>');
      redirect('dapur/index');
    }
  }

  public function prosesmasak($id)
  {
    $id_s = 2;
    $this->db->set('id_status2', $id_s);
    $this->db->where('id', $id);
    $this->db->update('pesanan');
    $this->session->set_flashdata('message', '<div class="tutup alert alert-success" role="alert">Berhasil Mengubah Status</div>');
    redirect('dapur/index');
  }
}
