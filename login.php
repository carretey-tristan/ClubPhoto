
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="config/global.css" />
    <title>Connexion</title>

</head>
<body>
    <div class="accueil">
        <form action="" method="post">
            <h1>Connexion</h1>
            <input type="text" name="util" placeholder="Nom d'utilisateur" required />
            <input type="password" name="mdp" placeholder="Mot de passe" required />
            <input type="submit" value="Connexion" name="submit" />
            <p>Vous êtes nouveau ici ? <a href="index.php?page=inscription">S'inscrire</a></p>
        </form>
        </br>
        </br>
        <?php
            if (isset($_POST['util'], $_POST['mdp'])) {
                include "connexion.php";
                $connexion = connexionPDO();
                $util      = $_POST['util'];
                $pass      = $_POST['mdp'];
                $requete   = "SELECT * FROM photographe WHERE nomphotographe = :util";
                $stmt      = $connexion->prepare($requete);
                $stmt->bindParam(':util', $util);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                if ($result && password_verify($pass, $result->password)) {
                    $_SESSION['username'] = $result->nomphotographe;
                    $_SESSION['id']       = $result->idphotographe;
                    header("Location: index.php");
                    exit;
                } else {
                    echo "<div>Erreur lors de la connexion.</div>";
                }
            }
        ?>
    </div>
</body>
</html>