<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class menu_model extends CI_Model
{
	public function getsubmenu()
	{
		$query= "SELECT `user_sub_menu`.*, `user_menu`.`menu`
				 FROM `user_sub_menu`JOIN `user_menu`
				 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
				";
		return $this->db->query($query)->result_array();
				
	}

	function addvendor()
	{
		$query="SELECT `vendor`.*, `vendor_list`.`Vendor`
				FROM `vendor` JOIN `vendor_list`
				ON `vendor`.`Id_vendor_list`=`vendor_list`.Id_Vendor_List`
		";
		return $this->db->query($query)->result_array();
	}

	public function hapus_vendor($id_vendor)
	{
		$this->db->where('id_vendor', $id_vendor);
		$this->db->delete('vendor');
	}

	public function edit_vendor()
	{
			$nama=$this->input->post('nama');
			$alamat=$this->input->post('alamat');
			$kp=$this->input->post('kp');
			$ka=$this->input->post('ka');
			$owner=$this->input->post('owner');
			$phone=$this->input->post('phone');


			//cek jika ada gambar
			$upload=$_FILES['image']['name'];
			
			if($upload)
			{
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				$config['upload_path'] = './assets/img/photo/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image'))
				{
					$old_image=$data['user']['photo'];
					if ($old_image != 'default.png')
					{
						unlink(FCPATH . 'assets/img/img/' . $old_image);
					}


					$new_image=$this->upload->data('file_name');
					$this->db->set('photo',$new_image);

				}
				else
				{
					echo $this->upload->display_error();
				}

			}
			$data=[
					"nama_vendor" => $this->input->post('nama'),
					"alamat" => $this->input->post('alamat'),
					"kode_pos" => $this->input->post('kp'),
					"kode_area" => $this->input->post('ka'),
					"nama_kontak" => $this->input->post('owner'),
					"nomor_kontak" => $this->input->post('phone')
			];

			$this->db->where('id_vendor', $this->input->post('id'));
			$this->db->update('vendor', $data);
	}



	
}

