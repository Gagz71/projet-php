<?php

//Création d'une fonction qui permettra de savoir quand l'utilisateur est connecté, qu'on inclut dans tout les autres fichiers 
function isConnected(){
    return isset($_SESSION['user']); //retourne true si l'utilisateur est bien connecté, sinon false
}
?>