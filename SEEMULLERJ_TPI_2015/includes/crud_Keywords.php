<?php

/*
+---------------+---------------------------------------------+
| CRUD KEYWORDS |                                             |
+---------------+---------------------------------------------+
| Auteur :      | SEEMULLER Julien                            |
| Classe :      | I.IN-P4B                                    |
| Date :        | 08.05.2015                                  |
| Version :     | 1.0                                         |
| Description : | Script contenant les fonctions              |
|               | en relation l'identification et le          |
|               | crud keywords(CREATE, READ, UPDATE, DELETE) |
+---------------+---------------------------------------------+
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

/** getAllKeywordsSorted
 * Renvoie le contenu de la table "keywords" trié par ordre alphabetique
 * @global string $tableKeywords
 * @return type
 */
function getAllKeywordsSorted(){    
    global $tableKeywords;
    $condition = 'ORDER BY name';
    
    return getAllFieldsCondition($tableKeywords, $condition);
}