<?php


/*
 * Créé une heurFin
 * Renvoi 0 si inserer false sinon
 * syntaxe heur = HH:MM
 */
function createHeurFin($heur_fin) {

    // Verifier si l'heur_fin n'est pas present
    if (heurFinExisteHeurFin($heur_fin)) {
        // Si present renvoye 0
        return 0;
    }

    // Verification syntaxe heur_fin
    if (preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $heur_fin) === 1) {
        return -1;
    }

    // Creation d'une heur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO heur_fin(heur_fin) VALUES (:heur_fin)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heur_fin", $heur_fin);
    // execution requette
    $stmt->execute();
    // renvoi l'heur généré
    return $heur_fin;

}

/*
 * Return true si present, false Sinon
 */
function heurFinExisteHeurFin($heur_fin) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT heur_fin FROM heur_fin WHERE heur_fin = :heur_fin";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heur_fin", $heur_fin);
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
