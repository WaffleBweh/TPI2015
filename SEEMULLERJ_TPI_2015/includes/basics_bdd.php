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
    $req = "SELECT COUNT(*) FROM $table";

    $requPrep = $dbc->prepare($req);
    $requPrep->execute();

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
    $req = "SELECT COUNT(*) FROM $table $condition";

    $requPrep = $dbc->prepare($req);
    $requPrep->execute();

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
    $req = "SELECT * FROM $table WHERE id=:id";
    // preparation de la requete
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();

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
    $req = "SELECT * FROM $table WHERE id=:id $condition";
    $requPrep = $dbc->prepare($req);
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();

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
    $req = "SELECT * FROM $table";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
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
    $req = "SELECT * FROM $table $condition";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
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
    $req = "DELETE FROM $table WHERE id=:id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
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
    $req = "DELETE FROM $table $condition";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':id', $id, PDO::PARAM_INT);
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
}