<!-- liste des catégories -->
<aside id="asideL">
    <h2>Catégories</h2>
    <div>
        <?= $catListe; ?>
    </div>
</aside>

<!-- affichage de la liste des sujets -->
<!-- <jour> -->
    <div class="divSujet"> 
        <div class="divcardsujet">
            <?= $cardSujet ?>
        </div>
        <div>
            <?= $formCom ?>
        </div>
    </div>

    <!-- sujets actifs -->
    <aside>
        <h2>Les sujets les plus actifs</h2>
        <?= $cardSujetActif ?>
    </aside>
<!-- </jour> -->