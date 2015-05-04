<?php

/*
  ======Structure PHP======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		30.04.2015
  Version:	1.0
  Description:  Script permettant de définir quel élément du site web a utiliser dépendamment de l'utilisateur
 */
require_once 'specific_funtions.php';
require_once 'crud_Produits.php';
require_once 'crud_Keywords.php';

/** getHeader
 * Affiche différents headers en fonction de la personne qui est connectée
 */
function getHeader() {
    include 'structure/header.php';
}

/** getFooter
 * Affiche différents footers en fonction de la personne qui est connectée
 */
function getFooter() {
    
}

/** structRecommendedProducts
 * Renvoie un string contenant le code html pour afficher les produits reccomendés
 * @return string
 */
function structRecommendedProducts() {
    $products = getRecommendedProducts();
    $str = '';

    //On crée un panel pour chaque produits de la page
    foreach ($products as $product) {
        $str.= '<div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a href="detail.php?id=' . $product->id . '"><h3 class="panel-title" style="text-align: center">' . $product->title . '</h3></a>
                            </div>
                            <div class="panel-body">
                            <a href="detail.php?id=' . $product->id . '"><img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;"></a>
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        ' . $product->short_desc . '
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>';
    }

    return $str;
}

/** structMostViewedProducts
 * Renvoie un string contenant le code html pour afficher les produits les plus vus
 * @return string
 */
function structMostViewedProducts() {
    $products = getMostViewedProducts(NUMBER_OF_TOP_PRODUCTS);
    $str = '';

    //On crée un panel pour chaque produits de la page
    foreach ($products as $product) {
        $str.= '<div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a href="detail.php?id=' . $product->id . '"><h3 class="panel-title" style="text-align: center">' . $product->title . ' - ' . $product->view_count . ' <span class="glyphicon glyphicon-eye-open"></span></h3></a>
                            </div>
                            <div class="panel-body">
                                <a href="detail.php?id=' . $product->id . '"><img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;"></a>
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        ' . $product->short_desc . '
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>';
    }

    return $str;
}

/** structKeywordsList
 * Renvoie un string contenant le code html pour afficher la liste des catégories
 */
function structKeywordsList() {
    $keywords = getAllKeywords();
    $str = '';

    //On crée un panel pour chaque animaux de la page
    foreach ($keywords as $keyword) {
        $str.= '<a href="#" class="list-group-item">
                        ' . $keyword->name . '
                    </a>';
    }

    return $str;
}

function structDetailProduct($id) {
    $product = getProductById($id);
    $str = '<div class="row well">
                    <h1><span class="glyphicon glyphicon-list-alt"></span> ' . $product->title . '</h1>
                    <hr/>
                    <p>' . $product->long_desc . '</p>
                </div>';

    return $str;
}
