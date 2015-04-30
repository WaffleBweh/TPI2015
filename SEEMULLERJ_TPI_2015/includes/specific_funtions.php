<?php

/*
  ======Specific functions======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		30/04/2015
  Version:	0.1
  Description:  Script regroupant les fonctions spécifiques au site web et la base de donnée
 */

session_start();
require_once 'crud_User.php';

function isAdmin() {
    return ($_SESSION['admin']);
}

function isConnected() {
    return (isset($_SESSION['id']));
}

/* * HashPerso
 * Hash le mot de passe
 * @param string $value
 * @return string
 */

function hashPerso($password) {
    return sha1(md5($password));
}

function checkImageType($fileType) {
    return in_array($fileType, unserialize(ALLOWED_IMAGE_TYPES));
}

function debug($sObj = NULL) {
    echo '<pre>';
    if (is_null($sObj)) {
        echo '|Object is NULL|' . "\n";
    } elseif (is_array($sObj) || is_object($sObj)) {
        var_dump($sObj);
    } else {
        echo '|' . $sObj . '|' . "\n";
    }
    echo '</pre>';
}
