<?php
//inclusion de ma fonction isConnected() et isAdmin()
require 'parts/functions.php';

//démarrage de la session
session_start();

//Connexion à la BDD
try{
    $bdd = new PDO('mysql:host=localhost; dbname=projet_php; charset=utf8', 'root', '');

    //Affichage des erreurs SQL
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){
    die('Problème de connexion à la BDD: '. $e->getMessage());
}

//Requête préparée pour récupérer la liste des articles
$response = $bdd->query('SELECT * FROM articles');

//Conversion des éléments en tableau associatif
$articles = $response->fetchAll(PDO::FETCH_ASSOC);

//fermeture de la requête
$response->closeCursor();


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

    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5">Liste des articles</h1>
        </div>
    </div>

    


    <?php

    //Si la table articles est vide, on affiche une erreur 
    if(empty($articles)){
        echo '<div class="row"><p class="alert alert-success col-6 text-center" style="color:red;">Pas encore d\'articles ! </p></div>';
    } else{ //Sinon on les affiche dans un tableau
        ?>
         <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date de parution</th>
                    </tr>
                </thead>
                <tbody>
                

                <?php
        foreach($articles as $article){
            
                echo '<tr><td>' . $article['title'] . '</td>';
            ?>
            </tr>
            <tr>
            <?php
            echo '<td>' . $article['author'] . '</td>';
            ?>
            </tr>
            <tr>
            <?php
            echo '<td>' . $article['create_date'] . '</td>';
            ?>
            </tr>
            

            <?php
        }
        ?>
        </tbody>
        </table>
        
        

    <?php
    }
    ?>

    

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script><!--Lien vers le fichier jquery de bootstrap à placer avant la fermeture du body-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
</body>
</html>