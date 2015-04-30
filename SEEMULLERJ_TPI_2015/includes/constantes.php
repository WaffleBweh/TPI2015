<?php

/*
  ======Constantes======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		30/04/2014
  Version:	1.1
  Description:  Script regroupant les constantes necessaire pour les scripts php du site
 */

DEFINE('DB_LOGIN', 'root');
DEFINE('DB_PASS', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'catal_info_bdd');

DEFINE('NB_PAGINATION', 8);
DEFINE('CONTENT_UPLOAD', 'up-content/');
DEFINE('IMG_FOLDER', 'img/');

DEFINE('ALLOWED_IMAGE_TYPES', serialize( array("image/png", "image/jpeg", "image/gif")));