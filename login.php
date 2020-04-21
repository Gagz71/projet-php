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
            try{
                $bdd = new PDO('mysql:host=localhost; dbname=projet_php; charset=utf8', 'root', '');

                //Affichage des erreurs SQL
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème de connexion à la BDD: '. $e->getMessage());
            }

            //Vérification que l'email existe dans la BDD
            $response = $bdd->prepare("SELECT * FROM users WHERE email = ?");
            //execution de la requête
            $response->execute([
                $_POST['email']
            ]);
            //Réponse de la requête enregistré dans variable $user_mail
            $user = $response->fetch(PDO::FETCH_ASSOC);
            //Si $user_mail est vide, donc si l'email n'existe pas dans $user_mail
            if(empty($user)){
                $errors[] = 'Cette adresse email est inconnu ! Veuillez vous inscrire avant de continuer';
            } else{ //Sinon, si l'email existe
                
                //Vérification du mot de passe correspondant
                //Si c'est pas le bon mot de passe -> $errors
                if(!password_verify($_POST['password'], $user['password'])){
                    $errors[] = 'Mot de passe incorrect ! Veuillez ré-essayer';
                }
            }

            //Si pas d'erreur nulle part
            if(!isset($errors)){
                //Création message de succès
                $successMessage = 'Vous êtes bien connectés !';
                //Création d'un sous-tableau "user" 
                $_SESSION['user'] = $user;

            }
        }
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

    <?php
    //Affichage des erreurs s'il y en a
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';  //on affiche les erreurs en rouge
        }

    }

    //Affichage du message de succès
    if(isset($successMessage)){
        echo '<p style="color:green;">' . htmlspecialchars( $successMessage ) . '</p>';
    } else {
        //si l'utilisateur n'est pas connecté, on affiche le formulaire, sinon on affiche un message d'erreur
        if(!isConnected()){
    ?>

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
                <input type="submit" class="btn btn-success col-132 my-2" value="Me connecter">
            </form>
        </div>
    </div>
    <?php
        } else{
            echo '<p style="color:red;">Vous êtes déjà connecté !</p>';
        }
    }
    ?>
        
        
        
        
    












    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><!--Lien vers le fichier popper de bootstrap à placer avant la fermeture du body-->
    <script src="js/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!--Lien vers le fichier js de bootstrap à placer avant la fermeture du body-->
    <script src="js/script.js"></script>
</body>
</html>