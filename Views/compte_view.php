<!--Navigation de la page compte-->
<aside id="asideL">
    <h2>Navigation</h2>
        <form method='POST'>
            <a href="index.php?p=compte">Informations du compte</a>
            <input id='comptesuj' type='submit' name='comptesuj' value='Mes Sujets' <?= $disabled ?>>
            <input id='comptecomm' type='submit' name='comptecomm' value='Mes Commentaires' <?= $disabled ?>>
            <input id='changemdp' type='button' value='Changer de mot de passe' <?= $disabled ?>>
        </form>
</aside>

<!--les sujets-->
<section>
    <h2>Votre compte</h2>
    <a href="index.php?p=home">Accueil</a>

    <article>
        <?php echo $articleCompte ?>
    </article>
</section>

<!--les sujets les plus actifs-->
<aside>
    <h2>Vos dernières interventions</h2>
    <ul>
        <?= $derniers ?>
    </ul>
</aside>

<!--modal de changement de login-->
<div id="modal-changelogin" class="modal">
    <div>
        <div class="headerM">
            <span class="close">&times;</span>
            <h3>Changez votre login</h3>
        </div>
        <div>
            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="newlogin">Nouveau pseudo : </label>
                        <input type="text" name="newlogin" maxlength="50" />
                    </li>
                    <li>
                        <label for="mdp-newlogin">Mot de passe : </label>
                        <input type="password" name="mdp-newlogin" minlength="8" maxlength="15" />
                    </li>
                    <li>
                        <input type="submit" name="Newlogin" value="Confirmer">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<!--modal de changement de mot de passe-->
<div id="modal-changemdp" class="modal">
    <div>
        <div class="headerM">
            <span class="close">&times;</span>
            <h3>Changez votre mot de passe</h3>
        </div>
        <div>
            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="newmdp">Nouveau mot de passe : </label>
                        <input type="password" name="newmdp" maxlength="50" />
                    </li>
                    <li>
                        <label for="mdp-newmdp">Mot de passe actuel : </label>
                        <input type="password" name="mdp-newmdp" minlength="8" maxlength="15" />
                    </li>
                    <li>
                        <input type="submit" name="Newmdp" value="Confirmer">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
