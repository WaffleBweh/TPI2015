<?php

/*
+---------------+---------------------------------------------+
| CRUD PRODUITS |                                             |
+---------------+---------------------------------------------+
| Auteur :      | SEEMULLER Julien                            |
| Classe :      | I.IN-P4B                                    |
| Date :        | 08.05.2015                                  |
| Version :     | 1.0                                         |
| Description : | Script contenant les fonctions              |
|               | en relation l'identification et le          |
|               | crud produits(CREATE, READ, UPDATE, DELETE) |
+---------------+---------------------------------------------+
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

/** getProductByIdCondition
 * Retourne un produit selon un id et une condition passé en parametre
 * @global string $tableProducts
 * @param type $id
 * @return PDO::FETCH_OBJ
 */
function getProductByIdCondition($id, $condition) {
    global $tableProducts;
    return getFieldByIdCondition($id, $tableProducts, $condition);
}

/** addProduct()
 * Ajoute un produit à la base de données
 * @global string $tableProducts
 * @param type $title
 * @param type $shortDesc
 * @param type $longDesc
 * @param type $isFrontpage
 * @param type $startDate
 * @param type $endDate
 * @param type $idBrand
 * @return type
 */
function addProduct($title, $shortDesc, $longDesc, $isFrontpage, $startDate, $endDate, $idBrand) {
    global $tableProducts;
    $viewCount = 0;

    $dbc = connection();
    $req = "INSERT INTO $tableProducts (title, short_desc, long_desc, is_frontpage, availability_date, expiration_date, view_count, id_brand) "
            . "VALUES (:title, :shortDesc, :longDesc, :isFrontpage, :startDate, :endDate, :viewCount, :idBrand)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':title', $title, PDO::PARAM_STR);
    $requPrep->bindParam(':shortDesc', $shortDesc, PDO::PARAM_STR);
    $requPrep->bindParam(':longDesc', $longDesc, PDO::PARAM_STR);
    $requPrep->bindParam(':isFrontpage', $isFrontpage, PDO::PARAM_BOOL);
    $requPrep->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $requPrep->bindParam(':endDate', $endDate, PDO::PARAM_STR);
    $requPrep->bindParam(':viewCount', $viewCount, PDO::PARAM_INT);
    $requPrep->bindParam(':idBrand', $idBrand, PDO::PARAM_INT);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();
}

function updateProduct($id, $title, $shortDesc, $longDesc, $isFrontpage, $startDate, $endDate, $viewCount, $idBrand) {
    global $tableProducts;
    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = "UPDATE $tableProducts SET title=:title, short_desc=:shortDesc, long_desc=:longDesc, is_frontpage=:isFrontpage, availability_date=:startDate, expiration_date=:endDate, view_count=:viewCount, id_brand=:idBrand WHERE id=$id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':title', $title, PDO::PARAM_STR);
    $requPrep->bindParam(':shortDesc', $shortDesc, PDO::PARAM_STR);
    $requPrep->bindParam(':longDesc', $longDesc, PDO::PARAM_STR);
    $requPrep->bindParam(':isFrontpage', $isFrontpage, PDO::PARAM_BOOL);
    $requPrep->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $requPrep->bindParam(':endDate', $endDate, PDO::PARAM_STR);
    $requPrep->bindParam(':viewCount', $viewCount, PDO::PARAM_INT);
    $requPrep->bindParam(':idBrand', $idBrand, PDO::PARAM_INT);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $id;
}

/** deleteProductById
 * Supprime un produit dans la base de donnée selon un id passé en parametre
 * @global string $tableProducts
 * @param type $id
 */
function deleteProductById($id) {
    global $tableProducts;
    //On supprime les medias lié au produit
    deleteProductMediasById($id);
    //On supprime la relation avec les medias
    deleteProductMediaRelation($id);
    //On supprime la relation avec les keywords
    deleteProductKeywordRelation($id);
    //On supprime le produit
    deleteFieldById($id, $tableProducts);
}

/** deleteProductMediaRelation
 * On supprime la relation avec les medias grace à l'id produit
 * @param type $id
 */
function deleteProductMediaRelation($id) {
    $table = 'products_has_medias';
    $condition = "WHERE id_products = $id";
    deleteFieldByIdCondition($id, $table, $condition);
}

/** deleteProductMediaRelation
 * On supprime la relation avec les medias grace à l'id produit
 * @param type $id
 */
function deleteProductMediaRelationById($idProduct, $idMedia) {
    $table = 'products_has_medias';
    $condition = "WHERE id_products = $idProduct AND id_medias = $idMedia";
    deleteFieldByIdCondition($id, $table, $condition);
}

/** deleteProductKeywordRelation
 * On supprime la relation avec les keywords grace à l'id produit
 * @param type $id
 */
function deleteProductKeywordRelation($id) {
    $table = 'products_has_keywords';
    $condition = "WHERE id_products = $id";
    deleteFieldByIdCondition($id, $table, $condition);
}

/** deleteProductMediaById
 * On supprime un medias du produit grace a son id
 * @param type $id
 */
