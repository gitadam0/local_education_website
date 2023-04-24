<?php


    class Database{
        

        private $data;
        private $conn;

        function __construct($data){

            $this->data = $data;
        }

        function conn(){
            $this->conn = new PDO("mysql:host=".$this->data["servername"].";dbname=".$this->data["dbname"].";",$this->data["username"],$this->data["password"],[ PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
        }
        function query($query,$bindParams){
            $stmt = $this->conn->prepare($query);
            $stmt->execute($bindParams);
            return $stmt;
        }

    }
