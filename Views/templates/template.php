
<?php

    include('Controlers/create_user_controler.php');
    // include('Controlers/connexion_controler.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Google Fonts-->

        <!--CSS-->
        <link rel="stylesheet" href="html_css/accueil.css">
        <title>Document</title>
    </head>

<body>
    <header>
        <a href="index.php?p=home"><h1>Infofo</h1></a>
        <input class="search" type="search" placeholder="Rechercher un sujet, un utilisateur...">
        <?php echo $message ?>


        <nav>
            <ul>
                <li id="creaCompte">Créer un compte</li>
                <li id="connCompte">Se connecter</li>
                <li><a href="index.php?p=compte">Mon compte</a><?php echo '<p>'.$nomlogin.'</p>' ?></li>
            </ul>
        </nav>
    </header>

    <div id="mainContainer">
        <?php echo $content ?>
    </div>


    
    
    <!--modale de connexion-->
    <div id="modal-creation" class="modal">
        <div>
            <div class="headerM">
                <span class="close">&times;</span>
                <h3>S'inscrire sur Infofo</h3>
            </div> 

            <div>
                <form action="" method="POST">
                    <ul>
                        <li>
                            <label for="pseudo-crea">Pseudo </label>
                            <input type="text" name="pseudo-crea" required pattern="^[A-Za-z '-]+$" maxlength="20"/>
                        </li>
                        <li>
                            <label for="email">E-mail </label>
                            <input type="email" name="email-crea" required pattern="^[A-Za-z]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$"/>
                        </li>
                        <li>
                            <label for="dateN">Date de naissance </label>
                            <input type="date" name="dateN" min="<?=$maxA?>01-01" max="<?=$minSP?>"/>
                        </li>
                        <li>
                            <label for="mdp-crea">Mot de passe </label>
                            <input type="password" name="mdp-crea" minlength="8" maxlength="15"/>
                        </li>
                        <li>
                            <label for="confirmMdp-crea">Confirmer le mot de passe </label>
                            <input type="password" name="confirmMdp-crea" minlength="8" maxlength="15"/>
                        </li>
                        <li id="check">
                            <input type="checkbox" name="condUtilisat">
                            <label for="condUtilisat">J'accepte les conditions d'utilisation du site'</label>
                        </li>
                        <li>
                            <input type="submit" name="Crea" value="Créer votre compte">
                        </li>
                    </ul>
                </form>
                
            </div>
            
            <div class="footerM">
                <p>Déjà un compte ?  Identifiez vous ici</p>
            </div>
        </div>
    </div>
    <!--modal de connexion-->
    <div id="modal-connexion" class="modal">
        <div>
            <div class="headerM">
                <span class="close">&times;</span>
                <h3>S'inscrire sur Infofo</h3>
            </div>

            <div>
                <form action="" method="POST">
                    <ul>
                        <li>
                            <label for="pseudo-connect">Pseudo </label>
                            <input type="text" name="pseudo-connect" maxlength="50"/>
                        </li>
                        <li>
                            <label for="mdp-connect">Mot de passe </label>
                            <input type="password" name="mdp-connect" minlength="8" maxlength="15"/>
                        </li>
                        <li>
                            <input type="submit" name="Connect" value="Connexion">
                        </li>
                    </ul>
                </form>
            </div>
            
            <div class="footerM">
                <p>Pas de compte ?  Créez-en un ici</p>
            </div>
        </div>
    </div>
    <footer>Footer</footer>
    <script src="script/affichage_modale_crea_compte.js"></script>
</body>
</html>
