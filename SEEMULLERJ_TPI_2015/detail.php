<?php
require_once 'includes/specific_funtions.php';
require_once './includes/struct.php';

$id = filter_input(INPUT_GET, 'id');

//Connexion utilisateur
if (filter_input(INPUT_POST, 'login')) {
    $pseudo = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');

    userConnect($pseudo, $pass);
}
?>
<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
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
                    <?php
                    echo structKeywordsList();
                    ?>
                </div>        
            </div>
        </div>

        <!-- CONTAINER -->
        <div class="container">
            <div class="container-fluid">
                <!-- CONTAINER PANELS PRODUITS LES PLUS VUS-->
                <?php
                echo structDetailProduct($id);
                ?>
                    <h3>
                        <?php
                        echo structViewCount($id);
                        ?>
                    </h3>
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