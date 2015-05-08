<?php
/*
+---------------+--------------------------------------------+
|  CRUD BRANDS  |                                            |
+---------------+--------------------------------------------+
| Auteur :      | SEEMULLER Julien                           |
| Classe :      | I.IN-P4B                                   |
| Date :        | 08.05.2015                                 |
| Version :     | 1.0                                        |
| Description : | Script contenant les fonctions             |
|               | en relation l'identification et le crud    |
|               | des marques (CREATE, READ, UPDATE, DELETE) |
+---------------+--------------------------------------------+
 */

require_once 'basics_bdd.php';
$tableBrands = 'brands';


/** getBrands
 * Recupère la liste de toute les marques
 * @return type
 */
function getBrands() {
    global $tableBrands;
    $dbc = connection();
    $req = "SELECT * FROM $tableBrands";
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getBrandsSorted
 * Recupère la liste de toute les marques (triée)
 * @return type
 */
function getBrandsSorted() {
    global $tableBrands;
    $dbc = connection();
    $req = "SELECT * FROM $tableBrands ORDER BY name";
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getBrandById
 * Recupère la marque en fonction de l'id donné en paramère
 * @param type $id
 * @return type
 */
function getBrandById($id, $type = PDO::FETCH_OBJ) {
    global $tableBrands;
    return getFieldById($id, $tableBrands, $type);
}
