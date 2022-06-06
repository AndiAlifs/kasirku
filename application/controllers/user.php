<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $this->model_squrity->get_squrity();
		$this->load->model('m_user');
        $data['user'] = $this->m_user->user($this->session->username);
        $this->load->view('user', $data);
    }

    function __construct()
    {
        parent::__construct();
        $this->model_squrity->get_squrity();
        $this->load->model('m_user');
        $this->load->helper('url');
    }

    function update()
    {
        $user_id = $this->input->post('id_user');

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 2024;
        $config['max_height']           = 1680;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // delete existing file if it exists
        $existing_photo = $this->m_user->get_photo($user_id)->image;
        if ($existing_photo && file_exists("./uploads/{$existing_photo}")) {
            unlink("./uploads/{$existing_photo}");
        }

        // "photo" is the name of input element in uploading form
        if (!$this->upload->do_upload('image')) {
            // save uploading errors to show them on the page
            $this->upload_errors = $this->upload->display_errors();
            var_dump($this->upload_errors);
            var_dump($config);
        }

        // get file name from uploaded data
        $photo = $this->upload->data()['file_name'];

        // save uploaded file name to database for current user
        $this->m_user->update_photo($user_id, $photo);

        return redirect('pegawai');
    }

    function tambah_proses(){
        $id_user = $this->input->post('id_user'); 
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$dataname['image']='';
		$filename = $_FILES['image']['name'];
		// var_dump($file);die;

		$config['upload_path']		= './uploads/';
		$config['allowed_types']	= 'jpg|png|gif|jpeg';

		$this->load->library('upload', $config);
		// $this->upload->initialize($config); digunakan jika autoload upload aktif, cek modul autoload.php

		$file = $this->upload->data('image');
		if (!$file) 
		{
			echo 'Gambar gagal di upload !';
			echo $this->upload->display_errors();
			// die;
		} else{
			$dataname['file'] = $file;
			// var_dump($filename);die;
		}
 
 
		$data = array(
            'id_user' => $id_user,
			'username' => $username,
			'password' => $password,
			'nama' => $nama,
			'image' => $filename
		);

		$this->m_user->input_data($data);
		redirect('pegawai');
	}

	public function hapus(){
        $this->m_user->hapusData($this->input->get('id'));
        redirect('pegawai');  
    }

	public function edit(){
        $data['pegawai'] = $this->m_user->get_data($this->input->get('id'));
        $this->load->view('pegawai', $data);
    }
}
