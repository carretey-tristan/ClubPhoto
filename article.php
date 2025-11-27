<?php
    include "connexion.php";
    $connexion = connexionPDO();

    $requete = "SELECT article.idarti, article.datearti, article.titrearti, article.textearti, type.nomtype, photographe.nomphotographe, photographe.prenomphotographe, article.idphotographe
            FROM article
            INNER JOIN type ON article.idtype = type.idtype
            INNER JOIN photographe ON article.idphotographe = photographe.idphotographe";
    $stmt = $connexion->prepare($requete);
    $stmt->execute();
    $lesart = $stmt->fetchAll(PDO::FETCH_OBJ);

    $requete = "SELECT idtype, nomtype FROM type";
    $stmt    = $connexion->prepare($requete);
    $stmt->execute();
    $lestypes = $stmt->fetchAll(PDO::FETCH_OBJ);

    $requete = "SELECT idphotographe, nomphotographe, prenomphotographe FROM photographe WHERE idphotographe != 0";
    $stmt    = $connexion->prepare($requete);
    $stmt->execute();
    $lesphotographes = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['creer_article'])) {
        $titre         = $_POST['titre'];
        $texte         = $_POST['texte'];
        $idtype        = $_POST['idtype'];
        $idphotographe = isset($_POST['idphotographe']) ? $_POST['idphotographe'] : $_SESSION['id'];
        $date          = date('Y-m-d');

        $requete = "INSERT INTO article (titrearti, datearti, textearti, idphotographe, idtype) VALUES (:titre, :date, :texte, :idphotographe, :idtype)";
        $stmt    = $connexion->prepare($requete);
        $stmt->execute([
            ':titre'         => $titre,
            ':date'          => $date,
            ':texte'         => $texte,
            ':idphotographe' => $idphotographe,
            ':idtype'        => $idtype,
        ]);
        header("Location: index.php?page=article");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer_article'])) {
        $idarti = $_POST['idarti'];

        // Supprimer les photos associées à l'article
        $requete = "DELETE FROM photo WHERE idarti = :idarti";
        $stmt    = $connexion->prepare($requete);
        $stmt->execute([':idarti' => $idarti]);

        // Supprimer l'article
        $requete = "DELETE FROM article WHERE idarti = :idarti";
        $stmt    = $connexion->prepare($requete);
        $stmt->execute([':idarti' => $idarti]);

        header("Location: index.php?page=article");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer_photo'])) {
        $idphoto = $_POST['idphoto'];
        $requete = "DELETE FROM photo WHERE idphoto = :idphoto";
        $stmt    = $connexion->prepare($requete);
        $stmt->execute([':idphoto' => $idphoto]);
        header("Location: index.php?page=article&id=" . $_POST['idarti']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
</head>
<body>
<fieldset class='accueil photo'>
    <?php
        if (! isset($_GET['id'])) {
            echo "<table border='1' class='ArticleTable'>";
            echo "<tr>";
            echo "<th>Date</th>";
            echo "<th>Titre</th>";
            echo "<th>Texte</th>";
            echo "<th>Type</th>";
            echo "<th>Photographe</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            foreach ($lesart as $unart) {
                echo "<tr>";
                echo "<td>$unart->datearti</td>";
                echo '<td><a href="index.php?page=article&id=' . $unart->idarti . '">' . $unart->titrearti . '</a></td>';
                echo "<td>$unart->textearti</td>";
                echo "<td>$unart->nomtype</td>";
                echo "<td>$unart->nomphotographe $unart->prenomphotographe</td>";
                if (isset($_SESSION['id']) && ($_SESSION['id'] == $unart->idphotographe || $_SESSION['id'] == 0)) {
                    echo "<td><form action='' method='post' style='display:inline;'><input type='hidden' name='idarti' value='$unart->idarti'><input type='submit' name='supprimer_article' value='Supprimer' style='width: 80px; padding: 5px 10px; font-size: 12px; cursor: pointer;'></form></td>";
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            if (isset($_SESSION['id'])) {
                echo "<fieldset class='ajout'>";
                echo "<legend>Créer un article</legend>";
                echo "<form action='' method='post'>";
                echo '<input type="text" name="titre" placeholder="Titre de l\'article" required>';
                echo "<br>";
                echo '<textarea name="texte" placeholder="Texte de l\'article" required></textarea>';
                echo "<br>";
                echo "<select name='idtype' required>";
                foreach ($lestypes as $type) {
                    echo "<option value='$type->idtype'>$type->nomtype</option>";
                }
                echo "</select>";
                echo "<br>";
                if ($_SESSION['id'] == 0) {
                    echo "<select name='idphotographe' required>";
                    foreach ($lesphotographes as $photographe) {
                        echo "<option value='$photographe->idphotographe'>$photographe->nomphotographe $photographe->prenomphotographe</option>";
                    }
                    echo "</select>";
                    echo "<br>";
                }
                echo "<input type='submit' name='creer_article' value='Créer' style='width: 80px; padding: 5px 10px; font-size: 12px; cursor: pointer;'>";
                echo "</form>";
                echo "</fieldset>";
            }
        } else {
            echo "<a href='index.php?page=article' style='width: 80px; padding: 5px 10px; font-size: 12px; cursor: pointer;'>Retour</a>";
            $id = $_GET['id'];

            $requete = "SELECT article.idarti, article.titrearti, article.idphotographe, photographe.nomphotographe, photographe.prenomphotographe
                    FROM article
                    INNER JOIN photographe ON article.idphotographe = photographe.idphotographe
                    WHERE article.idarti = :id";
            $stmt = $connexion->prepare($requete);
            $stmt->execute([':id' => $id]);
            $unart = $stmt->fetch(PDO::FETCH_OBJ);

            $requete = "SELECT idphoto, titrephoto, textephoto, imagephoto FROM photo WHERE idarti = :id";
            $stmt    = $connexion->prepare($requete);
            $stmt->execute([':id' => $id]);
            $lesphotos = $stmt->fetchAll(PDO::FETCH_OBJ);

            echo "<table border='1'  class='ArticleTable'>";
            echo "<tr>";
            echo "<th>Titre</th>";
            echo "<th>Description</th>";
            echo "<th>Photo</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            foreach ($lesphotos as $photo) {
                echo "<tr>";
                echo "<td>$photo->titrephoto</td>";
                echo "<td>$photo->textephoto</td>";
                echo "<td><img src='image/$photo->imagephoto' alt='$photo->titrephoto' width='200'></td>";
                if (isset($_SESSION['id']) && ($_SESSION['id'] == $unart->idphotographe || $_SESSION['id'] == 0)) {
                    echo "<td><form action='' method='post' style='display:inline;'><input type='hidden' name='idphoto' value='$photo->idphoto'><input type='hidden' name='idarti' value='$id'><input type='submit' name='supprimer_photo' value='Supprimer' style='width: 80px; padding: 5px 10px; font-size: 12px; cursor: pointer;'></form></td>";
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            if (isset($_SESSION['id']) && ($_SESSION['id'] == $unart->idphotographe || $_SESSION['id'] == 0)) {
                echo "<fieldset class='ajout'>";
                echo "<legend>Ajouter une photo</legend>";
                echo "<form action='' method='post' enctype='multipart/form-data'>";
                echo '<input type="text" name="titre"  placeholder="Titre de la photo" required>';
                echo "<br>";
                echo '<textarea name="detail" placeholder="Détail de la photo" required></textarea>';
                echo "<br>";
                echo '<input type="file" name="photo" id="photo" required>';
                echo "<br>";
                echo '<input type="submit" name="submit" value="Ajouter" style="width: 80px; padding: 5px 10px; font-size: 12px; cursor: pointer;">';
                echo "</form>";
                echo "</fieldset>";

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $titre  = $_POST['titre'];
                    $detail = $_POST['detail'];
                    $photo  = $_FILES['photo'];

                    if ($photo['error'] == 0) {
                        $target_dir    = "image/";
                        $target_file   = $target_dir . basename($photo["name"]);
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                        $check = getimagesize($photo["tmp_name"]);
                        if ($check !== false) {
                            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                                echo "Le fichier " . htmlspecialchars(basename($photo["name"])) . " a été téléchargé.";

                                $requete = "INSERT INTO photo (titrephoto, textephoto, imagephoto, idarti) VALUES (:titre, :detail, :image, :idarti)";
                                $stmt    = $connexion->prepare($requete);
                                $stmt->execute([
                                    ':titre'  => $titre,
                                    ':detail' => $detail,
                                    ':image'  => basename($photo["name"]),
                                    ':idarti' => $id,
                                ]);
                                header("Refresh:0");
                            } else {
                                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                            }
                        } else {
                            echo "Le fichier n'est pas une image.";
                        }
                    } else {
                        echo "Erreur lors du téléchargement du fichier.";
                    }
                }
            } else {
                echo "<p>Vous devez être connecté en tant que photographe de cet article pour ajouter une photo.</p>";
            }
        }
    ?>
</fieldset>
</body>
</html>