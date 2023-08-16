<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ong_mere extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->database("mysql");
            $this->load->helper("url");
            $this->load->model("Ong_mere_model");
        }

        public function index(){
            $region = $this->Ong_mere_model->getTableValue("Region","des_region",$this->suggest('region'));
            $District = $this->Ong_mere_model->getTableValue("District","des_fiv",$this->suggest('district'));
            $fokotany = $this->Ong_mere_model->getTableValue("Fokotany","Fokotany_anarany",$this->suggest('fokotany'));
            $situationMatrimoniale = $this->Ong_mere_model->select('SituationMatrimoniale');
            $values["values"]=array("region"=>$region, "district"=>$District, "fokotany"=>$fokotany, 'situationMatrimoniale'=>$situationMatrimoniale);
            $this->load->view("Nouvelle_ONG", $values);
        }
        public function suggestCountry(){
            $countrySuggestion =  $_POST["query"];

            if(empty($countrySuggestion)){
                $countrySuggestion = "ppp";
            }

            // Perform a database query to fetch the suggestions based on the query
            // Replace this with your own database query logic
            $suggestions = $this->Ong_mere_model->getSuggestions($countrySuggestion);

            // Send the suggestions back to the client as JSON
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(['suggestions' => $suggestions]));
        }
        
        
        public function suggest($postName){
            $valiny=$this->input->post($postName);
            if($valiny==""){return "pppp";}
            return $valiny;
        }

        public function insertPaysinterventions($idlastONG, $pays){
            $data['idONGMere'] = $idlastONG;
            foreach($pays as $intervenants){
                $data['nom'] = $intervenants;
                $this->Ong_mere_model->insert('PaysInterventions', $data);
            }
        }

        public function inserereOngMere(){

            $data['denomination'] = $this->input->post('denomination');
            $data['dateDeCreation'] = $this->input->post('dateDeCreation');
            $data['nationalite'] = $this->input->post('nationalite');
            $data['numeroEnregistrement'] = $this->input->post('numeroEnregistrement');
            $data['objectifStatuaire'] = $this->input->post('objectifStatuaire');
            $data['domaineActivite'] = $this->input->post('domaineActivite');
            $data['effectifMembres'] = $this->input->post('effectifMembres');
            $data['modeDonationFinanciere'] = $this->input->post('modeDonationFinanciere');
            $data['organigramme'] = $this->input->post('organigramme');

            $paysIntervenants = $this->input->post('Autres_pays_d_intervention');

            // $this->load->database("mysql");

            $this->db->trans_begin();
            
            $this->Ong_mere_model->insert('ONGMere', $data);
            $idlastONG = $this->Ong_mere_model->getLast('ONGMere')['idONGMere'];
            $this->insertPaysinterventions($idlastONG, $paysIntervenants);

            redirect(site_url('Ong_mere/presidentForm/'.$idlastONG));
        }

        public function presidentForm($idOngMere){
            $idlastONG = $this->Ong_mere_model->getLast('ONGMere')['idONGMere'];
            $data['lastong'] = $idlastONG;
            $data['fonctionString'] = ['President et representant', 'President'];
            $data['fonction'] = [21, 11];
            $data['situationMatrimoniale'] = $this->Ong_mere_model->select('SituationMatrimoniale');
            $data['idONGMere'] = $idOngMere;
            $this->load->view("Menu");
            $this->load->view('Individu', $data);
        }

        public function insereIndividu(){
            $data['idONGMere'] = $this->input->post('idONGMere');
            $data['nom'] = $this->input->post('nom');
            $data['prenom'] = $this->input->post('prenom');
            $data['dateDeNaissance'] = $this->input->post('dateDeNaissance');
            $data['lieuNaissance'] = $this->input->post('lieuNaissance');
            $data['nationalite'] = $this->input->post('nationalite');
            $data['idSituationMatrimoniale'] = $this->input->post('idSituationMatrimoniale');
            $data['adressePersonelle '] = $this->input->post('adressePersonelle');
            $data['emploi'] = $this->input->post('emploi');
            $data['societeEmployeur'] = $this->input->post('societeEmployeur');
            $data['adresseEmployeur '] = $this->input->post('adresseEmployeur');
            $data['experienceHumanitaire'] = $this->input->post('experienceHumanitaire');
            $data['telephone'] = $this->input->post('telephone');
            $data['mail'] = $this->input->post('mail');

            // $idlastONG = $this->Ong_mere_model->getLast('ONGMere')['idONGMere'];
            // echo $idlastONG;
            echo $data['idONGMere'];

            
            $this->Ong_mere_model->insert('Individu', $data);

            // $individuRole['idIndividu'] = $this->Ong_mere_model->getLast('Individu')['idIndividu'];
            // echo $individuRole['idIndividu'];
            // $individuRole['fonction'] = $this->input->post('role');
            // $individuRole['idONGMere'] = $this->input->post('idONGMere');

            // $this->Ong_mere_model->insert('IndividuRole', $individuRole);
            
            $this->db->trans_commit();

        }
    }
?>
