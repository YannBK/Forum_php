
<a href="index.php?p=home">Accueil</a>
<div class="divCreerArticle">
    <div>        
        <h2>Rédigez votre sujet</h2>
    </div>
    <form action="" method="POST">
        <label for="nom_sujet">Nom du sujet</label>
        <input type="text" name="nom_sujet" min="2" max="50">
        <label for="cat_sujet">Catégorie</label>
        <select name="cat_sujet" id="cat_sujet">
            <?= $options ?>
        </select>
        <label for="contenu_sujet">Votre magnifique texte ici :</label>
        <textarea name="contenu_sujet" cols="80" rows="20" style="margin-top:10px;"></textarea>
        <input type="submit" name="CreaSujet" value="Poster l'article">
        <p><?= $result ?></p>
        <p><?= $dates ?></p>
    </form>
</div>

