<?php
    class Users{
        //attributs
        private $id;
        private $login;
        private $mdp;
        private $id_role;

        //constructeur
        public function __construct($id,$login,$mdp,$id_role){
            $this->id = $id;
            $this->login = $login;
            $this->imdpd = $mdp;
            $this->id_role = $id_role;
        }

        //getters
        public function getIdUser(){
            return $this->id;
        }
        public function getLoginUser(){
            return $this->login;
        }
        public function getMdpUser(){
            return $this->mdp;
        }
        public function getIdRoleUser(){
            return $this->id_role;
        }

        //setters
        public function setIdUser($newid){
            $this->id = $newid;
        }
        public function setLoginUser($newlog){
            $this->login = $newlog;
        }
        public function setMdpUser($newmdp){
            $this->mdp = $newmdp;
        }
        public function setIdRoleUser($newrole){
            $this->id_role = $newrole;
        }
    }
?>