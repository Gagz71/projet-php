<?php
//inclusion de ma fonction isConnected() et isAdmin()
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
    <title>Articles</title>
</head>
<body>
    <?php
    //Inclusion du menu
    include 'parts/menu.php';

    //Page listant tous les articles
        //-> Accessible à tous les utilisateurs (connectés, non connectés et administrateurs)
       // -> Pour les administrateurs uniquement, afficher une petite croix à côté de chaque article, permettant de le supprimer en emmenant sur la page de suppression d'article
    //avec fonction get 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
</body>
</html>