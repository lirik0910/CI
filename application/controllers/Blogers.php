<?php

class Blogers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blogers_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');

    }

    public function registration()
    {
        $this->load->helper(array ('form', 'cookie'));
        $this->load->model('countries_model');
        //$this->load->library('form_validation');

        //var_dump($this->blogers_model->is_logged_in()); die;
        if($this->blogers_model->is_logged_in() == true){
            redirect('pages/view');
        }

        $data['countries'] = $this->countries_model->get_names();

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
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[blogers.email]'
            ],
            [
                'field' => 'age',
                'label' => 'Age',
                'rules' => 'required'
            ],
            [
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ],
            [
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){

            $this->load->view('templates/header');
            $this->load->view('blogers/registration', $data);
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
        redirect('pages/view');
    }
    public function update($login)
    {
        $this->load->helper('email');
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->model(['cities_model', 'countries_model']);

        if($this->blogers_model->is_logged_in() == false){
            redirect('pages/view');
        }

        $data = $this->blogers_model->get_by_login($login);
        $data['countries'] = $this->countries_model->get_names();
        //$data['cities'] = $this->cities_model->get_names();

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
                'field' => 'age',
                'label' => 'Age',
                'rules' => 'required',
            ],
            [
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ],
            [
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){

            $this->load->view('templates/header');
            $this->load->view('blogers/update', $data);
            $this->load->view('templates/footer');
        } else {
            //var_dump($this->input->post('age')); die;
            $this->blogers_model->update($data['id']);

            $this->load->view('templates/header');
            $this->load->view('blogers/success');
            $this->load->view('templates/footer');
        }
    }
}