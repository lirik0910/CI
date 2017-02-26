<?php

class Comments_model extends CI_Model
{
    private $table = 'comments';

    public function __construct()
    {
        $this->load->database();
    }
    public function create($author, $article)
    {
        $this->load->helper('date');

        $date = mdate('%Y-%m-%d %h:%i:%s');

        $data = [
            'text' => $this->input->post('text'),
            'date' => $date,
            'article' => $article,
            'author' => $author
        ];

        return $this->db->insert($this->table, $data);
    }
    public function get_by_article($article)
    {
        $this->db->select('comments.id, comments.text, comments.date, blogers.login');
        $this->db->from($this->table);
        $this->db->where('article', $article);
        //$this->db->select('login');
        $this->db->join('blogers', 'comments.author = blogers.id');

        //$this->db->get_where($this->table, ['article' => $article]);
        $query = $this->db->get();
        return $query->result_array();

    }
}