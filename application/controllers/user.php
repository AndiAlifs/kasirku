<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $this->model_squrity->get_squrity();
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
        $user_id = $this->input->post('user_id');

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
        var_dump($this->upload->do_upload('image'));

        // save uploaded file name to database for current user
        $this->m_user->update_photo($user_id, $photo);

        return redirect('user');
    }
}
