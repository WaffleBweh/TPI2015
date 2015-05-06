<?php
require_once 'includes/specific_funtions.php';
require_once 'includes/struct.php';

if (!isAdmin()) {
    header('Location: index.php');
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
                    <form class="form-add-product" method="post" action="">
                        <h2><span class="glyphicon glyphicon-plus-sign"></span> Ajouter un produit</h2><hr/>
                        <label class="">Nom du produit :</label><input class="form-control" name="title" type="text" value=""/><br/>

                        <label class="">Marque :</label>
                        <select class="form-control" name="brands">
                            <option>Asus</option>
                            <option>NVidia</option>
                            <option>Corsair</option>
                            <option>Intel</option>
                        </select>
                        <br/>

                        <label class="">Description courte :</label><input class="form-control" name="short_desc" type="text" value=""/><br/>
                        <label class="">Description longue :</label><textarea class="form-control" name="long_desc" rows="3"></textarea><br/>

                        <label class="">Mots-celfs</label>
                        <select class="form-control" name="keywords" multiple>
                            <option>PC</option>
                            <option>CARTE MERE</option>
                            <option>CARTE GRAPHIQUE</option>
                            <option>CARTE SON</option>
                            <option>CLAVIER</option>
                        </select>
                        <br/>

                        <label class="">Date de sortie :</label><input class="form-control" name="availability_date" type="date" value=""/><br/>
                        <label class="">Date d'expiration :</label><input class="form-control" name="expiration_date" type="date" value=""/><br/>
                        <div class="well">

                            <label class="">Medias du produit :</label>           
                            <hr/>
                            <div class="container-fluid">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input class="" name="media" type="file" value="" multiple/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input name="upload" class="btn btn-primary" type="submit" value="Upload">
                                </div>
                            </div>
                            <br/>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                            <br/>
                        </div>
                        <label>
                            <input type="checkbox" value="">
                            Produit recommandé
                        </label>
                        <br/>
                        <br/>
                        <input name="add" class="btn btn-success" type="submit" value="Ajouter le produit"/>
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