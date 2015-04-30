<?php
require_once 'includes/specific_funtions.php';

if (isConnected()) {
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
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Catal'info</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                    <form class="navbar-form navbar-left">
                        <div class="input-group col-xs-12">
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <!-- CONTAINER -->
        <div class="container">
            <div class="center-block">
                <!-- CONTAINER LOGIN -->
                <form class="form-signin" method="post" action="">
                    <h3>Connexion</h3><hr/>
                    <label class="">Pseudo:</label><input class="form-control" name="username" type="text" value="" placeholder="ex : ''Johndoe''"/><br/>
                    <label>Password :</label><input class="form-control" name="password" type="password"/><br/>
                    <input name="login" class="btn-success" type="submit" value="Se connecter"/>
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