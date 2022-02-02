<?php
    // include('Connect/connect.php');

    class Categorie{
        // attributs
        private $id_categorie;
        private $nom_cat;

        public $connect;
        private $table = 'categorie';
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
        public function getNomCat(){
            return $this->nom_cat;
        }

        // setters
        public function setNomCat($newNomCat){
            $this-> nom_cat = $newNomCat;
        }

//méthodes de CRUD

        //Read -> liste de tous les sujets
        public function getAllCategorie() {
            //stockage de la requête dans une variable
            $query = 'SELECT * FROM '.$this->table.'';

            //stockage préparation de la requête
            $stmt = $this->connect->prepare($query);

            //exécution de la requête
            $stmt->execute();

            //retourne le résultat
            return $stmt;
        }

        //Read -> sélection d'un sujet (ici par id)
        public function getSingleCategorie($idSouhaite) {

            $query = "SELECT 
                            * 
                    FROM 
                        ".$this->table." 
                    WHERE 
                        id_categorie = ".$idSouhaite."";

            $stmt = $this->connect->prepare($query);
        
            $stmt->execute();
        
            return $stmt;
        }

        //Create
        public function createCategorie() {
            //requête
            $query = 'INSERT INTO
                        '.$this->table.' 
                    SET 
                        nom_cat = :nom_cat';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':nom_cat',$this->nom_cat);

            return $stmt->execute();
        }

        //Update (ici par nom)
        public function updateCategorie() {
            //requête
            $query = 'UPDATE
                        '.$this->table.'
                    SET 
                        nom_cat = :nom_cat,
                    WHERE
                        nom_cat = :nom_cat2';

            //préparation
            $stmt = $this->connect->prepare($query);

            //bind des paramètres
            $stmt->bindParam(':nom_cat',$this->nom_cat);
            $stmt->bindParam(':nom_cat2',$this->nom_cat);
            
            //équivalent au if else
            return $stmt->execute();
        }

        //Delete (ici selon nom)
        public function deleteCategorie() {
            $query = "DELETE FROM 
                            ".$this->table." 
                        WHERE 
                            nom_cat = :nom_cat";

            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(':nom_cat',$this->nom_cat);

            return $stmt->execute();
        } 
    }

?>