function deleteProductMediaById($idProduct, $idMedia) {
    $dbc = connection();
    $table = 'medias';
    $dbc->quote($table);

    $req = "DELETE FROM $table "
            . "WHERE id IN ("
            . "SELECT pm.id_medias "
            . "FROM products_has_medias "
            . "AS pm "
            . "WHERE pm.id_medias = $idMedia AND pm.id_products = $idProduct)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    deleteProductMediaRelationById($idProduct, $idMedia);
}

/** deleteProductMediasById
 * On supprime les medias du produit grace a son id
 * @param type $id
 */
function deleteProductMediasById($id) {
    //On supprime physiquement les medias avant de les retirer de la base
    $medias = getProductMediasById($id);
    foreach ($medias as $media) {
        unlink($media->mediaSource);
    }

    $dbc = connection();
    $table = 'medias';
    $dbc->quote($table);

    $req = "DELETE FROM $table "
            . "WHERE id IN ("
            . "SELECT pm.id_medias "
            . "FROM products_has_medias "
            . "AS pm "
            . "WHERE pm.id_products = $id)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();
}

/** getRecommendedProducts
 * Renvoie la liste des produits recommendés par les administrateurs
 * @global string $tableProducts
 * @global string $recommendedC
 * @return type
 */
function getRecommendedProducts() {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);

    $req = 'SELECT DISTINCT p.id AS idProduct, p.title as productTitle,  p.short_desc, MIN(m.src) AS mediaSource,'
            . ' m.isImage, p.view_count, p.is_frontpage '
            . 'FROM products AS p '
            . 'INNER JOIN products_has_medias AS pm ON p.id = pm.id_products '
            . 'INNER JOIN medias AS m ON pm.id_medias = m.id '
            . 'WHERE m.isImage = 1 '
            . 'AND is_frontpage=true '
            . 'AND NOW() > availability_date '
            . 'AND NOW() < expiration_date '
            . 'GROUP BY p.title '
            . 'ORDER BY p.title ASC ';

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getMostViewedProducts
 * Renvoie la liste des produits les plus vus
 * @global string $tableProducts
 * @param int $nbProductsShown
 * @return type
 */
function getMostViewedProducts($nbProductsShown) {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);

    //On récupère les produits les plus vus si ils n'ont pas expiré
    //On récupère aussi les liens vers leurs images et on les organise par leur nombre de vues
    $req = 'SELECT DISTINCT p.id AS idProduct, p.title as productTitle,  p.short_desc, MIN(m.src) AS mediaSource,'
            . ' m.isImage, p.view_count, p.is_frontpage '
            . 'FROM products AS p '
            . 'INNER JOIN products_has_medias AS pm ON p.id = pm.id_products '
            . 'INNER JOIN medias AS m ON pm.id_medias = m.id '
            . 'WHERE m.isImage = 1 '
            . 'AND NOW() > availability_date '
            . 'AND NOW() < expiration_date '
            . 'GROUP BY p.title '
            . 'ORDER BY view_count DESC '
            . 'LIMIT ' . $nbProductsShown;

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getProductDetails
 * Renvoie la liste des produits et leur marques associées
 * @global string $tableProducts
 * @return type
 */
