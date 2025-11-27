<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="config/global.css">
    <title>Document</title>
</head>
<body>
    <div class="accueil">
        <form action="" method="post">
            <h1>S'inscrire</h1>
            <input type="text" name="util" placeholder="Nom d'utilisateur" required />
            <input type="text" name="pren" placeholder="prénom d'utilisateur" required />
            <input type="password" name="mdp" placeholder="Mot de passe" required />
            <input type="submit" name="submit" value="S'inscrire" />
            
            <?php
            include "connexion.php";
            $connexion = connexionPDO();
            $inscription_reussie = false;
            
            if (isset($_POST['util'], $_POST['mdp'])){
                $pass = $_POST['mdp'];
                $hash = password_hash($pass, PASSWORD_BCRYPT);
                $requete = "INSERT INTO photographe VALUES (null, :util, :pren, :hash)";
                $stmt = $connexion->prepare($requete);
                $stmt->bindParam(':util', $_POST['util']);
                $stmt->bindParam(':pren', $_POST['pren']);  
                $stmt->bindParam(':hash', $hash);
                $stmt->execute();
                
                if($stmt){
                    $inscription_reussie = true;
                    echo "<div class='success-message'>Vous êtes inscrit avec succès. <a href='login.php'>Connectez-vous ici</a></div>";
                } else {
                    echo "<div class='error-message'>Erreur lors de l'inscription.</div>";
                }
            }
            ?>
            
            <?php if (!$inscription_reussie): ?>
                <p>Déjà inscrit ? <a href="index.php?page=login">Connectez-vous ici</a></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>