<?php
    class Commentaire{
        // attributs
        private $id;
        private $nomCom;
        private $content;
        private $dateCom;
        private $idSujetCom;
        private $idUserCom;

        // constructeur
        public function __construct($id,$nomCom,$content,$dateCom,$idSujetCom,$idUserCom){
            $this->id = $id;
            $this->nomCom = $nomCom;
            $this->content = $content;
            $this->dateCom = $dateCom;
            $this->idSujetCom = $idSujetCom;
            $this->idUserCom = $idUserCom;
        }

        // getters
        public function getIdCom(){
            return $this->id;
        }
        public function getNomRole(){
            return $this->nomCom;
        }
        public function getContent(){
            return $this->content;
        } 
        public function getDateCom(){
            return $this->dateCom;
        }
        public function getIdSujetCom(){
            return $this->idSujetCom;
        }
        public function getIdUserCom(){
            return $this->idUserCom;
        }

        // setters
        public function setIdCom($id){
            return $this->id = $id;
        }
        public function setNomCom($newNomCom){
            $this->nomCom = $newNomCom;
        }
        public function setContent($newContent){
            $this->content = $newContent;
        }
        public function setDateCom($newDateCom){
            $this->dateCom = $newDateCom;
        }
        // setters Foreign Keys
        public function setIdSujetCom($newIdSujetCom){
            $this->idSujetCom = $newIdSujetCom;
        }
        public function setIdUserCom($newIdUserCom){
            $this->idUserCom = $newIdUserCom;
        }
    }
?>