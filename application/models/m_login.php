<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    public function get_login($user)
    {
        $query = $this->db->get_where('user',[
            'username' => $user
        ]);
        return $query->result();
    }
}