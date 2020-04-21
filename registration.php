<?php

//Inclusion de la fonction de vérification recaptcha
require 'recaptchavalid.php';
require 'parts/functions.php';

//page d'inscription
//-> Accessible uniquement aux personnes non connectées
//-> Si l'email est déjà utilisé par un autre compte, créer une erreur au lieu de créer le compte//

//Démarrage de la session
session_start();

//Si l'utilisateur n'est pas déjà connectés
if(!isConnected()){
    //Traitement du formulaire

    //Appel des variables
    if(
        isset($_POST['email']) &&
        isset($_POST['password1']) &&
        isset($_POST['password2']) &&
        isset($_POST['firstname']) &&
        isset($_POST['lastname']) &&
        isset($_POST['g-recaptcha-response'])
    ){
        //Blocs des vérifs

        //Vérifs de l'email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email invalide';
        }

        //Vérif du mot de passe
        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !.@#=<>]).{8,1000}$/', $_POST['password1'])){
            $errors[] = "Vous devez saisir un mot de passe avec au moins une min, une MAJ, une lettre et un caractère spécial";
        }

        //Vérif de la confirmation du mot de passe
        if($_POST['password2'] != $_POST['password1']){
            $errors[] = 'Vous devez saisir le même mot de passe';
        }

        //Vérif du firstname
        if(!preg_match('/^.{2,50}$/', $_POST['firstname'])){ 
            $errors[] = 'Votre prénom doit être un prénom valide ';
        }

        //Vérif du lastname
        if(!preg_match('/^.{2,50}$/', $_POST['lastname'])){ 
            $errors[] = 'Votre prénom doit être un prénom valide ';
        }

        //Vérif du recaptcha
        if(!recaptcha_valid($_POST['g-recaptcha-response'], $_SERVER ['REMOTE_ADDR'])){ //$_SERVER('REMOTE_ADDR) permet de récupérer l'IP de l'user
            $errors[] = "Captcha invalide ";
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

            
            //Vérification que l'email n'existe pas déjà
            $response = $bdd->prepare("SELECT email FROM users WHERE email = ?");
            
            //execution de la requête
            $response->execute([
                $_POST['email']
            ]);

            //Réponse de la requête enregistré dans variable $user
            $user = $response->fetch();
            
            //Si $user n'est pas vide, donc si l'email existe déjà dans $user
            if(!empty($user)){
                $errors[] = 'Cette adresse email est déjà utilisé !';
            }

            //Si pas d'erreur nulle part
            if(!isset($errors)){
                //requête préparé pour création et insertion d'un nouveau compte dans table users
                $response = $bdd->prepare('INSERT INTO users(email, password, firstname, lastname, admin, register_date, activated, register_token) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');

                //exécution de la requête
                $response->execute([
                $_POST['email'],
                password_hash($_POST['password1'], PASSWORD_BCRYPT),
                $_POST['firstname'], 
                $_POST['lastname'], 
                0, 
                date('Y-m-d H:i:s'), 
                0,
                0
                ]);


                //si l'insertion a bien fonctionné
                if($response->rowCount() > 0){
                    //Création message de succès
                    $successMessage = 'Formulaire envoyé !';
                } else{
                    $errors[] = "Problème avec la base de données, veuillez ré-essayer !";
                }

                //Fermeture de la requête
                $response->closeCursor();


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
    <title>Inscription</title>
    <script src="https://www.google.com/recaptcha/api.js"></script> <!--Lien permettant de récupérer le recaptcha de google, a insérer juste avant la fermeture de </head>-->
</head>
<body>
    <?php
    //inclusion du menu 
    include'parts/menu.php';
    ?>


    
    <h1>Inscription</h1>

    <?php

    //Affichage des erreurs s'il y en a
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">'.$error. '</p>';
        }
    }

    //Affichage du message de succès et display none du formulaire si pas d'erreurs
    if(isset($successMessage)){
        echo '<p style="color:green;">' . $successMessage . '</p>';
    } else{
        ?>

        <div class="container">
            <div class="row">
                <form class="col-12 col-md-6 offset-md-3 my-5" action ="" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password1">Mot de passe</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirmation de mot de passe</label>
                        <input type="password" class="form-control" id="password2" name="password2">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" name="firstname" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" class="form-control"  name="lastname" id="lastname">
                    </div>
                    <div>
                        <div class="g-recaptcha" data-sitekey="6LdcwusUAAAAANsrL9Im7g4HYATJAPuhcBua24qn"></div>
                    </div>
                    <input type="submit" class="btn btn-success col-132 my-2" value="Connexion">
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