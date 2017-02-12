<?php


class Cities_model extends CI_Model
{
    private $table = 'city';

    public function __construct()
    {
        $this->load->database();
    }
    public function get_names()
    {
        $this->db->select('name', 'countrycode');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}