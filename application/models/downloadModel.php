<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DownloadModel extends CI_Model {
  public function view(){
    return $this->db->get('keranjang')->result(); // Tampilkan semua data yang ada di tabel siswa
  }
}
