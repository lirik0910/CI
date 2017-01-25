<?php

class Blogers_model extends CI_Model
{
    public $table = 'blogers';
    public $max_idle_time = 300;
    public $data = [];

    public function __construct()
    {
        $this->load->database();
    }

    public function create()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('login'), 'dash', TRUE);

        $data = [
            'firstname' => $this->input->post('firstname'),
            'secondname' => $this->input->post('secondname'),
            'login' => $this->input->post('login'),
            'password' => $this->input->post('password'),
            'slug' => $slug
        ];

        return $this->db->insert('blogers', $data);
    }

    public function get_by_login($login)
    {
        $query = $this->db->get_where($this->table, ['login' => $login], 1);
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return false;
    }

    public function allow_pass($user_data)
    {
        $this->session->set_userdata(['last_activity' => time(), 'logged_in' => 'yes', 'user' => $user_data]);
    }

    public function remove_pass()
    {
        $array_items = ['last_activity', 'logged_in', 'user'];
        $this->session->unset_userdata($array_items);
    }

    public function is_logged_in()
    {
        $last_activity = $this->session->userdata('last_activity');
        $logged_in = $this->session->userdata('logged_in');
        $user = $this->session->userdata('user');

        if($logged_in == 'yes'){
            $this->allow_pass($user);
            return true;
        } else {
            $this->remove_pass();
            return false;
        }

    }
}