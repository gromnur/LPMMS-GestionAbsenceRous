<?php

/**
 * Permet de se connecter à la BDD. Via un user, mdp et BDD.
 * @return PDO Object PDO de d'accé a la BDD
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

/**
 * Vide la base de donné
 */
function razBDD() {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "DELETE FROM absence WHERE 1;
    DELETE FROM cours WHERE 1;
    DELETE FROM matiere WHERE 1;
    DELETE FROM groupe_etudiant WHERE 1;
    DELETE FROM etudiant WHERE 1;
    DELETE FROM professeur WHERE 1;
    DELETE FROM administratif WHERE 1;
    DELETE FROM salle WHERE 1;
    DELETE FROM personnel WHERE 1;
    DELETE FROM filiere WHERE 1;
    DELETE FROM departement WHERE 1;";
    $stmt = $bd->prepare($rqt);
    // ajout param
    // execution requette
    $stmt->execute();
}

 ?>
