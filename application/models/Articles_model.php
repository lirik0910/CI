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

    public function __construct()
    {
        $this->load->database();
        $this->date = $this->load->helper('date');
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

        return $this->db->insert('articles', $data);
    }
    public function get_articles($b_id = NULL)
    {
        $this->load->helper('url');

        if ($b_id === FALSE)
        {
            $query = $this->db->get('articles');
            return $query->result_array();
        }
        $query = $this->db->get_where('articles', ['bloger_id' => $b_id]);
        return $query->row_array();
    }
}