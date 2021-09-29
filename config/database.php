<?php 

    class Database{
        private $host = "localhost";
        private $db_name = "qr_test";
        private $username = "root";
        private $password = "";

        public $conn;

        public function getConnection(){
            $this -> conn = null;

            try{
                $this -> conn = new PDO("mysql:host=" . $this -> host . "; dbname=" . $this -> db_name , $this -> username, $this -> password);
            }catch(PDOException $exp){
                echo "Connection error: :" . $exp -> getMessage();
            }

            return $this -> conn;
        }
    }

?>