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
require_once 'crud_Medias.php';

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
        $str.= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <a href="detail.php?id=' . $product->idProduct . '"><h3 class="panel-title" style="text-align: center">' . $product->productTitle . '</h3></a>
                        </div>
                        <div class="panel-body">
                            <div class="product-container thumbnail">
                                <a href="detail.php?id=' . $product->idProduct . '"><img class="img-responsive thumbnail" alt="thumbnail" src="' . $product->mediaSource . '" data-holder-rendered="true"></a>                            
                            </div>
                            <hr/>
                            <div class="panel-footer" style="float: left;">
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
        $str.= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <a href="detail.php?id=' . $product->idProduct . '"><h3 class="panel-title" style="text-align: center">' . $product->productTitle . '</h3></a>
                        </div>
                        <div class="panel-body">
                            <div class="product-container thumbnail">
                                <a href="detail.php?id=' . $product->idProduct . '"><img class="thumbnail img-responsive" alt="thumbnail" src="' . $product->mediaSource . '" data-holder-rendered="true"></a>                            
                            </div>
                            <hr/>
                            <div class="panel-footer" style="float: left;">
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

    //On affiche un lien pour chaque keywords de la base
    foreach ($keywords as $keyword) {
        $str.= '<a href="search.php?querryKW=' . $keyword->name . '" class="list-group-item">
                        ' . strtoupper($keyword->name) . '
                    </a>';
    }

    return $str;
}

function structSearchedProducts($querry) {
    $products = searchForProduct($querry);
    $str = '';
    $querry = str_replace(' ', '%', $querry);
    foreach ($products as $product) {
        $str .= '<li class="media">
                    <div class="media-left">
                        <img class="media-object" src="' . $product->mediaSource . '" alt="image_product">
                    </div>
                    <div class="media-body">
                        <a href="detail.php?id=' . $product->idProduct . '"><h4 class="media-heading"><b>' . $product->brandName . '</b> - ' . $product->productTitle . '</h4></a>
                        <i>' . $product->short_desc . '</i>
                        <p></p>
                    </div>
                </li>
                <hr/>';
    }

    return $str;
}

function structSearchedProductsKeywords($querry) {
    $products = searchForProductWithKeywords($querry);
    $str = '';

    foreach ($products as $product) {
        //On récupère la première image du produit
        $medias = getProductMediasById($product->idProduct);
        $imgProduct = '';
        foreach ($medias as $media) {
            if ($media->isImage) {
                $imgProduct[] = $media->mediaSource;
            }
        }

        //On crée une liste html contenant les medias et les informations du produit
        $str .= '<li class="media">
                    <div class="media-left">
                        <img class="media-object" src="' . $imgProduct[0] . '" alt="image_product">
                    </div>
                    <div class="media-body">
                        <a href="detail.php?id=' . $product->idProduct . '"><h4 class="media-heading"><b>' . $product->brandName . '</b> - ' . $product->productTitle . '</h4></a>
                        <i>' . $product->short_desc . '</i>
                        <p></p>
                    </div>
                </li>
                <hr/>';
    }

    return $str;
}

/** structDetailProduct
 * Structure le détail d'un produit grace à son id
 * @param type $id
 * @return string
 */
function structDetailProduct($id) {
    $product = getProductDetailsById($id);
    $medias = getProductMediasById($id);

    $carouselIndicators = '';
    $carouselControls = '';
    $imagesProduct = '';
    $otherMedia = '';
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
                $carouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="' . $i . '" class="active"></li>';
                $imagesProduct .= '<div class="item thumbnail active"><img class="thumbnail" data-src="" alt="" src="' . $image . '"></div>';
            } else {
                $carouselIndicators .= '<li data-target="#carousel-example-generic" data-slide-to="' . $i . '" class=""></li>';
                $imagesProduct .= '<div class="item thumbnail"><img class="thumbnail" data-src="" alt="" src="' . $image . '"></div>';
            }
            $i++;
        }

        //On affiche les controls si il y a plus d'une image
        if (count($arrayImage) > 1) {
            $carouselControls = '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>';
        } else {
            //Si il n'y a qu'un produit, on retire les indicateurs
            $carouselIndicators = '';
        }
    }
    //Si le produit n'as pas d'image, on affiche un placeholder
    else {
        $imagesProduct .= '<div class="item active"><img data-src="" alt="" src="up-content/img/placeholder.png"></div>';
    }

    //Pour chaque image de produits, on ajoute un media dans la liste des téléchargements
    if (isset($arrayOthers)) {
        foreach ($arrayOthers as $other) {
            //On crée le nom du fichier en soustrayant la longeur de l'arborescance au chemin complet
            $filename = substr($other, strlen(OTHER_FOLDER));
            $otherMedia .= '<li class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" alt="pdf_file" src="img/pdf.png" data-holder-rendered="true" style="width: 32px; height: 32px;">
                                    </a>
                                </div>
                                <div class="media-body" style="margin: 10px;">
                                    <h4 class="media-heading" id="media-heading"><a href="download.php?file=' . $other . '">' . $filename . '</a><a class="anchorjs-link" href="#media-heading"><span class="anchorjs-icon"></span></a></h4>
                                </div>
                            </li>';
        }
    } else {
        $arrayOthers = NULL;
    }

    if (is_null($arrayOthers)) {
        $otherMedia = '<h4 class="red"><span class="glyphicon glyphicon-remove-sign"></span><i> Pas de fichiers actuellement disponible pour ce produit</i></h4>';
    }

    //On regarde si le produit est expiré et on affiche à l'utilisateur l'information
    if (!$product->isExpired) {
        $expiredText = '<span class="green glyphicon glyphicon-ok-sign"></span><span class="green"> Le produit est actuellement disponible (' . $product->availability_date . ' - ' . $product->expiration_date . ')</span>';
    } else {
        $expiredText = '<span class="red glyphicon glyphicon-remove-sign"></span><span class="red"> Le produit est actuellement indisponible (' . $product->availability_date . ' - ' . $product->expiration_date . ')</span>';
    }

    $str = '<div class="row well">
                    <h1><span class="glyphicon glyphicon-search"></span> ' . strtoupper($product->brandName) . ' - ' . $product->title . '</h1>
                    <hr>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                ' . $carouselIndicators . '
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                ' . $imagesProduct . '
                            </div>
                            ' . $carouselControls . '
                        </div>
                    </div>                   
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <h4><i>' . $product->short_desc . '</i></h4>
                        <p>' . $product->long_desc . '</p> 
                            ' . $expiredText . '
                    </div> 
                </div>
                <div class="row well">
                    <h1><span class="glyphicon glyphicon-download"></span> Fichiers téléchargeables</h1>
                    <hr>
                    <div class="media">
                        <ul class="media-list">
                            ' . $otherMedia . '
                        </ul>
                    </div>
                </div>
                <div class="row">';
    return $str;
}

function structViewCount($id) {
    $product = getProductById($id);
    $str = '<span>Nombre de vues : ' . $product->view_count . ' <span class="glyphicon glyphicon-eye-open"></span></span>';

    return $str;
}
