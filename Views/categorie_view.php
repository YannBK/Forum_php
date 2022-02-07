<!--Liste des catégories-->
<aside>
    <h2>Catégories</h2>
    <div>
        <?= $catListe; ?>
    </div>
</aside>

<!--les sujets-->
<section>
    <h2><?= $titreCat ?></h2>

    <article>
        <?= $sujetListe ?>
    </article>
</section>
<!--les sujets les plus actifs-->
<aside>

    <h2>Les sujets les plus actifs</h2>
    <?= $cardSujetActif ?>
</aside>