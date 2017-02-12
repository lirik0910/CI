<?php


class Countries_model extends CI_Model
{
    private $table = 'country';

    public function __construct()
    {
        $this->load->database();
    }
    public function get_names()
    {
        $this->db->select('name, code');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}