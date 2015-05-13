<?php

/*
+---------------+----------------------------------------------------------------------+
|  BASICS BDD   |                                                                      |
+---------------+----------------------------------------------------------------------+
| Auteur :      | SEEMULLER Julien                                                     |
| Classe :      | I.IN-P4B                                                             |
| Date :        | 08.05.2015                                                           |
| Version :     | 1.0                                                                  |
|               |                                                                      |
| Description : | Script contenant les fonctions basiques relative à la base de donnée |
|               | -> Connexion base de donnée (PDO)                                    |
|               | -> Retourne le nombre d'enregistrement dans la table donnée          |
|               | -> Retourne un enregistrement par rapport à l'id                     |
|               | -> Retourne tout les enregistrements d'une table donnée              |
|               | -> Supprime un enregistrement de la table donnée par rapport à l'id  |
+---------------+----------------------------------------------------------------------+
 */

require_once 'constantes.php';

/** connection
 * Fonction qui retourne une connexion PDO à une base de donnée mysql ou une erreur.
 * @return PDO
 */
function connection() {
    // On essaie de se connecter à la base à l'aide d'informations contenues
    // dans des constantes, si cela échoue, on renvoie FALSE et si on s'est bien
    // connecté à la base de donnée, on renvoie TRUE
    try {
        $bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_LOGIN, DB_PASS, array(PDO::ATTR_PERSISTENT => true));

        return $bdd;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

/** countFields
 * Fonction qui retourne le nombre total d'enregistrement d'une table 
 * passée en paramètre
 * @param $table string 
 * @return Integer
 */
function countFields($table) {
    $dbc = connection();
    $dbc->quote($table);
    //On compte tous les champs de la table donnée en paramètre
    $req = "SELECT COUNT(*) FROM $table";
    
    //On prépare la requete
    $requPrep = $dbc->prepare($req);
    $requPrep->execute();
    
    //On récupère le nombre de champs dans un array
    $number = $requPrep->fetch();
    $requPrep->closeCursor();
    return $number[0];
}

/** countFieldsCondition
 * Fonction qui retourne le nombre total d'enregistrement d'une table selon une 
 * condition passée en parametre
 * @param string $table
 * @param string $condition
 * @return type
 */
function countFieldsCondition($table, $condition) {
    $dbc = connection();
    $dbc->quote($table);
    $dbc->quote($condition);
    //On compte tous les champs de la table donnée en paramètre
    //et on ajoute une condition
    $req = "SELECT COUNT(*) FROM $table $condition";
    
    //On prépare la requete
    $requPrep = $dbc->prepare($req);
    $requPrep->execute();
    
    //On récupère le nombre de champs dans un array
    $number = $requPrep->fetch();
    $requPrep->closeCursor();
    return $number[0];
}

/** getFieldById
 * Cette fonction récupère un enregistrement de la table donnée en paramètre grâce à 
 * l'id également donnée en paramètre
 * @param Integer $id
 * @param String $table
 * @return PDO::FETCH_OBJ
 */
function getFieldById($id, $table, $type = PDO::FETCH_OBJ) {
    $dbc = connection();
    $dbc->quote($table);
    //On récupère le champ avec l'id correspondant à celui envoyé en paramètre
    $req = "SELECT * FROM $table WHERE id=:id";
    //On prépare la requete
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    //On renvoie le résultat dans format spécifique, (Par défaut : objet)
    return $requPrep->fetch($type);
}

/** getFieldByIdCondition
 * Cette fonction récupère un enregistrement de la table donnée en paramètre grâce à 
 * l'id également donnée en paramètre et une condition
 * @param Integer $id
 * @param String $table
 * @return PDO::FETCH_OBJ
 */
function getFieldByIdCondition($id, $table, $condition) {
    $dbc = connection();
    $dbc->quote($table);
    //On récupère le champ avec l'id correspondant à celui envoyé en paramètre
    //et on ajoute une condition
    $req = "SELECT * FROM $table WHERE id=:id $condition";
    //On prépare la requete
    $requPrep = $dbc->prepare($req);
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    //On renvoie un objet contenant le résultat
    return $requPrep->fetch(PDO::FETCH_OBJ);
}

/** getAllFields
 * Cette fonction retourne tous les enregistrements de la table passée en paramètre
 * @param String $table
 * @return PDO::FETCH_OBJ
 */
function getAllFields($table) {
    $dbc = connection();
    $dbc->quote($table);
    //On récupère tous les champs de la table donnée en paramètre
    $req = "SELECT * FROM $table";
    //On prépare la requete
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
    //On renvoie un tableau d'objets contenant les données
    return $data;
}

/** getAllFieldsCondition
 * Cette fonction retourne tous les enregistrements de la table passée en paramètre avec une condition
 * @param string $table
 * @param string $condition
 * @return PDO::FETCH_OBJ
 */
function getAllFieldsCondition($table, $condition) {
    $dbc = connection();
    $dbc->quote($table);
    $dbc->quote($condition);
    //On récupère tous les champs de la table donnée en paramètre
    //et on ajoute une condition
    $req = "SELECT * FROM $table $condition";
    
    //On prépare la requete
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
    //On renvoie un tableau d'objets contenant les données
    return $data;
}

/** deleteFieldById
 * Cette fonction supprime un enregistrement de la table donnée en paramètre grâce à 
 * l'id également donnée en paramètre
 * @param Integer $id
 * @param String $table
 */
function deleteFieldById($id, $table) {
    $dbc = connection();
    $dbc->quote($table);
    //On supprime le champ correspondant à l'id passé en paramètre
    //dans la table passé en paramètre
    $req = "DELETE FROM $table WHERE id=:id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    $requPrep->closeCursor();
}

/** deleteFieldByIdCondition
 * Cette fonction supprime un enregistrement de la table donnée en paramètre grâce à 
 * l'id également donnée en paramètre et une condition supplémentaire
 * @param type $id
 * @param type $table
 * @param type $condition
 */
function deleteFieldByIdCondition($id, $table, $condition) {
    $dbc = connection();
    $dbc->quote($table);
    //On supprime le champ correspondant à l'id passé en paramètre
    //dans la table passé en paramètre et on ajoute une condition
    $req = "DELETE FROM $table $condition";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    $requPrep->closeCursor();
}