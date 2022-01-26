<?php
    class Categorie{
        // attributs
        private $id;
        private $nomCat;

        public function __construct($id,$nomCat){
            $this->id = $id;
            $this->nomCat = $nomCat;
        }

        // getters
        public function getIdCat(){
            return $this->id;
        }
        public function getNomCat(){
            return $this->nomCat;
        }

        // setters
        // public function setIdCat($newIdCat){   
        //     $this->id = $newIdCat;
        // }
        public function setNomCat($newNomCat){
            $this-> nomCat = $newNomCat;
        }
    }
?>