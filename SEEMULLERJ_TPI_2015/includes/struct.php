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
        $str.= '<div class="col-sm-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a href="detail.php?id=' . $product->idProduct . '"><h3 class="panel-title" style="text-align: center">' . $product->productTitle . '</h3></a>
                            </div>
                            <div class="panel-body">
                            <a href="detail.php?id=' . $product->idProduct . '"><img class="img-thumbnail center-block" alt="thumbnail" src="' . $product->mediaSource . '" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;"></a>
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
    $medias = getProductMedias();
    $str = '';

    //On crée un panel pour chaque produits de la page
    foreach ($products as $product) {
        $str.= '<div class="col-sm-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a href="detail.php?id=' . $product->idProduct . '"><h3 class="panel-title" style="text-align: center">' . $product->productTitle . ' - ' . $product->view_count . ' <span class="glyphicon glyphicon-eye-open"></span></h3></a>
                            </div>
                            <div class="panel-body">
                                <a href="detail.php?id=' . $product->idProduct . '"><img class="img-thumbnail center-block" alt="thumbnail" src="' . $product->mediaSource . '" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;"></a>
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
    $keywords = getAllKeywordsSorted();
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
    $product = getProductDetailsById($id);
    $medias = getProductMediasById($id);

    $carouselIndicators = '';
    $imagesProduct = '';
    $i = 0;
    $j = 0;
    
    foreach ($medias as $media) {
        if ($media->isImage) {
            $i++;
            $arrayImage[$i] = $media->mediaSource;
        } else {
            $j++;
            $arrayOthers[$j] = $media->mediaSource;
        }
    }

    //Pour chaque image de produits, on ajoute un indicateur pour le carousel et la source de l'image
    //pour la première fois, on rend le premier indicateur et la première image "actif"
    if (isset($arrayImage)) {
        $i = 0;
        foreach ($arrayImage as $image) {
            if ($i == 0) {
                $carouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                $imagesProduct .= '<div class="item active"><img data-src="" alt="" src="' . $image . '"></div>';
                $i = 1;
            } else {
                $carouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>';
                $imagesProduct .= '<div class="item"><img data-src="" alt="" src="' . $image . '"></div>';
            }
        }
    }
    //Si le produit n'as pas d'image, on affiche un placeholder
    else {
        $imagesProduct .= '<div class="item active"><img data-src="" alt="" src="up-content/img/placeholder.png"></div>';
    }

    //On regarde si le produit est expiré et on affiche à l'utilisateur l'information
    if (!$product->isExpired) {
        $expiredText = '<span class="green glyphicon glyphicon-ok-sign"></span><span class="green"> Le produit est actuellement disponible (' . $product->availability_date . ' - ' . $product->expiration_date . ')</span>';
    } else {
        $expiredText = '<span class="red glyphicon glyphicon-remove-sign"></span><span class="red"> Le produit est actuellement indisponible (' . $product->availability_date . ' - ' . $product->expiration_date . ')</span>';
    }

    $str = '<div class="row well">
                    <h1>' . strtoupper($product->brandName) . ' - ' . $product->title . '</h1>
                    <hr>
                    <div class="col-sm-5">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                ' . $carouselIndicators . '
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                ' . $imagesProduct . '
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div> 
                    <hr/>
                    <div class="col-sm-7">
                        <h4><i>' . $product->short_desc . '</i></h4>
                        <p>' . $product->long_desc . '</p> 
                            ' . $expiredText . '
                    </div> 
                </div>';
    return $str;
}

function structViewCount($id) {
    $product = getProductById($id);
    $str = '<span>Nombre de vues : ' . $product->view_count . ' <span class="glyphicon glyphicon-eye-open"></span></span>';

    return $str;
}
