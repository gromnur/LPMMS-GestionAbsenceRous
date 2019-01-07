<?php

/**
 * Créé un administrateur
 * @param  integer $numeropersonnel Le numeropersonnel du personnel
 * @return integer                  Le numeropersonnel du administrateur, 0 si la
 * personne est deja administrateur, -1 si le personnel n'existe pas.
 */
function createAdministrateur($numeropersonnel) {

    // verification presence administrateur
    if (isAdministrateur($numeropersonnel)) {
        return 0;
    }

    // verifiaction presence personnel
    if (!idExistePersonnel($numeropersonnel)) {
        return -1;
    }

    // Creation d'un administrateur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO administrateur(id_administrateur) VALUES (:numeropersonnel)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numeropersonnel;

}

/**
 * Verifie si le personnel est déja dans la Table administrateur.
 * @param  integer  $numeropersonnel Le numeropersonnel du personnel
 * @return boolean                   True si present, false sinon
 */
function isAdministrateur($numeropersonnel) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_administrateur FROM administrateur WHERE id_administrateur = :numeropersonnel";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
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

 ?>
