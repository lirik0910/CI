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
    public function get_one()
    {
        echo '+1';
    }
}