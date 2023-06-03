<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ong_mere_model extends CI_Model
    {
        public function selec(){
            $valiny = "select * from ong";
            return select;
        }

        public function getCountries(){
            $this->load->database("mysql");
            $query = "SELECT nameCountry FROM Countries";
            $queryexec = $this->db->query($query);
            $country = array();
            
            foreach($queryexec->result_array() as $row){
                $country[] = $row;
            }

            return $country;
        }

        public function getSuggestions($query){
            $this->load->database("mysql");
            $fullquery = "SELECT nameCountry FROM Countries WHERE nameCountry LIKE '%s'";
            $queryExec = sprintf($fullquery, '%'.$query."%");
            $queryExec = $this->db->query($queryExec);
            $suggest = array();

            foreach($queryExec->result_array() as $row){
                $suggest[] = $row;
            }

            return $suggest;
        }
    }
?>