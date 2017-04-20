<?php

// Connecter à la bdd
try
{
    $bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u994683669_sylva;charset=utf8', 'u994683669_aurel', 'albatros85', array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
}

catch(Exception $e)
{
    die('Erreur : ' . $e-getMessage());
}

// On récupère les 4 dernières news
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_ecriture FROM actus ORDER BY date DESC LIMIT 0, 4');

// On quitte le PHP pour créer le début de page 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Les actus de La Rochelle </title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>
        <h1> Les actus de La Rochelle </h1>
        <p> Les dernières informations du blog de Benjamin </p>


<?php 
// Réouverture de php pour continuer 

while ($donnees = $req->fetch())
{
?>
<div class="actu">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em> le <?php echo $donnees['date_ecriture']; ?> </em>
        </h3>

        <p>
            <?php echo nl2br(htmlspecialchars($donnees['contenu']));
            ?>
            <br />
            <em><a href="commentaires.php?actu=<?php echo $donnees['id']; ?>"> Commentaires </a></em>
            </p>
            </div>
            <?php 

}
// Fin de la boucle while

$req->closeCursor();
?>
</body>
</html>








