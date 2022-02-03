<!-- liste des catégories -->
<aside>
    <h2>Catégories</h2>
    <div>
        <?= $catListe; ?>
    </div>
</aside>

<!-- affichage de la liste des sujets -->
<div> 
    <div class="divSujet">
        <?= $cardSujet ?>
    </div>
    <div>
        <CreaCom>
            <form action="" method="POST">
                <ul>
                    <li>
                        <label for="commentaire">Votre commentaire :</label>
                        <textarea name="commentaire" cols="100" rows="10"></textarea>
                    </li>
                    <li>
                        <input type="submit" name="publier" value="Publier votre commentaire">
                    </li>
                </ul>
            </form>
        </CreaCom>
        <?= $listeCom ?>
    </div>
</div>

<!-- sujets actifs -->
<aside>
    <h2>Les sujets les plus actifs</h2>
    <ul>
        <li>
            <p>Sujet</p>
            <p>auteur</p>
            <p>nombre reponses</p>
        </li>
        <li>
            <p>Sujet</p>
            <p>auteur</p>
            <p>nombre reponses</p>
        </li>
        <li>
            <p>Sujet</p>
            <p>auteur</p>
            <p>nombre reponses</p>
        </li>
    </ul>
</aside>