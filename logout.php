<?php

//inclusion de la fonction isConnected()
require 'parts/functions.php';

//démarrage de la session: nécessaire pour pouvoir utiliser les variables de session
session_start();

//Si l'utilisatezur est bien connecté 
if(isConnected()){ 
    unset($_SESSION['user']);//on détruit le tableau "user" dans la session, ce qui déconnecte l'utilisateur//session_destroy(); aurait tout supprimé la session alors que la on veut juste supprimer les identifiants de connexion
    $success = true; //création d'une variable success
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //inclusion du menu HTML
    include 'parts/menu.php';

    ?>

    <div class="container">
        <div class="row">
            <h1>Déconnexion</h1>
        
    
    

    <?php

    //Si l'utilisateur est connecté -> si $success = true: on affiche message confirmant la déconnexion, sinon message d'erreur
    if(isset($success)){
        echo '<p class="alert alert-success col-12">Vous avez bien été déconnecté ! <a href="index.php">Cliquez ici pour revenir à l\'accueil</a></p>';
    } else{
        echo '<p style="color:red;">Vous êtes déjà déconnectés !</p>';
    }
    ?>
        </div>
    </div>

</body>
</html>