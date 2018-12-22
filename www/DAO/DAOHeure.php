<?php
/*
 * Créé une heure
 * Renvoi 0 si inserer false sinon
 * syntaxe heur = HH:MM
 */
function createHeure($heure) {

    // Verifier si $heure est present
    if (isExisteHeure($heure)) {
        // Si present renvoye 0
        return 0;
    }

    // Verification syntaxe heure
    if (preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $heure) === 1) {
        return -1;
    }

    // Creation d'une heur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO heure(heure) VALUES (:heure)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heure", $heure);
    // execution requette
    $stmt->execute();
    // renvoi l'heur généré
    return $heure;

}

/*
 * Return true si present, false Sinon
 */
function isExisteHeure($heure) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT heure FROM heure WHERE heure = :heure";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heure", $heure);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    // si présent return true
    if (count($listResult) == 0) {
        return false;
    } else {
        return true;
    }
}
