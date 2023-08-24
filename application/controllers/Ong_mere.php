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

        public function index($error="No error"){
            $er=$this->input->get("error");
            if($er!=null){$error=$er;}
            $region = $this->Ong_mere_model->getTableValue("Region","des_region",$this->suggest('region'));
            $District = $this->Ong_mere_model->getTableValue("District","des_fiv",$this->suggest('district'));
            $fokotany = $this->Ong_mere_model->getTableValue("Fokotany","Fokotany_anarany",$this->suggest('fokotany'));
            $situationMatrimoniale = $this->Ong_mere_model->select('SituationMatrimoniale');
            $values["values"]=array("error"=>$error,"region"=>$region, "district"=>$District, "fokotany"=>$fokotany, 'situationMatrimoniale'=>$situationMatrimoniale);
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
            $this->load->helper("function");
            $name=array('denomination','dateDeCreation','nationaliteONG','numeroEnregistrement'
            ,'objectifStatuaire','domaineActivite','effectifMembres','modeDonationFinanciere'
            ,'organigramme');
            $data=namepost($name);
            $president=getDataIndividu(0);
            $representant=getDataIndividu(1);
            $errorPresident=getErrorIndividu(0); $errorRepresentant=getErrorIndividu(1);
            $paysIntervenants = $this->input->post('Autres_pays_d_intervention');
            $error=fusion(emptyTable($data, $name), getErrorDate($data,$name));
            $error=fusion($error,$errorPresident); $error=fusion($error,$errorRepresentant);
            $error=implode("¨",$error);echo $error;
            ini_set('display_errors', '0');
            
            
            if(!$error){
                $this->db->trans_begin();
                
                $this->Ong_mere_model->insert('ONGMere', $data);
                $idlastONG = $this->Ong_mere_model->getLast('ONGMere')['idONGMere'];
                $president['idONGMere'] = $idlastONG;
                $representant['idONGMere'] = $idlastONG;

                $president["idONGMere"]=$idlastONG;
                $this->Ong_mere_model->insert('Individu', $president);
                $idlastPresident = $this->Ong_mere_model->getLast('Individu')['idIndividu'];

                $representant["idONGMere"]=$idlastONG;
                $this->Ong_mere_model->insert('Individu', $representant);
                $idlastRepresentant = $this->Ong_mere_model->getLast('Individu')['idIndividu'];

                $this->insertIndividuRole($idlastONG, $idlastPresident, $idlastRepresentant);

                $this->db->trans_complete();
            }
            else{redirect(site_url("Ong_mere/index?error=$error"));exit;}
        }

        public function insertIndividuRole($lastONG, $idP, $idR){
            // insert individi role president
            $individuRole0['idIndividu'] = $idP;
            $individuRole0['idONGMere'] = $lastONG;
            $individuRole0['fonction'] = 0;
            $this->Ong_mere_model->insert('IndividuRole', $individuRole0);

            // insert individu role representant
            $individuRole1['idIndividu'] = $idR;
            $individuRole1['idONGMere'] = $lastONG;
            $individuRole1['fonction'] = 1;
            $this->Ong_mere_model->insert('IndividuRole', $individuRole1);
        }
    }
?>
