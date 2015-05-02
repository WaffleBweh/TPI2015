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

function getHeader() {
    //On affiche différents headers en fonction de la personne qui est connectée
    //Si personne n'est connecté, on affiche un header donnant la possibilité de s'inscrire et de se logger.
    include 'structure/header.php';
}

function getFooter() {
    //On affiche différents footers en fonction de la personne qui est connectée
    //Si personne n'est connecté, on affiche un footer par défaut
    if (isConnected()) {
        if (isAdmin()) {
            include 'structure/footer_logged_in_admin.php';
        } else {
            include 'structure/footer_logged_in.php';
        }
    } else {
        include 'structure/footer_not_logged_in.php';
    }
}

function structRecommendedProducts() {
    $products = getRecommendedProducts();
    $str = '';

    //On crée un panel pour chaque animaux de la page
    foreach ($products as $product) {
        $str.= '<div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">' . $product->title . '</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
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

function structMostViewedProducts() {
    $products = getMostViewedProducts(NUMBER_OF_TOP_PRODUCTS);
    $str = '';

    //On crée un panel pour chaque animaux de la page
    foreach ($products as $product) {
        $str.= '<div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">' . $product->title . ' - ' . $product->view_count . ' <span class="glyphicon glyphicon-eye-open"></span></h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
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

function structKeywordsList() {
    $keywords = getAllKeywords();
    $str = '';

    //On crée un panel pour chaque animaux de la page
    foreach ($keywords as $keyword) {
        $str.= '<a href="#" class="list-group-item">
                        '. $keyword->name .'
                    </a>';
    }

    return $str;
}