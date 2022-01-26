<?php
    class Sujet{
        //attributs
        private $id;
        private $nom;
        private $contenu;
        private $date;
        private $id_user;

        //constructeur
        public function __construct($id,$nom,$contenu,$date,$id_user){
            $this->id = $id;
            $this->nom = $nom;
            $this->contenu = $contenu;
            $this->date = $date;
            $this->id_user = $id_user;
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
        public function setContenuSujet($newcontenu){
            $this->contenu = $newcontenu;
        }
        public function setDateSujet($newdate){
            $this->date = $newdate;
        }

        // setters Foreign Key
        public function setIdSujet($newiduser){
            $this->id_user = $newiduser;
        }
        
    }
?>