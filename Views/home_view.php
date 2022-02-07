<!--liste des catégories-->
<aside id="asideL">
    <h2>Catégories</h2>
    <div>
        <?= $catListe; ?>
    </div>
</aside>

<!--les sujets-->
<!-- <jour> -->
<section>
    <h2>Sujets</h2>
    
    <!-- <div> -->
    <a href="index.php?p=creerArticle">Créez votre sujet !</a>
    <!-- </div> -->
    <article>
        <?= $sujetListe ?>
    </article>
</section>
<!--les sujets les plus actifs-->
<aside id="asideR">

    <h2>Les sujets les plus actifs</h2>
    <?= $cardSujetActif ?>
</aside>
<!-- </jour> -->