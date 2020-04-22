<?php
//inclusion de la fonction isConnected()
require 'parts/functions.php';

//démarrage de la session 
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><!--Lien vers css de bootstap-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <title>Profile</title>
</head>
<body>
    <?php
    //Inclusion du menu
    include 'parts/menu.php'
    ?>

    <div class="container">
        <div class="row">
        <h1 class="text-center col-12 mt-5">Mon profile</h1>
        </div>
    </div>
    
    <!--Mon tableau d'infos-->
    <?php
    //Si l'utilisateur est connecté, affichage tableau avec ses infos tirés depuis la session, sinon affichage message d'erreur
    if(isConnected()){
        echo '<div class="row"> <div class="col-md-6 offset-md-3 my-4"><ul class="list-group">
        <li class="list-group-item"><strong>Email</strong> : ' . htmlspecialchars($_SESSION['user']['email']) . '</li>
        <li class="list-group-item"><strong>Prénom</strong> : ' . htmlspecialchars($_SESSION['user']['firstname']) . '</li>
        <li class="list-group-item"><strong>Nom</strong> : ' . htmlspecialchars($_SESSION['user']['lastname']) . '</li>
        <li class="list-group-item"><strong>Status</strong> : Membre </li>
        <li class="list-group-item"><strong>Date d\'inscription</strong> : ' . htmlspecialchars($_SESSION['user']['register_date']) . '</li>
    </ul></div></div>';

    } else{
        echo '<p style="color:red;">Vous devez être connecté pour accéder à cette page</p>';
    }
    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
</body>
</html>