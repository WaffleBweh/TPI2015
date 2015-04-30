<?php
//On détruit la session de l'utilisateur et on le redirige à l'acceuil
session_start();
session_unset();
session_destroy();

header('location: index.php');
