<?php
    class Sujet{
        //attributs
        private $id_sujet;
        private $nom_sujet;
        private $contenu_sujet;
        private $date_sujet;
        private $id_users;

        public $connect;
        private $table = 'sujet';

        //constructeur
        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        //getters
        public function getTable(){
            return $this->table;
        }

        public function getIdSujet(){
            return $this->id_sujet;
        }
        public function getNomSujet(){
            return $this->nom_sujet;
        }
        public function getContenuSujet(){
            return $this->contenu_sujet;
        }
        public function getDateSujet(){
            return $this->date_sujet;
        }
        public function getIdUserSujet(){
            return $this->id_users;
        }

        //setters
        public function setNomSujet($newlog){
            $this->nom_sujet = $newlog;
        }
        public function setIdSujet($newid){
            return $this->id_sujet = $newid;
        }
        public function setContenuSujet($newcontenu){
            $this->contenu_sujet = $newcontenu;
        }
        public function setDateSujet($newdate){
            $this->date_sujet = $newdate;
        }

        // setters Foreign Key
        public function setIdUserSujet($newidusers){
            $this->id_users = $newidusers;
        }
        
//méthodes de CRUD

        //Read -> liste de tous les sujets
        public function getAllSujets() {
            //stockage de la requête dans une variable
            $query = "SELECT 
                        id_sujet, 
                        nom_sujet, 
                        date_sujet, 
                        contenu_sujet, 
                        login_user 
                    FROM 
                        sujet 
                    INNER JOIN 
                        users 
                    ON 
                        users.id_users=sujet.id_users 
                    ORDER BY 
                        id_sujet 
                    DESC";

            //stockage préparation de la requête
            $stmt = $this->connect->prepare($query);

            //exécution de la requête
            $stmt->execute();

            //retourne le résultat
            return $stmt;
        }

        //Read -> sélection d'un sujet (ici par id)
        public function getSingleSujet($idSouhaite) {

            $query = "SELECT 
                            * 
                    FROM 
                        ".$this->table." 
                    WHERE 
                        id_sujet = ".$idSouhaite."";

            $stmt = $this->connect->prepare($query);
        
            $stmt->execute();
        
            return $stmt;
        }

        //Create
        public function createSujet() {
            //requête
            $query = 'INSERT INTO
                        '.$this->table.' 
                    SET 
                        nom_sujet = :nom_sujet';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':nom_sujet',$this->nom_sujet);

            return $stmt->execute();
        }

        //Update (ici par nom)
        public function updateSujet() {
            //requête
            $query = 'UPDATE
                        '.$this->table.'
                    SET 
                        nom_sujet = :nom_sujet,
                    WHERE
                        nom_sujet = :nom_sujet2';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':nom_sujet',$this->nom_sujet);
            $stmt->bindParam(':nom_sujet2',$this->nom_sujet);
            
            //équivalent au if else
            return $stmt->execute();
        }

        //Delete (ici selon nom)
        public function deleteSujet() {
            $query = "DELETE FROM 
                            ".$this->table." 
                        WHERE 
                            nom_sujet = :nom_sujet";

            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(':nom_sujet',$this->nom_sujet);

            return $stmt->execute();
        } 

    }








?>