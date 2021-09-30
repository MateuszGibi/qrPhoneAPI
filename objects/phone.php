<?php 

    class Phone{

        private $conn;
        private $table_name = "phones";

        //Public fields of phone
        public $id;
        public $producer;
        public $model;
        public $imei;

        //Connect to db on init
        public function __construct($db){
            $this -> conn = $db;
        }

        //Read all data from db
        public function read(){
            
            $query = "SELECT id, producer, model, imei FROM " . $this -> table_name;

            $stm = $this -> conn -> prepare($query);

            $stm -> execute();
            //Return PDOStatement
            return $stm;
        }

        //Add phone to db
        public function create(){
            
            $query = "INSERT INTO " . $this -> table_name . "(producer, model, imei) VALUES(:producer, :model, :imei)";

            $stm = $this -> conn -> prepare($query);

            //Sanitize
            $this -> producer = htmlspecialchars(strip_tags($this -> producer));
            $this -> model = htmlspecialchars(strip_tags($this -> model));
            $this -> imei = htmlspecialchars(strip_tags($this -> imei));

            //Bind values to query
            $stm -> bindParam(":producer", $this -> producer);
            $stm -> bindParam(":model", $this -> model);
            $stm -> bindParam(":imei", $this -> imei);

            //Return result
            if($stm -> execute()){
                return true;
            }
            else{
                return false;
            }
        }

    }

?>