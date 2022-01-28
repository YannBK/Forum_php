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

    try {
        $url = $_GET['id'];

        $req = $bdd->prepare("SELECT * FROM sujet WHERE id_sujet=:id_sujet");
        $req->execute(array(':id_sujet'=>$url));

        $sujet;
        while($donnees = $req->fetch()){
            $sujet = "<div><h2>".$donnees['nom_sujet']."</h2><p>".$donnees['id_users']."</p><p>".$donnees['date_sujet']."</p><p>".$donnees['contenu_sujet']."</p></div>";
        }

        /*$req = $bdd->prepare("SELECT * FROM commentaire WHERE id_sujet=$donnees");
        $req->execute();


        $listeCom;
        while($donnees = $req->fetch()){
            $listeCom .= "<div><h3>".$donnees['id_users']."</h3><p>".$donnees['date_com']."</p><p>".$donnees['contenu_com']."</p></div>";
        }*/
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }
?>