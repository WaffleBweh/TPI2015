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
$tableKeywords = 'keywords';

/** getAllKeywords
 * Renvoie le contenu de la table "keywords"
 * @global string $tableKeywords
 * @return type
 */
function getAllKeywords(){    
    global $tableKeywords;
    
    return getAllFields($tableKeywords);
}