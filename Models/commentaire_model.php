<?php
    class Commentaire{
        //attributs de connexion à la bdd
        public $connect;
        private $table = 'commentaire';

        // attributs
        private $id_commentaire;
        private $nom_com;
        private $contenu_com;
        private $date_com;
        private $id_users;
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
        public function getIdCom(){
            return $this->id_commentaire;
        }
        public function getNomRole(){
            return $this->nom_com;
        }
        public function getContent(){
            return $this->contenu_com;
        } 
        public function getDateCom(){
            return $this->date_com;
        }
        public function getIdUserCom(){
            return $this->id_users;
        }
        public function getIdSujetCom(){
            return $this->id_sujet;
        }

        // setters
        public function setIdCom($new_id_commentaire){
            return $this->id_commentaire = $new_id_commentaire;
        }
        public function setNomCom($new_nom_com){
            $this->nom_com = $new_nom_com;
        }
        public function setContent($new_contenu_com){
            $this->contenu_com = $new_contenu_com;
        }
        public function setDateCom($new_date_com){
            $this->date_com = $new_date_com;
        }
        // setters Foreign Keys
        public function setIdUserCom($new_id_users){
            $this->id_users = $new_id_users;
        }
        public function setIdSujetCom($new_id_sujet){
            $this->id_sujet = $new_id_sujet;
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
?>