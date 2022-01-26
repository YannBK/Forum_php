<?php
    class Users{
        //attributs
        private $id;
        private $login;
        private $mdp;
        private $mail;
        private $naissance;
        private $id_role;

        //constructeur
        public function __construct($id,$login,$mdp,$mail,$naissance,$id_role){
            $this->id = $id;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->mail = $mail;
            $this->naissance = $naissance;
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
        public function getMailUser(){
            return $this->mail;
        }
        public function getNaissanceUser(){
            return $this->naissance;
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
        public function setMailUser($newmail){
            $this->mail = $newmail;
        }
        public function setNaissanceUser($newnaissance){
            $this->naissance = $newnaissance;
        }
        public function setIdRoleUser($newrole){
            $this->id_role = $newrole;
        }
    }
?>