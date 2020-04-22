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

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
</body>
</html>