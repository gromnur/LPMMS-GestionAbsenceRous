<?php

/**
 * Créé un departement
 * @param  integer $libelle Le libelle du département
 * @return integer          id_departement si inserer, 0 sinon
 */

function createDepartement($libelle) {

    // Verifier si le libelle n'est pas present
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

/**
 * Renvoi un tableau de la liste des département
 * @return array la liste des departements [$id_departement, $libelle]
 */

function selectDepartement() {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement";
    $stmt = $bd->prepare($rqt);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array('id_departement' => $ligne['id_departement'],
                'libelle' => $ligne['libelle']);
        }
    }
    return $listResult;
}

/**
 * Verifie si le libelle est déja dans la Table departement.
 * @param  string $libelle  le libelle du département
 * @return integer          id_departement si present, 0 Sinon
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
        return $listResult[0]["id_departement"];
    }
}

/**
 * Verifie si le $id_departement est déja dans la Table departement.
 * @param  integer $id_departement L'id du département
 * @return boolean                 true si present, false Sinon
 */

function idExisteDepartement($id_departement) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement FROM departement WHERE id_departement = :id_departement";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_departement", $id_departement);
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
