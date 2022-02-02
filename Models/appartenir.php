<?php

class CatSujet{
    //attributs de connexion à la bdd
    public $connect;
    private $table = 'commentaire';

    private $id_categorie;
    private $id_sujet;

        // constructeur
        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        // getters
        public function getTable(){
            return $this->table;
        }
        public function getIdCat(){
            return $this->id_categorie;
        }
        public function getIdSujet(){
            return $this->id_sujet;
        }

        // setters
        public function setIdCat($new_id_categorie){
            $this-> id_categorie = $new_id_categorie;
        }
        public function setIdSujet($new_id_sujet){
            $this-> id_sujet = $new_id_sujet;
        }

        //CRUD
        public function getComs() {
            $myQuery = 'SELECT * FROM '.$this->table.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleCom() {
            $myQuery = 'SELECT * FROM '.$this->table.' WHERE nom_com = '.$this-> nom_com.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createCom() {
            $myQuery = 'INSERT INTO
                            '.$this->table.'
                        SET
                            nom_com = :nom_com';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_com', $this->nom_com);
            return $stmt->execute();
        }

        public function updateCom() {
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            nom_com = :nom_com
                        WHERE
                            nom_com = :nom_com2';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_com', $this->nom_com);
            $stmt->bindParam(':nom_com2', $this->nom_com);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteCom() {
            $myQuery = 'DELETE FROM 
                            '.$this->table.'
                        WHERE
                            nom_com = :nom_com';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_com', $this->nom_com);
            $stmt->bindParam(':nom_com2', $this->nom_com);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
}
