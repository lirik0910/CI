<?php

class Articles_model extends CI_Model
{
    public $title;
    public $text;
    public $date;
    public $rating;
    public $likes;
    public $dislikes;
    public $views;
    private $table;

    public function __construct()
    {
        $this->load->database();
        $this->date = $this->load->helper('date');
        $this->table = 'articles';
    }
    public function create($b_id)
    {
        $this->load->helper(['url', 'date']);

        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $date = mdate('%Y-%m-%d %h:%i:%s');

        $data = [
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'date' => $date,
            'bloger_id' => $b_id,
            'slug' => $slug
        ];

        return $this->db->insert($this->table, $data);
    }
    public function get_articles($b_id = NULL)
    {
        //$this->load->helper('url');
        $this->db->order_by('date', 'DESC');
        if ($b_id === FALSE)
        {
            $query = $this->db->get($this->table);
            return $query->result_array();
        }
        $this->db->limit(5);
        $query = $this->db->get_where($this->table, ['bloger_id' => $b_id]);
        return $query->result_array();
    }
    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, ['id' => $id]);
        return $query->row_array();
    }
    public function update($id)
    {
        $date = mdate('%Y-%m-%d %h:%i:%s');

        $data = [
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'last_update' => $date,
        ];

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    public function delete($id)
    {
       return $this->db->delete($this->table, ['id' =>$id]);
    }
    public function last_query()
    {
        return $this->db->last_query();
        //var_dump($result);
    }
}