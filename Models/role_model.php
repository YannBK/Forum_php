<?php
    class Role{
        private $id;
        private $nomRole;

    public function __construct($id,$nomRole){
        $this-> id = $id;
        $this-> nomRole = $nomRole;
    }

    // getters
    public function getIdRole(){
        return $this-> id;
    }
    public function getNomRole(){
        return $this-> nomRole;
    }

    // setters
    public function setNomRole($newNomRole){
        $this->nomRole = $newNomRole;
    }

    }
?>