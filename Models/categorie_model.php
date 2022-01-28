<?php


    class Categorie{
        // attributs
        private $id;
        private $nomCat;

        // constructeur
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
        public function setNomCat($newNomCat){
            $this-> nomCat = $newNomCat;
        }

        public static function displayCat(){
                include("Connect/connect.php");
                $aff = $bdd->prepare('SELECT * FROM categorie');
                $aff->execute();
                $opt="";
                while ($donnees = $aff->fetch()) {
                    $opt .= "<option value=" . $donnees['id_categorie'] . ">" . $donnees['nom_cat']."</option>";
                }
                return $opt;  
            }
        }

?>