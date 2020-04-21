<!--2) Création d'un système d'authentification avec les pages suivantes :
    - page de connexion
        -> Accessible uniquement aux personnes non connectées-->
<?php
//Inclusion de la fonction isConnected()
require 'parts/functions.php';

//Démarrage de la session
session_start();

//Si l'utilisateur n'est pas déjà connecté 
if(!isConnected()){
    //Traitement du formulaire

    //appel des variables
    if(isset($_POST['email']) && isset($_POST['password'])){
        
        //blocs des verifs

        //Vérification de l'email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Vous devez saisir un email valide !';
        }

        //Vérification du mot de passe
        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !.@#=<>]).{8,1000}$/', $_POST['password'])){
            $errors[] = "Vous devez saisir un mot de passe avec au moins une min, une MAJ, une lettre et un caractère spécial";
        }

        //Si pas d'erreurs
        if(!isset($errors)){
            //Connexion à la BDD
            //Connexion à la BDD
            try{
                $bdd = new PDO('mysql:host=localhost; dbname=projet_php; charset=utf8', 'root', '');

                //Affichage des erreurs SQL
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème de connexion à la BDD: '. $e->getMessage());
            }

            //Vérification que l'email existe dans la BDD
            $response = $bdd->prepare("SELECT email FROM users WHERE email = ?");
            //execution de la requête
            $response->execute([
                $_POST['email']
            ]);

            //Réponse de la requête enregistré dans variable $user_mail
            $user_mail = $response->fetch();
            
            //Si $user_mail est vide, donc si l'email n'existe pas dans $user_mail
            if(empty($user_mail)){
                $errors[] = 'Cette adresse email est inconnu ! Veuillez vous inscrire avant de continuer';
            }

        
            //Création message de succès
            $successMessage = 'Vous êtes bien connectés !';

            //Création d'un sous-tableau "user" 
            $_SESSION['user'] = array(
                'email' => $_POST['email'], //Contient le nom envoyés par le formulaire
                'password' => $_POST['password'] //Contient le password envoyés par le formulaire
            );
    }

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
    <title>Connexion</title>
</head>
<body>
    <?php
    //inclusion du menu 
    include'parts/menu.php';
    ?>


    
    <h1>Connexion</h1>

    <div class="container">
        <div class="row">
            <form class="col-12 col-md-6 offset-md-3 my-5" action ="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <input type="submit" class="btn btn-success col-132 my-2" value="Connexion">
            </form>

        </div>
    </div>
    
        
        
        
        
    












    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
    <script src="js/script.js"></script>
</body>
</html>