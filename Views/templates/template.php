
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
                <?= $besoinCreation ?>
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
                            <input type="text" name="pseudo-crea" required pattern="^[a-zA-Z0-9_]*$" maxlength="20"/>
                        </li>
                        <li>
                            <label for="email">E-mail </label>
                            <input type="email" name="email-crea" required pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|'(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*')@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])"/>
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
                            <input type="checkbox" name="condUtilisat" required>
                            <label for="condUtilisat">J'accepte les conditions d'utilisation du site'</label>
                        </li>
                        <li>
                            <input type="submit" name="Crea" value="Créer votre compte">
                        </li>
                    </ul>
                </form>
                
            </div>
            
            <div class="footerM">
                <p id="allerConn">Déjà un compte ?  Identifiez vous ici</p>
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
                    <?= $notif ?>
                </form>
            </div>
            
            <div class="footerM">
                <p id="allerCrea">Pas de compte ?  Créez-en un ici</p>
            </div>
        </div>
    </div>

    <div id="modal-deconnexion" class="modal">
        <div>
            <div class="headerM">
                <span class="close">&times;</span>
                <h3>Se déconnecter de Infofo ?</h3>
            </div>

            <div>
                
                <form action="" method="POST">

                    <input type="submit" id="deconnect" name="deconnect" value="Déconnexion">
                    <input type="submit" name="rester" value="Je reste">

                </form>
                <!-- Désolé d'avoir fait ça à l'arrache, faut juste trouver comment refresh la page après le click sur déconnexion  -->
                <?php if(isset($_POST['Deconnect'])){
                    session_destroy();

                } ?>
            </div>
            
            <div class="footerM">
                <p id="allerCrea">Pas de compte ?  Créez-en un ici</p>
            </div>
        </div>
    </div>

    <footer><div id="admin">Admin</div></footer>
    <script src="script/affichage_modale_crea_compte.js"></script>

</body>
</html>
