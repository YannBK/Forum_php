
<aside>
    <h2>Navigation</h2>
    <ul>
        
    </ul>
</aside>

<!--les sujets-->
<section>
    <h2>Votre compte</h2>
    
    <!-- <div> -->
    <a href="index.php?p=home">Accueil</a> 
    <!-- </div> -->
    <article>

    <?php echo "<p>Votre login : " . $_SESSION['login'] . " </p>";?>
    <?php echo "<p>Votre mail : " . $_SESSION['mail'] . " </p>";?>
    <?php echo "<p>Votre date : " . $_SESSION['date'] . " </p>";?>
    <?php echo "<p>Votre mdp : " . $_SESSION['mdp'] . " </p>";?>

    </article>
</section>
<!--les sujets les plus actifs-->
<aside>
    <h2>???</h2>
    <ul>
        <li>

        </li>
        <li>

        </li>
        <li>

        </li>
    </ul>
</aside>