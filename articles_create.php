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
    <title>Création d'article</title>
</head>
<body>


<!--- Page de création d'un nouvel article
        -> Accessible uniquement aux administrateurs
-->
    <?php
    //inclusion du menu 
    include'parts/menu.php';
    ?>

    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5">Administration</h1>
            <h2 class="text-center col-12 mt-5">Création d'un nouvel article</h2>
        </div>

        <div class="row">
            <form action="" class="col-12 col-md-6 offset-md-3 my-5" method="POST">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <input type="submit" class="btn btn-success col-12 my-2" value="Créer">
            </form>
        </div>
    </div>






    
</body>
</html>