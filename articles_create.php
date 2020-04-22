<?php
//Inclusion de ma fonction isConnected()
require 'parts/functions.php';

//Démarrage de la session
session_start();

//Appel des variables
if(
    isset($_POST['title']) &&
    isset($_POST['content'])
){
    //Blocs des vérifs

    //Vérif du titre
    if(!preg_match('/^.{2,150}$/', $_POST['title'])){
        $errors[] = 'Votre titre doit contenir entre 2 et 150 caractères !';
    }

    //Vérif du contenu
    if(!preg_match('/^.{2,20000}$/', $_POST['content'])){
        $errors[] = 'Votre article ne doit pas dépasser 20 000 caractères';
    }

    //Si pas d'erreurs
    //Connexion à la BDD
    try{
        $bdd = new PDO('mysql:host=localhost; dbname=projet_php; charset=utf8', 'root', '');

        //Affichage des erreurs SQL
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(Exception $e){
        die('Problème de connexion à la BDD: '. $e->getMessage());
    }

    //requête préparée pour création et insertion d'un nouvel article
    $response = $bdd->prepare('INSERT INTO articles(author, create_date, title, content) VALUES(?, ?, ?, ?)');

    //exécution de la requête
    $response->execute([
        $_SESSION['user']['id'],
        date('Y-m-d H:i:s'),
        $_POST['title'],
        $_POST['content']
    ]);

    //Si l'insertion a bien fonctionné
    //si l'insertion a bien fonctionné
    if($response->rowCount() > 0){
        //Création message de succès
        $successMessage = 'Votre article a bien été créer !';
    } else{
        $errors[] = "Problème avec la base de données, veuillez ré-essayer !";
    }

    //Fermeture de la requête
    $response->closeCursor();
}

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

        <?php
        //Affichage des erreurs s'il y en a
        if(isset($errors)){
            foreach($errors as $error){
                echo '<div class="row"><p class="alert alert-success col-6 text-center" style="color:red;">' . $error . '</p></div>'; 
            }
        }

        //Affichage du message de succès s'il existe et display none du formulaire
        if(isset($successMessage)){
            echo '<div class="row"><p class="alert alert-success col-12" style="color:green;"> ' . htmlspecialchars( $successMessage ) . ' . Cliquez <a href="articles.php">ici</a> pour le visualiser.</p></div>';
        } else{

            ?>

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

        <?php
        }
        ?>






    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
</body>
</html>