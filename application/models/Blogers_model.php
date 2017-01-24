<?php

class Blogers_model extends CI_Model
{
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
}