<?php

require('AccesBDD.php');

/*
 * Créé un departement
 * Renvoi id_departement si inserer, 0 sinon
 */
function createDepartement($libelle) {

    // Verifier si le libelle est present
    if (libelleExisteDepartement($libelle) != 0) {
        // Si present renvoye 0
        return 0;
    }

    // Creation d'un departement
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO departement(libelle) VALUES (:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteDepartement($libelle);
}

/*
 * Return la liste des departements [$id_departement, $libelle]
 */
function selectDepartement () {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement";
    $stmt = $bd->prepare($rqt);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array($ligne['id_departement'], $ligne['libelle']);
        }
    }
    echo json_encode($listResult);
}

/*
 * Return id_departement si present, 0 Sinon
 */
function libelleExisteDepartement($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement WHERE libelle = :libelle";
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
function idExisteDepartement($id_departement) {
    // TODO coder libelleExisteDepartement
}
