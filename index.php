<?php
//Inclusion de ma fonction isConnected()
require 'parts/functions.php';

//Démarrage de la session
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
    <title>Accueil</title>
</head>
<body>
    <?php
    //inclusion du menu 
    include'parts/menu.php';
    ?>

    <div class="row">
        <h1 class="text-center col-12">Bienvenue sur notre pouponnière d'étoiles !</h1>
        <h3 class="text-center col-12">Le premier site qui permet de consulter ou d'ajouter des objets du ciel profond !</h3>
        <p class="alert alert-info col-6 offset-3 my-4">Veuillez vous connecter pour pouvoir ajouter vos plus belles images du cosmos<br>Vous pouvez créer un compte "utilisateur" sans problème <a href="registration.php">ici</a> !<br>Pour se connecter en administrateur, vous pouvez utiliser le compte suivant :<br>Email : <strong>admin@exemple.com</strong><br>Mot de passe : <strong>aaaaaaaA7</strong></p>
    </div>

    <div class="row">
        <h2 class="text-center col-12">Les deux derniers articles parus sur le site</h2>
    </div>













    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
    <script src="js/script.js"></script>
</body>
</html>