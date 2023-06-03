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
            $data["Countries"] = json_encode($this->Ong_mere_model->getCountries());
            $this->load->view("Menu");
            $this->load->view("Nouvelle_ONG", $data);
        }

        public function suggestCountry(){
            $countrySuggestion =  $_POST["query"];

            // Perform a database query to fetch the suggestions based on the query
            // Replace this with your own database query logic
            $suggestions = $this->Ong_mere_model->getSuggestions($countrySuggestion);

            // Send the suggestions back to the client as JSON
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(['suggestions' => $suggestions]));
        }
    }
?>