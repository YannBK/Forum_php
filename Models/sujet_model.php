<?php
    class Sujet{
        //attributs
        private $id;
        private $nom;
        private $contenu;
        private $date;
        private $id_user;

        private $table = 'sujet';

        //constructeur
        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        //getters
        public function getIdSujet(){
            return $this->id;
        }
        public function getNomSujet(){
            return $this->nom;
        }
        public function getContenuSujet(){
            return $this->contenu;
        }
        public function getDateSujet(){
            return $this->date;
        }
        public function getIdUserSujet(){
            return $this->id_user;
        }

        //setters
        public function setNomSujet($newlog){
            $this->nom = $newlog;
        }
        public function setIdSujet($newid){
            return $this->id = $newid;
        }
        public function setContenuSujet($newcontenu){
            $this->contenu = $newcontenu;
        }
        public function setDateSujet($newdate){
            $this->date = $newdate;
        }

        // setters Foreign Key
        public function setIdUserSujet($newiduser){
            $this->id_user = $newiduser;
        }
        
//méthodes de CRUD

        //Read -> liste de tous les sujets
        public function getAllSujets() {
            //stockage de la requête dans une variable
            $query = 'SELECT * FROM '.$this->table.'';

            //stockage préparation de la requête
            $stmt = $this->connect->prepare($query);

            //exécution de la requête
            $stmt->execute();

            //retourne le résultat
            return $stmt;
        }

        //Read -> le role instancié (ici par nom)
        public function getSingleSujet() {
            $query = "SELECT * FROM ".$this->table." WHERE nom_sujet = ".$this->nom."";

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
                        roleSiteName = :roleSiteName';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':roleSiteName',$this->roleSiteName);

            return $stmt->execute();
        }

        //Update (ici par nom)
        public function updateRoleSite() {
            //requête
            $query = 'UPDATE
                        '.$this->table.'
                    SET 
                        roleSiteName = :roleSiteName,
                    WHERE
                        roleSiteName = :roleSiteName2';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':roleSiteName',$this->roleSiteName);
            $stmt->bindParam(':roleSiteName2',$this->roleSiteName);
            
            //équivalent au if else
            return $stmt->execute();
        }

        //Delete (ici selon nom)
        public function deleteRoleSite() {
            $query = "DELETE FROM ".$this->table." WHERE roleSiteName = :roleSiteName";

            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(':roleSiteName',$this->roleSiteName);

            return $stmt->execute();
        } 

    }








?>