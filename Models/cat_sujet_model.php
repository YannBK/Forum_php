<?php

class CatSujet{
    private $id_cat;
    private $id_sujet;

        // constructeur
        public function __construct($id_cat,$id_sujet){
            $this->id_cat = $id_cat;
            $this->id_sujet = $id_sujet;
        }

        // getters
        public function getIdCat(){
            return $this->id_cat;
        }
        public function getNomCat(){
            return $this->id_sujet;
        }

        // setters
        public function setIdCat($newid_cat){
            $this-> id_cat = $newid_cat;
        }
        public function setIdSujet($newid_sujet){
            $this-> id_sujet = $newid_sujet;
        }
}
