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

/*
 * Recupere le numeros d'identifiant pour le prochain cours
 */
function getNextCours() {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO sequance";
    $stmt = $bd->prepare($rqt);
    // execution requette
    $stmt->execute();

    $rqt = "SELECT sequance FROM sequance";
    $stmt = $bd->prepare($rqt);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0]["id_departement"];
    }
}

 ?>
