<?php


class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('articles_model');
        $this->load->model('blogers_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url_helper');
    }

    public function create()
    {
        foreach ($this->session->__get('user') as $item => $value){
            if($item == 'login'){
                $data['user'] = $value;
            } elseif ($item == 'id'){
                $b_id = $value;
            }
        }

        if($this->blogers_model->is_logged_in() == false){
            redirect('blogers/login');
        }

        $config = [
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required'
            ],
            [
                'field' => 'text',
                'label' => 'Text',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){

            $this->load->view('templates/header');
            $this->load->view('articles/create', $data);
            $this->load->view('templates/footer');
        }
        else {
            $this->articles_model->create($b_id);

            $this->load->view('templates/header');
            $this->load->view('articles/success');
            $this->load->view('templates/footer');
        }
    }
}