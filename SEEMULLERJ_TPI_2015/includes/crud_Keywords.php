<?php

/*
  ======Crud Keywords=======
  Auteur: 	Seemuller Julien
  Classe: 	I.IN-P4B
  Date:		25/11/2014
  Version:	1
  Description:    Script contenant les fonctions en relation avec le crud keywords
  (create, read, update, delete)
 */

require_once 'basics_bdd.php';
$table = 'keywords';


function getAllKeywords(){    
    global $table;
    
    return getAllFields($table);
}