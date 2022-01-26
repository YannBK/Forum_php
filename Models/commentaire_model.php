<?php
    class Commentaire{
        private $id;
        private $nomCom;
        private $content;
        private $dateCom;

        // constructeur
        public function __construct($id,$nomCom,$content,$dateCom){
            $this->id = $id;
            $this->nomCom = $nomCom;
            $this->content = $content;
            $this->dateCom = $dateCom;
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
        // setters
        public function setIdCom($newid){
            $this->id = $newid;
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
    }
?>