<?php

class CatSujet{
    //attributs de connexion à la bdd
    public $connect;
    private $table = 'appartenir';

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
        public function getAppart() {
            $myQuery = 'SELECT
                             *
                        FROM 
                            '.$this->table.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleAppart() {
            $myQuery = 'SELECT 
                            * 
                        FROM 
                            '.$this->table.' 
                        WHERE 
                            id_categorie = '.$this-> id_categorie.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createAppart() {
            $myQuery = 'INSERT INTO
                            '.$this->table.'
                        SET
                            id_categorie = :id_categorie,
                            id_sujet = :id_sujet';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_categorie', $this->id_categorie);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            return $stmt->execute();
        }

        public function updateAppartCat() {
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            id_categorie = :id_categorie
                        WHERE
                            id_categorie = :id_categorie2
                        AND
                            id_sujet = :id_sujet';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_categorie', $this->id_categorie);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            $stmt->bindParam(':id_categorie2', $this->id_categorie);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateAppartSujet() {
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            id_sujet = :id_sujet
                        WHERE
                            id_categorie = :id_categorie
                        AND
                            id_sujet = :id_sujet2';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_categorie', $this->id_categorie);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            $stmt->bindParam(':id_sujet2', $this->id_sujet);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteAppartCat() {
            $myQuery = 'DELETE FROM 
                            '.$this->table.'
                        WHERE
                            id_categorie = :id_categorie';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_categorie', $this->id_categorie);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteAppartSujet() {
            $myQuery = 'DELETE FROM 
                            '.$this->table.'
                        WHERE
                            id_sujet = :id_sujet';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteSingleAppartSujet() {
            $myQuery = 'DELETE FROM 
                            '.$this->table.'
                        WHERE
                            id_sujet = :id_sujet
                        AND
                            id_categorie = :id_categorie';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            $stmt->bindParam(':id_categorie', $this->id_categorie);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
}
