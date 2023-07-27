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
            $data["Countries"] = $this->Ong_mere_model->getSuggestions("Mada");
            // $this->load->view("Menu");
            // $this->load->view("Nouvelle_ONG", $data);
            $region = $this->Ong_mere_model->getTableValue("Region","des_region",$this->suggest('region'));
            $District = $this->Ong_mere_model->getTableValue("District","des_fiv",$this->suggest('district'));
            $values["values"]=array("region"=>$region, "district"=>$District);
            $this->load->view("Objectif_ONG", $values);
        }

        public function suggest($postName){
            $valiny=$this->input->post($postName);
            if($valiny==""){return "sdjfhskdjfh";}
            return $valiny;
        }
    }
?>
