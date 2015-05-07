<?php
require_once 'includes/specific_funtions.php';
require_once './includes/struct.php';

//On initialise les variables
$adminControls = '';
$errorLogin = '';
$deleteSuccess = '';
$id = filter_input(INPUT_GET, 'id');


//Si le produit n'existe pas, on renvoie l'utilisateur à l'accueil
$product = getProductById($id);
if ($product == NULL) {
    header('Location: index.php');
}

//Connexion utilisateur
if (filter_input(INPUT_POST, 'login')) {
    $pseudo = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');

    if (!userConnect($pseudo, $pass)) {
        $errorLogin = '<div class="alert alert-danger alert-error">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            Le nom d\'utilisateur ou le mot de passe est incorrect.
                       </div>';
    }
}

//On ajoute une vue à la page
addViewById($id);

//Si l'utilisateur est un administrateur on lui affiche les controles du produit
if (isAdmin()) {
    $adminControls = '<a href="addProduct.php?edit=1&id=' . $id . '" class="btn btn-warning">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Modifier le produit
                    </a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer le produit
                    </button>
                    <hr/>';
}

if ((isAdmin()) && (filter_input(INPUT_POST, 'delete'))) {
    deleteProductById($id);
    header('Location: index.php?deleteSuccess=true');
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
        echo $errorLogin;
        echo $deleteSuccess;
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
            <?php
            echo $adminControls
            ?>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
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

    <!-- Modal suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel">Suppression</h3>
                    </div>
                    <div class="modal-body">
                        <p>Êtes vous sur de vouloir supprimer le produit suivant : "<?php echo $product->title ?>" ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <input name="delete" class="btn btn-danger" type="submit" value="Supprimer"/>
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