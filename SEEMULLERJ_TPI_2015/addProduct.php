<?php
require_once 'includes/specific_funtions.php';
require_once 'includes/struct.php';
require_once 'includes/crud_Produits.php';
require_once 'includes/crud_Brands.php';
require_once 'includes/crud_Medias.php';

if (!isAdmin()) {
    header('Location: index.php');
}

//On récupère les marques et les mot-clefs
$brands = getBrandsSorted();
$keywords = getAllKeywordsSorted();

//On récupère l'id du produit et on regarde si on est en mode edition
$editMode = filter_input(INPUT_GET, 'edit');
$id = filter_input(INPUT_GET, 'id');

//Si on modifie un produit
if ($editMode == 1) {
    //On recupère le produit
    $product = getProductDetailsById($id);
    $productKeywords = getProductKeywordsById($id);
    //On initialise les variables pour remplir les champs
    $txtMode = '<span class="glyphicon glyphicon-cog"></span> Modifier un produit';
    $txtTitle = $product->title;
    $txtShortDesc = $product->short_desc;
    $txtLongDesc = $product->long_desc;
    $txtKeywords = '';
    $txtStartDate = $product->availability_date;
    $txtEndDate = $product->expiration_date;
    //On change le formattage pour qu'il soit compatible avec la checkbox
    if ($product->is_frontpage) {
        $txtIsRecommended = 'checked';
    } else {
        $txtIsRecommended = '';
    }
} else {
    //Si on est en train d'ajouter un produit
    //On initialise les variables
    $txtMode = '<span class="glyphicon glyphicon-plus-sign"></span> Ajouter un produit';
    $txtTitle = '';
    $txtShortDesc = '';
    $txtLongDesc = '';
    $txtKeywords = '';
    $txtStartDate = '';
    $txtEndDate = '';
    $txtIsRecommended = '';
}

// On récupère les informations du formulaire
$title = filter_input(INPUT_POST, 'title');
$selectedBrand = filter_input(INPUT_POST, 'brands');
$shortDesc = filter_input(INPUT_POST, 'short_desc');
$longDesc = filter_input(INPUT_POST, 'long_desc');
$selectedKeywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$startDate = filter_input(INPUT_POST, 'availability_date');
$endDate = filter_input(INPUT_POST, 'expiration_date');
$isRecommended = filter_input(INPUT_POST, 'isRecommended');

//On récupère les informations des medias envoyés
$uploadedFiles = $_FILES;


$error = false;
$errorList = '';

//Si on à recu des données en post
if (!empty($_POST)) {
//Verification ddu titre du produit
    if (empty($title) || strlen($title) > "64") {
        $errorMessages[] = "Vous n'avez pas entré de nom de produit, ou le nom était trop long";
        $error = true;
    }

//Verification de la marque produit
    if (empty($selectedBrand)) {
        $errorMessages[] = "Vous n'avez pas selectionné la marque du produit";
        $error = true;
    }
//Verification de la description courte du produit
    if (empty($shortDesc) || strlen($shortDesc) > "255") {
        $errorMessages[] = "Vous n'avez pas entré de description courte pour le produit, ou la description était trop longue";
        $error = true;
    }
//Verification de la description longue du produit
    if (empty($longDesc)) {
        $errorMessages[] = "Vous n'avez pas entré de description longue pour le produit";
        $error = true;
    }
//Verification de la date de debut
    if (empty($startDate)) {
        $errorMessages[] = "La date de sortie du produit n'a pas étée selectionnée";
        $error = true;
    }

//Verification de la date de fin
    if (empty($endDate)) {
        $errorMessages[] = "La date d'expiration du produit n'a pas étée selectionnée";
        $error = true;
    }

//Verification de la checkbox
    if ($isRecommended == "checked") {
        $isRecommended = true;
    } else {
        $isRecommended = false;
    }
}

