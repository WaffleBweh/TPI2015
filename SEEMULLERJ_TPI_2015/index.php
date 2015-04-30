<?php
require_once 'includes/specific_funtions.php';

//Connexion utilisateur
if (filter_input(INPUT_POST, 'login')) {
    $pseudo = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');

    userConnect($pseudo, $pass);
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
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="maquette.html">Catal'info</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                    <form class="navbar-form navbar-left">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>
                    <form class="navbar-form navbar-right" role="form">
                        <button name="login" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Connexion  <span class="glyphicon glyphicon-log-in"></span></button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="left">
            <div class="col-sm-2 col-md-2">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group" style="display: none;">
                    <h4 class="list-group-item">
                        Recherche par catégorie
                        <span class="pull-right" id="slide-submenu">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </span>
                    </h4>
                    <a href="#" class="list-group-item">
                        Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        Lorem ipsum
                    </a>
                </div>        
            </div>
        </div>

        <!-- CONTAINER -->
        <div class="container">
            <div class="container-fluid">
                <!-- CONTAINER PANELS PRODUITS LES PLUS VUS-->
                <div class="row well">
                    <h1><span class="glyphicon glyphicon-fire"></span> Les plus vus</h1>
                    <hr/>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER PANELS PRODUITS LES RECOMMANDES -->
                <div class="row well">
                    <h1><span class="glyphicon glyphicon-tags"></span> Recommandé</h1>
                    <hr/>
                    <div class="col-sm-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center">Nom du produit</h3>
                            </div>
                            <div class="panel-body">
                                <img class="img-thumbnail center-block" alt="thumbnail" src="./img/placeholder.png" data-holder-rendered="true" style="width: 200px; height: 200px; margin: auto;">
                                <hr/>
                                <div class="text-info" style="float: left;">
                                    <p>
                                        Short description...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal connexion -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-signin" method="post" action="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="myModalLabel">Connexion</h3>
                        </div>
                        <div class="modal-body">
                            <label class="">Pseudo:</label><input class="form-control" name="username" type="text" value="" placeholder="ex : ''Johndoe''"/><br/>
                            <label>Password :</label><input class="form-control" name="password" type="password"/><br/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <input name="login" class="btn btn-success" type="submit" value="Se connecter"/>
                        </div>
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