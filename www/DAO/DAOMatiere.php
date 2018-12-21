<?php

/*
 * Créé un matiere
 * Renvoi true si inserer, false sinon
 */
function createMatiere($libelle) {

    // Verifier si le libelle n'est pas present
    if (libelleExisteMatiere($libelle) != 0) {
        // Si present renvoye 0
        return 0;
    }

    // Creation d'un matiere
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO matiere(libelle) VALUES (:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteMatiere($libelle);

}

/*
 * Return id_matiere si present, 0 Sinon
 */
function libelleExisteMatiere($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_matiere, libelle FROM matiere WHERE libelle = :libelle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
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
function idExisteMatiere($id_matiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_matiere FROM matiere WHERE id_matiere = :id_matiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_matiere", $id_matiere);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return false;
    } else {
        return true;
    }
}
