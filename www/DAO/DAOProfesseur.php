<?php

/**
 * Créé un professeur
 * @param  integer $numeropersonnel Le numeropersonnel du personnel
 * @return integer                  Le numeropersonnel du professeur, 0 si la
 * personne est deja professeur, -1 si le personnel n'existe pas.
 */
function createProfesseur($numeropersonnel) {

    // verification presence professeur
    if (isProfesseur($numeropersonnel)) {
        return 0;
    }

    // verifiaction presence personnel
    if (!idExistePersonnel($numeropersonnel)) {
        return -1;
    }

    // Creation d'un professeur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO professeur(id_professeur) VALUES (:numeropersonnel)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numeropersonnel;

}

/**
 * Verifie si le personnel est déja dans la Table professeur.
 * @param  integer  $numeropersonnel Le numeropersonnel du personnel
 * @return boolean                   True si present, false sinon
 */
function isProfesseur($numeropersonnel) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_professeur FROM professeur WHERE id_professeur = :numeropersonnel";
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
