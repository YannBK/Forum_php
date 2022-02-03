<?php
    class Commentaire{
        //attributs de connexion à la bdd
        public $connect;
        private $table = 'commentaire';

        // attributs
        private $id_commentaire;
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

        //tous les coms d'un sujet
        public function getComsS() {
            $myQuery = 'SELECT
                            commentaire.id_commentaire,
                            contenu_com,
                            date_com
                            id_users,
                            id_sujet,
                            login_user
                        FROM 
                            '.$this->table.' 
                        JOIN
                            users
                        ON 
                            users.id_users=commentaire.id_users 
                        WHERE 
                            id_sujet = '.$this-> id_sujet.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        //tous les coms d'un utilisateur
        public function getComsU() {
            $myQuery = 'SELECT 
                            id_commentaire, 
                            contenu_com, 
                            date_com, 
                            commentaire.id_users, 
                            commentaire.id_sujet, 
                            users.login_user,
                            nom_sujet
                        FROM 
                            '.$this->table.' 
                        INNER JOIN 
                            users 
                        ON 
                            users.id_users=commentaire.id_users 
                        INNER JOIN 
                            sujet 
                        ON 
                            commentaire.id_sujet=sujet.id_sujet 
                        WHERE 
                            commentaire.id_users = '.$this-> id_users.'';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleCom() {
            $myQuery = 'SELECT * FROM '.$this->table.' WHERE id_commentaire = '.$this-> id_commentaire.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createCom($contenu, $date, $idUsers, $idSujet) {
            $myQuery = 'INSERT INTO
                            '.$this->table.'
                        SET
                            contenu_com = :contenu_com,
                            date_com = :date_com,
                            id_users = :id_users,
                            id_sujet = :id_sujet';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':contenu_com', $contenu);
            $stmt->bindParam(':date_com', $date);
            $stmt->bindParam(':id_users', $idUsers);
            $stmt->bindParam(':id_sujet', $idSujet);
            return $stmt->execute();
        }

        public function updateCom() {
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            contenu_com = :contenu_com
                        WHERE
                            contenu_com = :contenu_com2';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':contenu_com', $this->contenu_com);
            $stmt->bindParam(':contenu_com2', $this->contenu_com);
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
                            id_commentaire = :id_commentaire';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_commentaire', $this->contenu_com);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function count() {
            $myQuery = 'SELECT 
                            COUNT(*)
                        FROM
                            '.$this->table.'
                        WHERE
                            id_sujet = :id_sujet';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':id_sujet', $this->id_sujet);
            $stmt->execute();
            return $stmt;
        }
    }
?>