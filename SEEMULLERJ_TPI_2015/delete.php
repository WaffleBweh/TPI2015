<?php
require_once 'includes/specific_funtions.php';
require_once 'includes/crud_Produits.php';
require_once 'includes/crud_Medias.php';

//On détruit le media envoyé en paramètre
$idMedia = filter_input(INPUT_GET, 'idMedia');
$idProduct = filter_input(INPUT_GET, 'idProduct');

//On recupère le "path" du media et on le supprime du server
$media = getMediaById($idMedia);
unlink($media->src);

deleteProductMediaById($idProduct, $idMedia);
header('Location: addProduct.php?edit=1&id='. $idProduct);