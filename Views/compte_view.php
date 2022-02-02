
<aside>
    <h2>Navigation</h2>
    <ul>
        <li>Mes Sujets</li>
        <li>Mes Commentaires</li>
        <li>Changer mes informations</li>
    </ul>
</aside>

<!--les sujets-->
<section>
    <h2>Votre compte</h2>
    
    <!-- <div> -->
    <a href="index.php?p=home">Accueil</a> 
    <!-- </div> -->
    <article>
    <h3>Vos informations :</h3>
    <?php echo "<div><p>Votre login : </p><p>" . $_SESSION['login'] . " </p></div>";?>
    <?php echo "<div><p>Votre mail : </p><p>" . $_SESSION['mail'] . " </p></div>";?>
    <?php echo "<div><p>Votre date : </p><p>" . $_SESSION['date'] . " </p></div>";?>
    <?php echo "<div><p>Votre mdp (à ne pas afficher): </p><p>" . $_SESSION['mdp'] . " </p></div>";?>


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