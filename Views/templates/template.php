<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Infofo</h1>
        <input type="search" placeholder="Rechercher un sujet, un utilisateur...">
        <nav>
            <ul>
                <li>Créer un compte</li>
                <li>Se connecter</li>
                <li><a href="index.php?p=compte">Mon compte</a></li>
            </ul>
        </nav>
    </header>

    <!--modale de connexion-->
    <div id="modal-creation" class="modal">
        <div>
            <div class="headerM">
                <span id="close">&times;</span>
                <h3>S'inscrire sur Infofo</h3>
            </div>

    <div id="mainContainer">
        <?php echo $content ?>
    </div>
    
            <div>
                <form action="" method="POST">
                    <ul>
                        <li>
                            <label for="pseudo">Pseudo </label>
                            <input type="text" name="pseudo-crea" maxlength="50"/>
                        </li>
                        <li>
                            <label for="email">E-mail </label>
                            <input type="email" name="email-crea"/>
                        </li>
                        <li>
                            <label for="mdp">Mot de passe </label>
                            <input type="password" name="mdp-crea" minlength="8" maxlength="15"/>
                        </li>
                        <li>
                            <label for="confirmMdp">Confirmer le mot de passe </label>
                            <input type="password" name="confirmMdp-crea" minlength="8" maxlength="15"/>
                        </li>
                        <li>
                            <input type="checkbox" name="condUtilisat-crea">
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
                <span id="close">&times;</span>
                <h3>S'inscrire sur Infofo</h3>
            </div>

            <div>
                <form action="" method="POST">
                    <ul>
                        <li>
                            <label for="pseudo">Pseudo </label>
                            <input type="text" name="pseudo-connect" maxlength="50"/>
                        </li>
                        <li>
                            <label for="mdp">Mot de passe </label>
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
</body>
</html>