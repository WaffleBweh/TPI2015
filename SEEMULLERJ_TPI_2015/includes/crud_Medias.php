<?php
/*
  ======Crud Medias=======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		25/11/2014
  Version:	1
  Description:    Script contenant les fonctions en relation avec le crud medias
  (create, read, update, delete)
 */

require_once 'basics_bdd.php';
$tableMedias = 'medias';


/** getMedias
 * Recupère la liste de tous les medias
 * @return type
 */
function getMedias() {
    global $tableMedias;
    $dbc = connection();
    $req = "SELECT * FROM $tableMedias";
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getMediaById
 * Recupère le media en fonction de l'id donné en paramère
 * @param type $id
 * @return type
 */
function getMediaById($id) {
    global $tableMedias;
    return getFieldById($id, $tableMedias);
}

function addMedia($src, $isImage){
    global $tableMedias;

    $dbc = connection();
    $req = "INSERT INTO $tableMedias (src, isImage) VALUES (:source, :isImage)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':source', $src, PDO::PARAM_STR);
    $requPrep->bindParam(':isImage', $isImage, PDO::PARAM_BOOL);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();

}