function getProductDetails() {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    //On récupère les produits les plus vus si ils n'ont pas expiré
    //On récupère aussi les liens vers leurs images et on les organise par leur nom
    $req = "SELECT p.id AS idProduit, p.title, p.short_desc, p.long_desc, p.is_frontpage,"
            . " p.availability_date, p.expiration_date, p.view_count, p.id_brand, b.id AS idBrand,"
            . " b.name AS brandName, (NOW() < availability_date OR NOW() > expiration_date) AS isExpired"
            . " FROM $tableProducts AS p"
            . " INNER JOIN brands as b ON p.id_brand = b.id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getProductDetailsById
 * Renvoie un produit par son id et les informations concernant sa marque 
 * @global string $tableProducts
 * @param type $id
 * @return type
 */
function getProductDetailsById($id) {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = "SELECT p.id AS idProduit, p.title, p.short_desc, p.long_desc, p.is_frontpage,"
            . " p.availability_date, p.expiration_date, p.view_count, p.id_brand, b.id AS idBrand,"
            . " b.name AS brandName, (NOW() < availability_date OR NOW() > expiration_date) AS isExpired"
            . " FROM $tableProducts AS p"
            . " INNER JOIN brands as b ON p.id_brand = b.id"
            . " WHERE p.id = $id";


    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetch(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

function getProductKeywordsById($id, $type = PDO::FETCH_OBJ) {
    global $tableProducts;
    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = 'SELECT p.title, k.id AS idKeyword, k.name AS keywordName '
            . 'FROM products AS p '
            . 'INNER JOIN products_has_keywords AS pk ON p.id = pk.id_products '
            . 'INNER JOIN keywords AS k ON pk.id_keywords = k.id '
            . 'WHERE p.id = ' . $id;

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll($type);
    $requPrep->closeCursor();

    return $data;
}

/** getProductMedias
 * Renvoie la liste de tous les produits avec leurs médias associés
 * @global string $tableProducts
 * @return type
 */
function getProductMedias() {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = "SELECT p.id AS idProduit, p.title as productTitle, m.id as idMedia, m.src AS mediaSource,m.isImage "
            . "FROM $tableProducts AS p "
            . "INNER JOIN products_has_medias AS pm ON p.id = pm.id_products "
            . "INNER JOIN medias AS m ON pm.id_medias = m.id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** getProductMediasById
 * Renvoie un produit et ses médias associés en dépendant de son ID
 * @global string $tableProducts
 * @param type $id
 * @return type
 */
function getProductMediasById($id) {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = "SELECT p.id AS idProduit, p.title as productTitle, m.id as idMedia, m.src AS mediaSource, m.isImage "
            . "FROM $tableProducts AS p "
            . "INNER JOIN products_has_medias AS pm ON p.id = pm.id_products "
            . "INNER JOIN medias AS m ON pm.id_medias = m.id "
            . "WHERE p.id = $id";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/** addProductMediaRelation
 * Ajoute une relation entre un produit et un media
 * @param type $idProduct
 * @param type $idMedia
 * @return type
 */
function addProductMediaRelation($idProduct, $idMedia) {
    $table = "products_has_medias";

    $dbc = connection();
    $dbc->quote($table);
    $req = "INSERT INTO $table (id_products, id_medias) VALUES (:idProduct, :idMedia)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':idProduct', $idProduct, PDO::PARAM_STR);
    $requPrep->bindParam(':idMedia', $idMedia, PDO::PARAM_BOOL);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();
}

/** addProductKeywordRelation
 * Ajoute une relation entre un produit et un mot-clef
 * @param type $idProduct
 * @param type $idKeyword
 * @return type
 */
function addProductKeywordRelation($idProduct, $idKeyword) {
    $table = "products_has_keywords";

    $dbc = connection();
    $dbc->quote($table);
    $req = "INSERT INTO $table (id_products, id_keywords) VALUES (:idProduct, :idKeyword)";

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->bindParam(':idProduct', $idProduct, PDO::PARAM_STR);
    $requPrep->bindParam(':idKeyword', $idKeyword, PDO::PARAM_BOOL);
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();
}

function addViewById($id) {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    $dbc->quote($id);
    $req = "UPDATE $tableProducts SET view_count = view_count+1 WHERE id = $id";
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $requPrep->closeCursor();
    return $dbc->lastInsertId();
}

function searchForProduct($querry) {
    global $tableProducts;

    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = 'SELECT DISTINCT p.id AS idProduct, p.title as productTitle,  p.short_desc, MIN(m.src) AS mediaSource,'
            . ' m.isImage, p.view_count, p.is_frontpage, b.name AS brandName '
            . 'FROM ' . $tableProducts . ' AS p '
            . 'INNER JOIN products_has_medias AS pm ON p.id = pm.id_products '
            . 'INNER JOIN medias AS m ON pm.id_medias = m.id '
            . 'INNER JOIN brands AS b ON p.id_brand = b.id '
            . 'WHERE Concat(p.title, \'\', p.short_desc, \'\', p.long_desc, \'\', b.name) LIKE "%' . $querry . '%" '
            . 'AND m.isImage = 1 GROUP BY p.title ORDER BY p.title DESC';

    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

function searchForProductWithKeywords($querry) {
    global $tableProducts;
    $dbc = connection();
    $dbc->quote($tableProducts);
    $req = 'SELECT DISTINCT p.id AS idProduct, p.title as productTitle, '
            . 'p.short_desc, p.view_count, p.is_frontpage, b.name AS brandName, '
            . 'k.name AS keywordName '
            . 'FROM ' . $tableProducts . ' AS p '
            . 'INNER JOIN brands AS b ON p.id_brand = b.id '
            . 'INNER JOIN products_has_keywords AS pk ON p.id = pk.id_products '
            . 'INNER JOIN keywords AS k ON pk.id_keywords = k.id '
            . 'WHERE k.name LIKE "%' . $querry . '%" '
            . 'GROUP BY p.title '
            . 'ORDER BY p.title DESC';
    
    $requPrep = $dbc->prepare($req); // on prépare notre requête
    $requPrep->execute();
    $data = $requPrep->fetchAll(PDO::FETCH_OBJ);
    $requPrep->closeCursor();

    return $data;
}

/* SEARCH FOR PRODUCT
SELECT p.title AS productName, p.short_desc, p.long_desc, b.name AS brandName
FROM products AS p
INNER JOIN brands AS b ON p.id_brand = b.id
WHERE Concat(p.title, '', p.short_desc, '', p.long_desc, '', b.name) 
LIKE "%Razer%"
 */

/* SEARCH FOR PRODUCT VIA KEYWORD
SELECT p.title AS productName, p.short_desc, p.long_desc, k.name
FROM products AS p
INNER JOIN products_has_keywords AS pk ON p.id = pk.id_products
INNER JOIN keywords AS k ON pk.id_keywords = k.id
WHERE k.name LIKE "%Carte%"
 */