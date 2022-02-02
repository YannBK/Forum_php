<?php
    // include('Connect/connect.php');
    class Users{
        //attributs

        public $connect;
        private $table ='users'; 

        private $id;
        private $login;
        private $mdp;
        private $mail;
        private $date;
        private $id_role =2;

        //constructeur
        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        //getters

        public function getTable(){
            return $this->table;
        }
        public function getIdUser(){
            return $this->id;
        }
        public function getLoginUser(){
            return $this->login;
        }
        public function getMdpUser(){
            return $this->mdp;
        }
        public function getMailUser(){
            return $this->mail;
        }
        public function getNaissanceUser(){
            return $this->date;
        }
        public function getIdRoleUser(){
            return $this->id_role;
        }

        //setters
        public function setLoginUser($login){
            $this->login = $login;
        }
        public function setMdpUser($mdp){
            $this->mdp = $mdp;
        }
        public function setMailUser($mail){
            $this->mail = $mail;
        }
        public function setNaissanceUser($date){
            $this->date = $date;
        }
        // setters Foreign Key
        public function setIdRoleUser($id_role){
            $this->id_role = $id_role;
        }

        public function getUsers(){
            $myQuery = 'SELECT
                            *
                        FROM
                            '.$this->table.'
                        JOIN
                            role
                        Where
                            '.$this->table.'.id_role = role.id_role';

            $stmt = $this->connect->prepare($myQuery);

            $stmt->execute();

            return $stmt;
        }

        public function getSingleUser(){
            $myQuery = 'SELECT
                            *
                        FROM
                            '.$this->table.'
                        Where
                            login_user = :login';
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam('login', $this->login);
            $stmt->execute();
            return $stmt;
        }

        public function createUser(){
            $myQuery = 'INSERT INTO
                            '.$this->table.'
                        SET
                            login_user = :login,
                            mdp_user = :mdp,
                            mail_user = :mail,
                            date_user = :date,
                            id_role = :id_Role';
            
            $stmt = $this->connect->prepare($myQuery);

            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':mdp', $this->mdp);
            $stmt->bindParam(':mail', $this->mail);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':id_Role', $this->id_Role);

            return $stmt->execute();
        }

        public function updateUser(){
            $myQuery = 'UPDATE
                            '.$this->table.'
                        SET
                            login_user = :login,
                            mmdp_user = :mdp,
                            mail_user = :mail,
                            date_user = :date,
                            id_role = :id_Role
                        WHERE
                            login2 = :login2';

            $stmt = $this->connect->prepare($myQuery);

            // bind des paramètres
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':mdp', $this->mdp);
            $stmt->bindParam(':mail', $this->mail);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':idRole', $this->idRole);
            $stmt->bindParam(':login2', $this->login);

            if($stmt->execute) {
                // je retourne true si mise à jour réussie
                return true;
            } else {
                return false;
            }
        }

        public function deleteUser() {
            $myQuery = 'DELETE FROM
                            '.$this->table.' 
                        WHERE 
                            login_user = :login';

            $stmt = $this->connect->prepare($myQuery);

            $stmt->bindParam(':login', $this->login);

            if($stmt->execute) {
                // je retourne true si mise à jour réussie
                return true;
            } else {
                return false;
            }
        }

        public function verifyPseudoAndMail() {
            $myQuery = 'SELECT
                            *
                        FROM
                            '.$this->table.'
                        WHERE
                            login_user = :login
                        OR 
                            mail_user = :mail';

            $stmt = $this->connect->prepare($myQuery);

            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':mail', $this->mail);

            $stmt->execute();
            return $stmt;
        }
    }
?>