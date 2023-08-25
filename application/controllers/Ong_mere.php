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
            $District = $this->Ong_mere_model->getTableValue("District","des_district",$this->suggest('district'));
            $fokotany = $this->Ong_mere_model->getTableValue("Fokontany","des_fokotany",$this->suggest('fokotany'));
            $province = $this->Ong_mere_model->getTableValue("Province","des_province",$this->suggest('province'));
            $commune = $this->Ong_mere_model->getTableValue("Commune","des_commune",$this->suggest('commune'));
            $situationMatrimoniale = $this->Ong_mere_model->select('SituationMatrimoniale');
            $values["values"]=array(
                "error"=>$error,
                "region"=>$region, 
                "district"=>$District, 
                "fokotany"=>$fokotany, 
                'situationMatrimoniale'=>$situationMatrimoniale,
                "province"=>$province,
                "commune" =>$commune
            );
            $this->load->view("Nouvelle_ONG", $values);
        }

        /**
         * Function that take the input and get in the model if any in db correspond the input then return the corresponding
         */
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

        /**
         * Same as below
         */
        public function suggest($postName){
            $valiny=$this->input->post($postName);
            if($valiny==""){return "pppp";}
            return $valiny;
        }

        /**
         * As PaysIntervention is another table we need to get all of them in the view to insert to the db
         * @param integer $idLastONG
         * @param array $pays all the pays got from input
         */
        public function insertPaysinterventions($idlastONG, $pays){
            $data['idONGMere'] = $idlastONG;
            foreach($pays as $intervenants){
                $data['nom'] = $intervenants;
                $this->Ong_mere_model->insert('PaysInterventions', $data);
            }
        }

        /**
         * Insertion moyen humains ou materiel
         * @param array $ressource is the array of data
         * @param integer $idLastProjet
         * @param string $designation design it is a humain ou materiel moyen
         */
        public function insertmoyen($ressource, $idLastProjet, $designation){
            $data['idProjet'] = $idLastProjet;
            foreach($ressource as $moyen){
                $data['designation'.$designation] = $moyen;
                $this->Ong_mere_model->insert('moyen'.$designation, $data);
            }
        }

        /**
         * Called after submit of the form
         */
        public function inserereOngMere(){
            $this->load->helper("function");
            $name=array('denomination','dateDeCreation','nationaliteONG','numeroEnregistrement'
            ,'objectifStatuaire','domaineActivite','effectifMembres','modeDonationFinanciere'
            ,'organigramme');
            $obj=array('titre','objectifPrincipal','objectifSpecifique','activite','resultatAttendu', 'province', 'region'
            ,'district','fokotany', 'commune', 'populationBeneficiaire','coutEstimatif','sourceDefinancement');
            $data=namepost($name);
            $objdata=namepost($obj);
            $president=getDataIndividu(0);
            $representant=getDataIndividu(1);
            $errorPresident=getErrorIndividu(0); $errorRepresentant=getErrorIndividu(1);
            $paysIntervenants = $this->input->post('Autres_pays_d_intervention');
            $error=fusion(emptyTable($data, $name), getErrorDate($data,$name));
            $error=fusion($error,$errorPresident); $error=fusion($error,$errorRepresentant);
            $error=fusion($error,emptyTable($objdata, $obj));
            $error=implode("¨",$error);echo $error;

            if(!$error){
                $this->db->trans_begin();

                $this->Ong_mere_model->insert('ONGMere', $data);
                $idlastONG = $this->Ong_mere_model->getLast('ONGMere')['idONGMere'];
                // Insertion des pays d'intervention
                $this->insertPaysinterventions($idlastONG, $_POST['Autres_pays_d_intervention']);

                // Pour insertion d'individu
                $president['idONGMere'] = $idlastONG;
                $representant['idONGMere'] = $idlastONG;

                $president["idONGMere"]=$idlastONG;
                $this->Ong_mere_model->insert('Individu', $president);
                $idlastPresident = $this->Ong_mere_model->getLast('Individu')['idIndividu'];

                $representant["idONGMere"]=$idlastONG;
                $this->Ong_mere_model->insert('Individu', $representant);
                $idlastRepresentant = $this->Ong_mere_model->getLast('Individu')['idIndividu'];

                $this->insertIndividuRole($idlastONG, $idlastPresident, $idlastRepresentant);
                
                //Insertion Projet
                $objdata['idONGMere'] = $idlastONG;
                $this->Ong_mere_model->insert('Projet', $objdata);

                //get last Projet
                $idlastProjet = $this->Ong_mere_model->getLast('Projet')['idProjet'];


                // Insert moyen humain[]
                $this->insertmoyen($_POST['moyensHumain'], $idlastProjet, 'Humain');

                // // Insert moyen materiel[]
                $this->insertmoyen($_POST['moyensMateriel'], $idlastProjet, 'Materiel');

                $this->db->trans_complete();
            }
            else{redirect(site_url("Ong_mere/index?error=$error"));exit;}
        }

        /**
         * Insert each individu in the form in their proper correspondant table value
         * @param integer $lastONG
         * @param integer $idP is the id corresponding to the id of the president
         * @param integer $idR is the id corresponding to the id of the president
         */
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
