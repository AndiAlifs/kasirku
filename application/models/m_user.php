<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

	function input_barang($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function user($username)
	{
		$hasil = $this->db->query("SELECT * FROM user where username = '$username'")->row();
		return $hasil;
	}

	public function get_photo($user_id)
    {
        $this->db->select('image');

        return $this->db->get_where('user', ['id_user' => $user_id])->row();
    }

	public function update_photo($user_id, $photo)
    {
        $this->db->update('user', ['image' => $photo], ['id_user' => $user_id]);
    }

}
