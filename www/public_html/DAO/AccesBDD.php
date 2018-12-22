<?php

/*
 * Permet de se connecter à la BDD. Via un user, mdp et BDD.
 * Return : Object PDO de d'accé a la BDD
 */
function getConnexion() {

    $user = "root";
  	$pass = "root";
  	$dbName = "gestioneleve";
    try
    {
        return new PDO('mysql:host=127.0.0.1;dbname='.$dbName.';charset=utf8', $user, $pass);
    }

    catch(Exception $e) {
        // TODO Gestion des erreur ?
        echo 'Erreur : '.$e->getMessage().'<br />';
        echo 'N° : '.$e->getCode();
        exit();
    }
}
 ?>
