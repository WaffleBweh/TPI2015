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
DEFINE('PATH_ROOT', 'SEEMULLERJ_TPI_2015');

DEFINE('NUMBER_OF_TOP_PRODUCTS', 8);
DEFINE('NB_PAGINATION', 8);
DEFINE('IMG_FOLDER', 'up-content/img/');
DEFINE('OTHER_FOLDER', 'up-content/other/');
DEFINE('MAX_FILE_SIZE', 5242880); // (5 MO to Byte)

DEFINE('ALLOWED_IMAGE_TYPES', serialize( array("image/png", "image/jpeg", "image/gif")));