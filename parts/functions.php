<?php

//Création d'une fonction qui permettra de savoir quand l'utilisateur est connecté, qu'on inclut dans tout les autres fichiers 
function isConnected(){
    return isset($_SESSION['user']); //retourne true si l'utilisateur est bien connecté, sinon false
}

//Création d'une fonction qui permet de savoir si l'utilisateur connecté est admin 
function isAdmin(){
    if(isConnected()){ //Si l'utilisateur est connecté
        if($_SESSION['user']['admin'] == 1){ //Si l'admin de l'utilisateur connecté = 1
            return true; //Utilisateur = Admin
        } else{
            return false;
        }
    } else{
        return false;
    }
}
?>