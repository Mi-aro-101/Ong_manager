<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ong_mere extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->helper("url");
            $this->load->model("Ong_mere_model");
        }

        public function index(){
            $this->load->view("Menu");
            $this->load->view("Nouveau_ONG");
        }
    }
?>