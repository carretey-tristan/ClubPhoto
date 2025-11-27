<?php
    include "connexion.php";
    $connexion = connexionPDO();
    $requete   = "SELECT idphotographe, nomphotographe, prenomphotographe FROM photographe WHERE idphotographe != 0";
    $stmt      = $connexion->prepare($requete);
    $stmt->execute();
    $lesphotographes = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST['modifier'])) {
        $id      = $_POST['id'];
        $nom     = $_POST['nom'];
        $prenom  = $_POST['prenom'];
        $requete = "UPDATE photographe SET nomphotographe = :nom, prenomphotographe = :prenom WHERE idphotographe = :id and idphotographe !=0";
        $stmt    = $connexion->prepare($requete);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Refresh:0");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Photographes</title>
    <link rel="stylesheet" href="config/global.css">
</head>
<body>
    <fieldset class='accueil photo'>
        <h1>Liste des Photographes</h1>
        <table border="1" class="ArticleTable">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th>
            </tr>
            <?php foreach ($lesphotographes as $photographe): ?>
                <tr>
                    <td><?php echo htmlspecialchars($photographe->nomphotographe); ?></td>
                    <td><?php echo htmlspecialchars($photographe->prenomphotographe); ?></td>
                    <td><a href="index.php?page=photographe&id=<?php echo $photographe->idphotographe; ?>">Modifier</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php
            if (isset($_GET['id'])) {
                $id      = $_GET['id'];
                $requete = "SELECT nomphotographe, prenomphotographe FROM photographe WHERE idphotographe = :id";
                $stmt    = $connexion->prepare($requete);
                $stmt->execute([':id' => $id]);
                $photographe = $stmt->fetch(PDO::FETCH_OBJ);

                if (isset($_SESSION['id']) && ($_SESSION['id'] == $id || $_SESSION['id'] == 0)) {
                    echo "<div class='modif'>";
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='id' value='$id'>";
                    echo "<input type='text' name='nom' value='" . htmlspecialchars($photographe->nomphotographe) . "' required>";
                    echo "<br>";
                    echo "<input type='text' name='prenom' value='" . htmlspecialchars($photographe->prenomphotographe) . "' required>";
                    echo "<br>";
                    echo "<input type='submit' name='modifier' value='Modifier'>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<p>Vous n'avez pas la permission de modifier ces informations.</p>";
                }
            }
        ?>

    </fieldset>
</body>
</html>