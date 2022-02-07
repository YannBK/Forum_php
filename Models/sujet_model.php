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
            $query = "SELECT 
                            sujet.id_sujet, 
                            nom_sujet, 
                            date_sujet, 
                            contenu_sujet, 
                            login_user,
                            nom_cat
                        FROM 
                            sujet 
                        INNER JOIN 
                            users 
                        ON 
                            users.id_users=sujet.id_users 
                        INNER JOIN
                            appartenir 
                        ON
                            appartenir.id_sujet = sujet.id_sujet 
                        INNER JOIN
                            categorie 
                        ON
                            appartenir.id_categorie = categorie.id_categorie
                        ORDER BY 
                            id_sujet 
                        DESC";

            $stmt = $this->connect->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //Read -> liste de tous les sujets d'une catégorie
        public function getAllSujetsByCategorie($url) {
            $query = "SELECT 
                            sujet.id_sujet, 
                            nom_sujet, 
                            date_sujet, 
                            contenu_sujet, 
                            login_user, nom_cat 
                        FROM 
                            sujet 
                        INNER JOIN 
                            users 
                        ON 
                            users.id_users=sujet.id_users 
                        INNER JOIN 
                            appartenir 
                        ON 
                            appartenir.id_sujet = sujet.id_sujet 
                        INNER JOIN 
                            categorie 
                        ON 
                            appartenir.id_categorie = categorie.id_categorie 
                        WHERE 
                            categorie.nom_cat = '$url' 
                        ORDER BY 
                            id_sujet 
                        DESC";

            $stmt = $this->connect->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //Read -> liste de tous les sujets d'un utilisateur
        public function getAllSujetsBySearch($search, $champs) {
            $query = "SELECT 
                            sujet.id_sujet, 
                            nom_sujet, 
                            date_sujet, 
                            contenu_sujet, 
                            login_user, 
                            nom_cat,
                            sujet.id_users,
                            login_user 
                        FROM 
                            sujet 
                        INNER JOIN 
                            users 
                        ON 
                            users.id_users=sujet.id_users 
                        INNER JOIN 
                            appartenir 
                        ON 
                            appartenir.id_sujet = sujet.id_sujet 
                        INNER JOIN 
                            categorie 
                        ON 
                            appartenir.id_categorie = categorie.id_categorie 
                        WHERE 
                            $champs 
                        LIKE 
                            '%$search%' 
                        ORDER BY 
                            id_sujet 
                        DESC";

            $stmt = $this->connect->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //Read -> sélection d'un sujet (ici par id)
        public function getSingleSujet($idSouhaite) {

            $query = "SELECT 
                            sujet.id_sujet, 
                            nom_sujet, 
                            date_sujet, 
                            contenu_sujet, 
                            login_user
                    FROM 
                        ".$this->table." 
                    JOIN
                        users
                    ON
                        users.id_users=sujet.id_users 
                    WHERE 
                        id_sujet = ".$idSouhaite."";

            $stmt = $this->connect->prepare($query);
        
            $stmt->execute();
        
            return $stmt;
        }

        //Create
        public function createSujet($nom,$contenu,$date,$idUser) {
            //requête
            $query = 'INSERT INTO
                        '.$this->table.' 
                    SET 
                        nom_sujet = :nom_sujet, 
                        contenu_sujet = :contenu_sujet, 
                        date_sujet= :date_sujet, 
                        id_users = :id_users';

            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(':nom_sujet',$nom);
            $stmt->bindParam(':contenu_sujet',$contenu);
            $stmt->bindParam(':date_sujet',$date);
            $stmt->bindParam(':id_users',$idUser);

            return $stmt->execute();
        }

        //Update (ici par nom)
        // public function updateSujet() {
        //     $query = 'UPDATE
        //                 '.$this->table.'
        //             SET 
        //                 nom_sujet = :nom_sujet,
        //             WHERE
        //                 nom_sujet = :nom_sujet2';

        //     $stmt = $this->connect->prepare($query);

        //     $stmt->bindParam(':nom_sujet',$this->nom_sujet);
        //     $stmt->bindParam(':nom_sujet2',$this->nom_sujet);
            
        //     return $stmt->execute();
        // }

        //Delete (ici selon nom)
        public function deleteSujet() {
            $query = "DELETE FROM 
                            ".$this->table." 
                        WHERE 
                            id_sujet = :id_sujet";

            $stmt = $this->connect->prepare($query);

            $stmt->bindParam(':id_sujet',$this->id_sujet);

            return $stmt->execute();
        } 
    }

?>