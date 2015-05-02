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
                    <input type="text" class="form-control" placeholder="Rechercher...">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form>

            <?php
            if (isConnected()) {
                //Si l'utilisateur est connecté et qu'il est un administrateur (ADMIN)
                if (isAdmin()) {
                    ?>
                    <form class="navbar-form navbar-right" role="form">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION["username"]; ?> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter un produit</a></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
                            </ul>
                        </div>
                    </form>
                    <?php
                }
                //Si l'utilisateur est connecté mais pas un admin (USER)
                else {
                    ?>
                    <form class="navbar-form navbar-right" role="form">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION["username"]; ?> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
                            </ul>
                        </div>
                    </form>
                    <?php
                }
            }
            //Si l'utilisateur n'est pas connecté et n'est pas un administrateur (VISITEUR)
            else {
                ?>
                <form class = "navbar-form navbar-right" role = "form">
                    <button name = "login" type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#myModal">Connexion <span class = "glyphicon glyphicon-log-in"></span></button>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</nav>