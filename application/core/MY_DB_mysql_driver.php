<?php
    class My_DB_mysql_driver extends CI_DB_mysql_driver{
        public function __construct($params){
            parent::__construct($params);
            $this->dbdriver = "mysqli";
        }
    }
?>