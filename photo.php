<?php
    include "connexion.php";
    $connexion = connexionPDO();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="accueil photo">
    <form method="post">
        <fieldset>
            <legend>Choix du type de l'article</legend>
            <?php
                $requete = "select * from type";
                $stmt    = $connexion->prepare($requete);
                $stmt->execute();
                $lesTyp = $stmt->fetchAll(PDO::FETCH_OBJ);
                echo "<select name='type'>";
                foreach ($lesTyp as $unTyp) {
                    $selected = (isset($_POST['type']) && $_POST['type'] == $unTyp->idtype) ? 'selected' : '';
                    echo "<option value='$unTyp->idtype' $selected>$unTyp->nomtype</option>";
                }
                echo "</select>";
            ?>
            <input type='submit' value='Choisir' name='choisir'/>
        </fieldset>
    </form>
    <?php
        if (isset($_POST['choisir'])) {
            $requete = "select titrephoto, textephoto, imagephoto, nomtype, titrearti, textearti from type
                        INNER JOIN article on type.idtype = article.idtype
                        INNER JOIN photo on article.idarti = photo.idarti
                        where type.idtype = :type";
            $stmt = $connexion->prepare($requete);
            $stmt->execute([
                ':type' => $_POST['type'],
            ]);
            $lesim = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo "<table border='1' class='photo'>";
            echo "<tr><th>Titre</th><th>Texte</th><th>Image</th></tr>";
            foreach ($lesim as $unim) {
                echo "<tr class='moreinfo'>";
                echo "<td>$unim->titrephoto</td>";
                echo "<td>$unim->textephoto</td>";
                echo "<td><img src='image/$unim->imagephoto' alt='$unim->titrephoto' width='200'></td>";
                echo "</tr>";
                echo "<tr class='info'>";
                echo "<td class='infotext'colspan='3'><h2>$unim->titrearti</h2><br>$unim->textearti</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</div>
</body>
</html>
