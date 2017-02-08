<?php

class Blogers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blogers_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
    }

    public function registration()
    {
        $this->load->helper(array ('form', 'cookie'));
        //$this->load->library('form_validation');

        //var_dump($this->blogers_model->is_logged_in()); die;
        if($this->blogers_model->is_logged_in() == true){
            redirect('pages/view');
        }

        $config = [
            [
                'field' => 'firstname',
                'label' => 'Firstname',
                'rules' => 'required'
            ],
            [
                'field' => 'secondname',
                'label' => 'Secondname',
                'rules' => 'required'
            ],
            [
                'field' => 'login',
                'label' => 'Login',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[blogers.login]'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'You must provide a %s.',
                    'is_unique' => 'This %s already exists.'

                ]
            ],
            [
                'field' => 'passconf',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){

            $this->load->view('templates/header');
            $this->load->view('blogers/registration');
            $this->load->view('templates/footer');
        }

        else {
            $this->blogers_model->create();

            $this->load->view('templates/header');
            $this->load->view('blogers/success');
            $this->load->view('templates/footer');
        }
    }
    public function login()
    {
        $this->load->helper('form');

        if($this->blogers_model->is_logged_in() == true){
            redirect('pages/view');
        }

        $this->form_validation->set_rules('login', 'Login', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()){
            $login = $this->input->post('login');
            $password = $this->input->post('password');

            if($user = $this->blogers_model->get_by_login($login)){
                if($user['password'] == $password){
                    $this->blogers_model->allow_pass($user);
                    redirect('pages/view');
                }
            }
        }

        $this->load->view('templates/header');
        $this->load->view('blogers/login');
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $this->blogers_model->remove_pass();
        redirect('blogers/login');
    }
}