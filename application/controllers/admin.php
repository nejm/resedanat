<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function index()
    {
        $data=[];
        if(isset($_SESSION['id'])) {
            redirect("admin/dashboard");
            return;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login','Nom d\'utilisateur','trim|required');
        $this->form_validation->set_rules('pass','Mot de passe','trim|required');

        if($this->form_validation->run() !== false)
        {
            if(isset($_SESSION['id']))
            {
                redirect('admin/dashboard');
            }
            $this->load->model('admin_model');
            $res = $this
                        ->admin_model
                        ->verify(
                                $this->input->post('login'),
                                $this->input->post('pass')
                                );
            if($res !== false)
            {
                $_SESSION['id']="1";
                $_SESSION['name']=$this->input->post('login');
                redirect('admin/dashboard');
            }else
            {
                $data['msg']="<div class='alert alert-danger'>
                <a class='close'' data-dismiss='alert'>×</a>
                <strong>Error !</strong>
                Login ou mot de passe invalide</div>";
            }
        }
        $this->load->view("login",$data);
    }

    function dashboard()
    {
        if(!isset($_SESSION['name'])) redirect('admin/');

        $this->load->view("dashboardheader");
        $this->load->view("dashboard");
        $this->load->view("dashboardfooter");
    }

    function ajout()
    {
        if(!isset($_SESSION['name'])) redirect('admin/');
        $data['nom']=$_SESSION['name'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('titre','Titre','trim|required');
        $this->form_validation->set_rules('alias','Alias','trim|required');
        $this->form_validation->set_rules('contenu','Contenu','trim|required');


        if($this->form_validation->run() !== false)
        {
            var_dump($_SESSION['id']);
            $this->load->model('article_model');
            $this
                ->article_model
                ->ajout(array(
                    'titre'  => $this->input->post('titre'),
                    'contenu'=> $this->input->post('contenu'),
                    'alias'  => $this->input->post('alias'),
                    'etat'   => $this->input->post('pb'),
                    'par'    => $_SESSION['id']
                ));
            redirect('admin/dashboard');
            die();
        }
        $this->load->view("dashboardheader");
        $this->load->view('ajout_article',$data);
        $this->load->view("dashboardfooter");
    }

    function modifier($x=0)
    {
        $data=[];
        if($x===0)
        {
            $this->load->model("article_model");
            $articles = $this->article_model->getAll();
            $data['articles']=$articles;

            $this->load->view("dashboardheader");
            $this->load->view("liste_article",$data);
            $this->load->view("dashboardfooter");
        }
    }

    function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        $this->session->set_flashdata('success', 'Vous êtes désormais déconnecté(e).');
        session_destroy();
        redirect(base_url('admin'), 'refresh');
    }

} 