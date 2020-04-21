<?php
//Inclusion de la fonction isConnected()
require 'functions.php';
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
    <title>Menu</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Pouponnières d'étoiles</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Articles</a>
            </li>
            <?php
            //Affichage de la page de déconnexion et profil si l'utilisateur est connecté
            if(isConnected()){
                echo '<li class="nav-item">
                <a class="nav-link" href="profil.php" >Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php" >Déconnexion</a>
            </li>';
            } else{ //Affichage de la page de connexion et d'inscription si on est pas connecté
                echo '<li class="nav-item">
                    <a class="nav-link" href="login.php" >Connexion</a>
                    </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php" >Inscription</a>
            </li>';
            };

            ?>
            
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Chercher un article">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
            </button>
            </form>
        </div>
    </nav>
   
</body>
</html>