<?php


/*
 * Créé un salle
 * Renvoi id_salle si inserer, 0 sinon
 */
/**
 * Créé une salle
 * @param  string $numero_salle  Le numero de la salle
 * @return integer               id_salle si inserer, 0 sinon
 */
function createSalle($numero_salle) {

    // Verifier si le libelle n'est pas present
    if (numeroExisteSalle($numero_salle)) {
        // Si present renvoye 0
        return 0;
    }

    // Creation d'un departement
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO salle(numero_salle) VALUES (:numero_salle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numero_salle", $numero_salle);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numero_salle;

}

/*
 * Return true si present, false Sinon
 */
/**
 * Verifie si le $numero_salle existe
 * @param  string $numero_salle Le numero de la salle
 * @return boolean              true si present, false Sinon
 */
function numeroExisteSalle($numero_salle) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT numero_salle FROM salle WHERE numero_salle = :numero_salle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numero_salle", $numero_salle);
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
