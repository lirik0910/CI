<?php

class Blogers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blogers_model');
        $this->load->helper('url_helper');
    }

    public function create()
    {
        $this->load->helper(array ('form', 'cookie'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'firstname',
                'label' => 'Firstname',
                'rules' => 'required'
            ),
            array(
                'field' => 'secondname',
                'label' => 'Secondname',
                'rules' => 'required'
            ),
            array(
                'field' => 'login',
                'label' => 'Login',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[blogers.login]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                    'is_unique' => 'This %s already exists.'

                )
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){

            $this->load->view('templates/header');
            $this->load->view('blogers/create');
            $this->load->view('templates/footer');
        }

        else {

            $this->blogers_model->create();
            set_cookie('login', $this->blogers_model->data['login']);

            $cookie = $this->blogers_model->data['cookie'] = get_cookie('login');

            if($cookie !== NULL){

                var_dump($cookie);

                $this->load->view('templates/header');
                $this->load->view('blogers/success');
                $this->load->view('templates/footer');
            }

            $this->load->view('templates/header');
            $this->load->view('blogers/success');
            $this->load->view('templates/footer');
        }


    }
}