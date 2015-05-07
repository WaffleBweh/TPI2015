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

/** isAdmin
 * Verifie si l'utilisateur est un administrateur
 * @return type
 */
function isAdmin() {
    if (isset($_SESSION['admin'])) {
        if ($_SESSION['admin'] == 1) {
            $result = true;
        } 
        else {
            $result = false;
        }
    } 
    else {
        $result = false;
    }
    return ($result);
}

/** isConnected
 * Verifie si l'utilisateur est connecté
 * @return type
 */
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

/** checkImageType
 * Vérifie le type de l'image
 * @param type $fileType
 * @return type
 */
function checkImageType($fileType) {
    return in_array($fileType, unserialize(ALLOWED_IMAGE_TYPES));
}

function isImage($string) {
    $result = false;

    if ((strpos($string, '.jpg') !== false) ||
            (strpos($string, '.jpeg') !== false) ||
            (strpos($string, '.png') !== false) ||
            (strpos($string, '.gif') !== false)) {
        $result = true;
    }

    return "$result";
}

/** debug
 * Debug de la variable donnée en paramètre
 * @param type $sObj
 */
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
