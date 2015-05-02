<?php

/*
  ======Crud Produit=======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		25/11/2014
  Version:	1
  Description:    Script contenant les fonctions en relation avec le crud products
  (create, read, update, delete)
 */

require_once 'basics_bdd.php';

$table = 'products';
$recommendedC = "WHERE is_frontpage=true";
$notRecommendedC = "WHERE is_frontpage=false";

/** countProducts
 * Retourne le nombre de produits
 * @global string $table
 * @return integer
 */
function countProducts() {
    global $table;

    return countFields($table);
}

/** countRecommendedProducts
 * Retourne le nombre produits qui sont sur la première page
 * @global string $table
 * @global string $recommendedC
 * @return integer
 */
function countRecommendedProducts() {
    global $table;
    global $recommendedC;

    return countFieldsCondition($table, $recommendedC);
}

/** getProductById
 * Retourne un produit selon un id passé en parametre
 * @global string $table
 * @param type $id
 * @return PDO::FETCH_OBJ
 */
function getProductById($id) {
    global $table;
    return getFieldById($id, $table);
}

/** deleteProductById
 * Supprime un produit dans la base de donnée selon un id passé en parametre
 * @global string $table
 * @param type $id
 */
function deleteProductById($id) {
    global $table;
    deleteFieldById($id, $table);
}

/** getRecommendedProducts
 * @global string $table
 * @global string $recommendedC
 * @return type
 */
function getRecommendedProducts() {
    global $table;
    global $recommendedC;

    $condition = $recommendedC . ' and NOW() > `availability_date` and NOW() < `expiration_date`';

    return getAllFieldsCondition($table, $condition);
}

/** getMostViewedProducts
 * @global string $table
 * @param int $nbProductsShown
 * @return type
 */
function getMostViewedProducts($nbProductsShown) {
    global $table;
    
    $condition = 'WHERE NOW() > availability_date and NOW() < expiration_date ORDER BY view_count DESC LIMIT ' . $nbProductsShown;

    return getAllFieldsCondition($table, $condition);
}