<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Ong_mere_model extends CI_Model
    {

        public function __construct(){
            parent::__construct();
        }

        /**
         * Select * from any tables in the database
         * @param string $table is the table name to select from db
         */
        public function select($table){
            $this->load->database("mysql");
            $result = $this->db->get($table)->result();
            return $result;
        }

        /**
         * Select only name of Country from table Country (Contains all the country in the world)
         * @return array that contains all the name of the country
         */
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

        /**
         * Used for suggestion, select where inputed match a value in db, if so return them or it
         * @param tablename
         * @param names table column to check a matching
         * @param name value from input
         * @return array that contains all the element that match
         */
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

        /**
         * Select * from region where designated region matched from input
         * @param n is the value from input to check
         * @return array that contains all the elemnt that match
         */
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

        /**
         * Get all the country name that match with param
         * @param query is the name from input that will be checked if match with a country name
         * @return array that contains all the country that match with the parameter
         */
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

        /** 
         * Insert datas into a given table name
         * @param string $table tabel name
         * @param array $data data to insert into @table
         * @return boolean true if successful
        */
        public function insert($table, $data){
            $result = $this->db->insert($table, $data);
            echo $table.'<br>';
            return $result;
        }

        /**
         * Get the last element inserted in a given table name
         * @param table name of the table to select in
         */
        public function getLast($table){
            $this->load->database("mysql");
            $fullquery = "SELECT * FROM %s WHERE %s = (SELECT MAX(%s) FROM %s)";
            $fullquery = sprintf($fullquery, $table, 'id'.$table, 'id'.$table, $table);
            $queryExec = $this->db->query($fullquery);
            $suggest = array();

            foreach($queryExec->result_array() as $row){
                $suggest[] = $row;
            }

            return $suggest[0];
        }
    }
?>
