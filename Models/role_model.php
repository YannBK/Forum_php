<?php
    class Role{
        //attributs de connexion à la bdd
        public $connect;
        private $table = 'role';

        // attributs
        private $id_role;
        private $nom_role;

        // constructeur
        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        // getters
        public function getTable(){
            return $this->table;
        }

        public function getIdRole(){
            return $this-> id_role;
        }

        public function getNomRole(){
            return $this-> nom_role;
        }

        // setters
        public function setIdRole($newIdRole){
            $this->id_role = $newIdRole;
        }

        public function setNomRole($newNomRole){
            $this->nom_role = $newNomRole;
        }

        //CRUD

        public function getRoles() {
            $myQuery = 'SELECT * FROM '.$this->table.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleRole() {
            $myQuery = 'SELECT * FROM '.$this->table.' WHERE nom_role = '.$this-> nom_role.'';
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createRole() {
            $myQuery = 'INSERT INTO
                            '.$this->table.'
                        SET
                            nom_role = :nom_role';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_role', $this->nom_role);
            return $stmt->execute();
        }

        public function updateRole() {
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            nom_role = :nom_role
                        WHERE
                            nom_role = :nom_role2';
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_role', $this->nom_role);
            $stmt->bindParam(':nom_role2', $this->nom_role);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteRole() {
            $myQuery = 'DELETE FROM 
                            '.$this->table.'
                        WHERE
                            nom_role = :nom_role';

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nom_role', $this->nom_role);
            $stmt->bindParam(':nom_role2', $this->nom_role);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>