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

$tableProducts = 'products';
$recommendedC = "WHERE is_frontpage=true";
$notRecommendedC = "WHERE is_frontpage=false";

/** countProducts
 * Retourne le nombre de produits
 * @global string $tableProducts
 * @return integer
 */
function countProducts() {
    global $tableProducts;

    return countFields($tableProducts);
}

/** countRecommendedProducts
 * Retourne le nombre produits qui sont sur la première page
 * @global string $tableProducts
 * @global string $recommendedC
 * @return integer
 */
function countRecommendedProducts() {
    global $tableProducts;
    global $recommendedC;

    return countFieldsCondition($tableProducts, $recommendedC);
}

/** getProductById
 * Retourne un produit selon un id passé en parametre
 * @global string $tableProducts
 * @param type $id
 * @return PDO::FETCH_OBJ
 */
function getProductById($id) {
    global $tableProducts;
    return getFieldById($id, $tableProducts);
}

/** deleteProductById
 * Supprime un produit dans la base de donnée selon un id passé en parametre
 * @global string $tableProducts
 * @param type $id
 */
function deleteProductById($id) {
    global $tableProducts;
    deleteFieldById($id, $tableProducts);
}

/** getRecommendedProducts
 * Renvoie la liste des produits recommendés par les administrateurs
 * @global string $tableProducts
 * @global string $recommendedC
 * @return type
 */
function getRecommendedProducts() {
    global $tableProducts;
    global $recommendedC;

    $condition = $recommendedC . ' and NOW() > `availability_date` and NOW() < `expiration_date`';

    return getAllFieldsCondition($tableProducts, $condition);
}

/** getMostViewedProducts
 * Renvoie la liste des produits les plus vus
 * @global string $tableProducts
 * @param int $nbProductsShown
 * @return type
 */
function getMostViewedProducts($nbProductsShown) {
    global $tableProducts;
    
    $condition = 'WHERE NOW() > availability_date and NOW() < expiration_date ORDER BY view_count DESC LIMIT ' . $nbProductsShown;

    return getAllFieldsCondition($tableProducts, $condition);
}