<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ong_mere_model extends CI_Model
    {

        public function __construct(){
            parent::__construct();
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
            $fullquery = "SELECT nameCountry FROM Countries WHERE nameCountry LIKE '%s' LIMIT 5";
            $queryExec = sprintf($fullquery, '%'.$query."%");
            $queryExec = $this->db->query($queryExec);
            $suggest = array();

            foreach($queryExec->result_array() as $row){
                $suggest[] = $row;
            }

            return $suggest;
        }

        public function insert($table, $data){
            $result = $this->db->insert($table, $data);
            return $result;
        }

        public function getLastONG(){
            $this->load->database("mysql");
            $fullquery = "SELECT * FROM ONGMere WHERE idONGMere = (SELECT MAX(idONGMere) FROM ONGMere)";
            $queryExec = $this->db->query($fullquery);
            $suggest = array();

            foreach($queryExec->result_array() as $row){
                $suggest[] = $row;
            }

            return $suggest[0];
        }
    }
?>
