<?php 

    class Phone{

        private $conn;
        private $table_name = "phones";

        public $id;
        public $producer;
        public $model;
        public $imei;

        public function __construct($db){
            $this -> conn = $db;
        }

        public function read(){
            
            $query = "SELECT id, producer, model, imei FROM " . $this -> table_name;

            $stm = $this -> conn -> prepare($query);

            $stm -> execute();
            return $stm;
        }

    }

?>