//On ajoute les données du produit dans la base si il n'y a pas d'erreurs et si on à envoyé des données
if ($error == false) {
    $idProduct = addProduct($title, $shortDesc, $longDesc, $isRecommended, $startDate, $endDate, $selectedBrand);


    //On ajoute la liason entre le produit et les keywords si il n'y a pas d'erreurs
    //Si on à envoyé un ou plus keyword
    if (count($selectedKeywords) > 0) {
        foreach ($selectedKeywords as $selectedKeyword) {
            addProductKeywordRelation($idProduct, $selectedKeyword);
        }
    }

    //Si on à envoyé un ou plus media
    if (count($uploadedFiles) > 0) {
        //Pour chaques médias ajoutés
        foreach ($uploadedFiles["medias"]["error"] as $key => $value) {
            //Si l'upload n'a pas eu d'erreurs
            if ($value == UPLOAD_ERR_OK) {
                //Si le fichier existe
                if (file_exists($uploadedFiles["medias"]["tmp_name"][$key])) {
                    //On vérifie que la taille de fichier n'exède pas la taille maximale
                    if (filesize($uploadedFiles["medias"]["tmp_name"] [$key]) < MAX_FILE_SIZE) {
                        //On récupère la vielle extension du fichier
                        $oldExtension = pathinfo($uploadedFiles["medias"]["name"][$key], PATHINFO_EXTENSION);
                        //On récupère l'ancien nom du fichier
                        $oldFilename = pathinfo($uploadedFiles["medias"]["name"][$key], PATHINFO_FILENAME);
                        //On crée un nom de fichier unique
                        $hash = uniqid($_SESSION ['id']) . '.' . $oldExtension;
                        //On coupe le vieux nom du fichier pour le limiter à 10 caractères
                        if (strlen($oldFilename) > 10) {
                            $oldFilename = substr($oldFilename, 0, 10);
                        }
                        //On vérifie si le fichier fait parti des types d'images acceptée, sinon on le classe dans "autres"
                        if (checkImageType($uploadedFiles["medias"]["type"][$key])) {
                            //Si le fichier est bien une image, on l'ajoute dans le dossier "images"
                            $filename = IMG_FOLDER . $oldFilename . $hash;
                            //On indique que le fichier n'est pas une image
                            $isImage = true;
                        } else {
                            //Si le fichier n'est pas une image, on l'ajoute dans le dossier "autres"
                            $filename = OTHER_FOLDER . $oldFilename . $hash;
                            //On indique que le fichier n'est pas une image
                            $isImage = false;
                        }
                        //On déplace le fichier et on le renomme avant de l'ajouter au dossier de destination
                        move_uploaded_file($uploadedFiles["medias"]["tmp_name"][$key], $filename);
                        //On ajoute les donnée des media et sa relation avec le produit dans la base
                        $idMedia = addMedia($filename, $isImage);
                        addProductMediaRelation($idProduct, $idMedia);
                        $errorList = '<div class="alert alert-success alert-error">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            Le produit #' . $idProduct . ' à été ajouté correctement
                       </div>';
                    }
                }
            }
        }
    }
}
if (!empty($errorMessages)) {
    foreach ($errorMessages as $errorMessage) {
        $errorList .= '<div class="alert alert-danger alert-error">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            ' . $errorMessage . '
                       </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Catal'info</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <link href="./css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <!-- NAVBAR -->
        <?php
        echo $errorList;
        getHeader();
        ?>

        <!-- CONTAINER -->
        <div class="container">
            <div class="well form-container">
                <!-- CONTAINER LOGIN -->
                <div class="form-horizontal">
                    <form class="form-add-product" enctype="multipart/form-data" method="post" action="">
                        <h2><?php echo $txtMode; ?></h2><hr/>
                        <label class="">Nom du produit :</label><input class="form-control" name="title" type="text" value="<?php echo $txtTitle; ?>" required/><br/>

                        <label class="">Marque :</label>
                        <select class="form-control" name="brands" required>
                            <?php
                            foreach ($brands as $brand) {
                                echo '<option value="' . $brand->id . '">' . $brand->name . '</option>';
                            }
                            ?>
                        </select>
                        <br/>

                        <label class="">Description courte :</label><input class="form-control" name="short_desc" type="text" value="<?php echo $txtShortDesc; ?>" required/><br/>
                        <label class="">Description longue :</label><textarea class="form-control" name="long_desc" rows="3" required><?php echo $txtLongDesc; ?></textarea><br/>

                        <label class="">Mots-celfs</label>
                        <select class="form-control" name="keywords[]" multiple required>
                            <?php
                            foreach ($keywords as $key => $keyword) {
                                if (in_array($keyword->id, array_column($productKeywords->idKeyword,'idKeywords'))) {
                                    echo '<option value="' . $keyword->id . '" selected>' . strtoupper($keyword->name) . '</option>';
                                } else {
                                    echo '<option value="' . $keyword->id . '">' . strtoupper($keyword->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br/>

                        <label class="">Date de sortie :</label><input class="form-control" name="availability_date" type="date" value="<?php echo $txtStartDate; ?>" required/><br/>
                        <label class="">Date d'expiration :</label><input class="form-control" name="expiration_date" type="date" value="<?php echo $txtEndDate; ?>" required/><br/>
                        <div class="well">

                            <label class="">Medias du produit :</label>           
                            <hr/>
                            <div class="container-fluid">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input class="" name="medias[]" type="file" accept=".png,.gif,.jpg,.jpeg,.pdf,.docx" multiple required/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" hidden="true">
                                    <input name="upload" class="btn btn-primary" type="submit" value="Upload">
                                </div>
                            </div>
                            <br/>
                            <div class="progress" hidden="true">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                            <hr/>
                        </div>
                        <label>
                            <input type="checkbox" value="checked" name="isRecommended" <?php echo $txtIsRecommended ?>>
                            En première page
                        </label>
                        <br/>
                        <br/>
                        <input name="submit" class="btn btn-success" type="submit" value="Ajouter le produit"/>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="js/dropdown.js"></script>
    </body>
</html>