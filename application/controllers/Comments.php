<?php

class Comments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comments_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper('url');
    }
    public function create($article_id)
    {
        foreach ($this->session->__get('user') as $item => $value){
            if ($item == 'id'){
                $author = $value;
            }
        }

        $this->form_validation->set_rules('text', 'Text', 'required');

        if($this->form_validation->run() === TRUE){
            if ($this->comments_model->create($author, $article_id) == TRUE){
                redirect('articles/viewOne/' . $article_id);
            } else{
                return false;
            }
        }
        redirect('articles/viewOne/' . $article_id);
    }
    public function read($article)
    {
        $data = $this->comments_model->get_by_article($article);
        var_dump($data);

        //$this->load->view('comments/view', $data);
    }
}