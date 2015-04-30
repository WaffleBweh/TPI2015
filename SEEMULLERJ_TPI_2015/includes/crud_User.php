<?php
/*
======Crud utilisateur=======
Auteur: 	Seemuller Julien
Classe: 	I.IN-P4B
Date:		30/04/2015
Version:	1.0
Description:    Script contenant les fonctions en relation avec le 
                l'identification et le crud user (create, read, update, delete)
*/

require_once 'basics_bdd.php';

function getUserByPseudo($pseudo) {
    $dbc = connection();
    $req = "SELECT * FROM users WHERE username=:pseudo";
    // preparation de la requete
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $requPrep->execute();
    $data= $requPrep->fetch(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
    return $data;
}

function userConnect($username, $password) {
    $connect = false;
    $_SESSION['username']= $username;
    $user = getUserbyPseudo($username);
    if ($user != NULL && $user->password === hashPerso($password)) {
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['admin'] = $user->is_admin;
        $connect = TRUE;
    }
    return $connect;
}