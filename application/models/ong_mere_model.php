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

        public function getTableValue($tableName, $names, $name=""){
            $this->load->database("mysql");
            $query="select * from $tableName where $names like '%$name%'";
            $valiny=array();
            $query=$this->db->query($query);
            foreach($query->result_array() as $row){
                $valiny[] = $row;
            }
            return $valiny;
        }

        public function getRegion($n=""){
            $this->load->database("mysql");
            $query="select * from Region where des_region like '%$n%'";
            $region=array();
            $query=$this->db->query($query);
            foreach($query->result_array() as $row){
                $region[] = $row;
            }
            return $region;
        }

        public function getAllRegion(){
            $this->load->database("mysql");
            $query="select * from Region";
            $region=array();
            $query=$this->db->query($query);
            foreach($query->result_array() as $row){
                $region[] = $row;
            }
            return $region;
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
