<?php


class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('articles_model');
    }

    public function create()
    {
        $data['date'] = $this->articles_model->get_one();
        var_dump($data['date']);

        $this->load->view('templates/header', $data);
        $this->load->view('articles/create', $data);
        $this->load->view('templates/footer', $data);
    }
}