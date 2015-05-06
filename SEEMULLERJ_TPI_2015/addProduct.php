<?php
require_once 'includes/specific_funtions.php';
require_once 'includes/struct.php';
require_once 'includes/crud_Produits.php';
require_once 'includes/crud_Brands.php';
require_once 'includes/crud_Medias.php';

if (!isAdmin()) {
    header('Location: index.php');
}

$brands = getBrandsSorted();
$keywords = getAllKeywordsSorted();

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

debug($uploadedFiles);

//Pour chaques médias ajoutés
foreach ($uploadedFiles["medias"]["error"] as $key => $value) {
    //Si l'upload n'a pas eu d'erreurs
    if ($value == UPLOAD_ERR_OK) {
        //Si le fichier existe
        if (file_exists($uploadedFiles["medias"]["tmp_name"][$key])) {
            //On vérifie que la taille de fichier n'exède pas la taille maximale
            if (filesize($uploadedFiles["medias"]["tmp_name"][$key]) < MAX_FILE_SIZE) {
                //On vérifie si le fichier fait parti des types d'images acceptée, sinon on le classe dans "autres"
                if (checkImageType($uploadedFiles["medias"]["type"][$key])) {
                     //On récupère la vielle extension du fichier
                    $oldExtension = pathinfo($uploadedFiles["medias"]["name"][$key], PATHINFO_EXTENSION);
                    //On crée un nom de fichier unique
                    $filename = uniqid($_SESSION['id']) . '.' . $oldExtension;
                    //On déplace le fichier et on le renomme avant de l'ajouter au dossier de destination
                    move_uploaded_file($uploadedFiles["medias"]["tmp_name"][$key], IMG_FOLDER . $filename);
                    //On indique que le fichier n'est pas une image
                    $isImage = true;
                }
                else {
                    //On récupère la vielle extension du fichier
                    $oldExtension = pathinfo($uploadedFiles["medias"]["name"][$key], PATHINFO_EXTENSION);
                    //On crée un nom de fichier unique
                    $filename = uniqid($_SESSION['id']) . '.' . $oldExtension;
                    //On déplace le fichier et on le renomme avant de l'ajouter au dossier de destination
                    move_uploaded_file($uploadedFiles["medias"]["tmp_name"][$key], OTHER_FOLDER . $filename);
                    //On indique que le fichier n'est pas une image
                    $isImage = false;
                }
                //On ajoute les données dans la base
                $idProduct = addProduct($title, $shortDesc, $longDesc, $isRecommended, $startDate, $endDate, $selectedBrand);
                $idMedia = addMedia($srcMedia, $isImage);
            }
        }
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
        getHeader();
        ?>

        <!-- CONTAINER -->
        <div class="container">
            <div class="well form-container">
                <!-- CONTAINER LOGIN -->
                <div class="form-horizontal">
                    <form class="form-add-product" enctype="multipart/form-data" method="post" action="">
                        <h2><span class="glyphicon glyphicon-plus-sign"></span> Ajouter un produit</h2><hr/>
                        <label class="">Nom du produit :</label><input class="form-control" name="title" type="text" value="" required/><br/>

                        <label class="">Marque :</label>
                        <select class="form-control" name="brands" required>
                            <?php
                            foreach ($brands as $brand) {
                                echo '<option value="' . $brand->id . '">' . $brand->name . '</option>';
                            }
                            ?>
                        </select>
                        <br/>

                        <label class="">Description courte :</label><input class="form-control" name="short_desc" type="text" value="" required/><br/>
                        <label class="">Description longue :</label><textarea class="form-control" name="long_desc" rows="3" required></textarea><br/>

                        <label class="">Mots-celfs</label>
                        <select class="form-control" name="keywords[]" multiple required>
                            <?php
                            foreach ($keywords as $keyword) {
                                echo '<option value="' . $keyword->id . '">' . strtoupper($keyword->name) . '</option>';
                            }
                            ?>
                        </select>
                        <br/>

                        <label class="">Date de sortie :</label><input class="form-control" name="availability_date" type="date" value="" required/><br/>
                        <label class="">Date d'expiration :</label><input class="form-control" name="expiration_date" type="date" value="" required/><br/>
                        <div class="well">

                            <label class="">Medias du produit :</label>           
                            <hr/>
                            <div class="container-fluid">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input class="" name="medias[]" type="file" multiple required/>
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
                            <input type="checkbox" value="checked" name="isRecommended">
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