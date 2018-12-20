<?php

require('AccesBDD.php');

/*
 * Créé un departement
 * Renvoi true si inserer, false sinon
 */
function createDepartement($libelle) {

    // Verifier si le libelle est present
        // Si present renvoye false

    // Creation d'un departement
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO departement(libelle) VALUES (:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(:libelle, $libelle);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0];
    }
}

/*
 * Return la liste des departements [$id_departement, $libelle]
 */
function selectDepartement () {
    // TODO coder selectDepartement
}

/*
 * Return id_departement si present, 0 Sinon
 */
function libelleExisteDepartement($libelle) {.
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement WHERE libelle = :libelle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(:libelle, $libelle);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0];
    }
}

/*
 * Return true si present, 0 Sinon
 */
function idExisteDepartement($id_departement) {
    // TODO coder libelleExisteDepartement
}
