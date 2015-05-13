<?php
/*
+---------------+-------------------------------------------+
|  CRUD MEDIAS  |                                           |
+---------------+-------------------------------------------+
| Auteur :      | SEEMULLER Julien                          |
| Classe :      | I.IN-P4B                                  |
| Date :        | 08.05.2015                                |
| Version :     | 1.0                                       |
| Description : | Script contenant les fonctions            |
|               | en relation l'identification et le        |
|               | crud medias(CREATE, READ, UPDATE, DELETE) |
+---------------+-------------------------------------------+
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

/** addMedia
 * On ajoute un média dans la table medias à l'aide d'une source
 * et du champ isImage passé en paramètre
 * @global string $tableMedias
 * @param type $src
 * @param type $isImage
 * @return type
 */
function addMedia($src, $isImage){
    global $tableMedias;

    $dbc = connection();
    $dbc->quote($tableMedias);
    $req = "INSERT INTO $tableMedias (src, isImage) VALUES (:source, :isImage)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':source', $src, PDO::PARAM_STR);
    $requPrep->bindParam(':isImage', $isImage, PDO::PARAM_BOOL);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();

}