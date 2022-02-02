<?php

    // fichier de connexion à la BDD 'forum'
    // $bdd = new PDO('mysql:host=localhost;dbname=forum','root','', 
    // array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    // $bdd-> exec("set names utf8");

    class Bdd{
        private $host = "127.0.0.1";
        private $dbName = "forum";
        private $userName = "root";
        private $password = "";

        public $connect;
        
        public function getConnexion() {
            $this->connect = null;
            try{
                $this->connect = new PDO(
                    "mysql:host=".$this->host.";
                    dbname=".$this->dbName."",
                    $this->userName,
                    $this->password);

            } catch(PDOException $exception) {
                echo "Database could not be connected:".$exception->getMessage();
            }
            return $this->connect;
        }
    }


?>