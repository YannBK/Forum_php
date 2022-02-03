<aside>
    <h2>Navigation</h2>
    <div>
        <p>Mes Sujets</p>
        <p>Mes Commentaires</p>
        <p><input id='changemdp' type='button' value='Changer de mot de passe'></p>
        
    </div>
</aside>

<!--les sujets-->
<section>
    <h2>Votre compte</h2>

    <!-- <div> -->
    <a href="index.php?p=home">Accueil</a>
    <!-- </div> -->
    <article>

        <?php echo $articleCompte ?>


    </article>
</section>
<!--les sujets les plus actifs-->
<aside>
    <h2>Vos dernières interventions</h2>
    <ul>
        <li>

        </li>
        <li>

        </li>
        <li>

        </li>
    </ul>
</aside>



<div id="modal-changelogin" class="modal">
    <div>
        <div class="headerM">
            <span class="close">&times;</span>
            <h3>S'inscrire sur Infofo</h3>
        </div>

        <div>
            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="newlogin">Votre nouveau pseudo : </label>
                        <input type="text" name="newlogin" maxlength="50" />
                    </li>
                    <li>
                        <label for="mdp-newlogin">Votre mot de passe : </label>
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
<div id="modal-changemdp" class="modal">
    <div>
        <div class="headerM">
            <span class="close">&times;</span>
            <h3>S'inscrire sur Infofo</h3>
        </div>

        <div>
            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="newmdp">Votre nouveau mot de passe : </label>
                        <input type="password" name="newmdp" maxlength="50" />
                    </li>
                    <li>
                        <label for="mdp-newmdp">Votre mot de passe actuel : </label>
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