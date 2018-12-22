<?php


/*
 * Créé un salle
 * Renvoi 0 si inserer false sinon
 * syntaxe heur = HH:MM
 */
function createHeurDebut($heur_debut) {

    // Verifier si $heur_debut est present
    if (heurDebutExisteHeurDebut($heur_debut)) {
        // Si present renvoye 0
        return 0;
    }

    // Verification syntaxe heur_debut
    if (preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $heur_debut) !== 1) {
        return -1;
    }

    // Creation d'un departement
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO heur_debut(heur_debut) VALUES (:heur_debut)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heur_debut", $heur_debut);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $heur_debut;

}

/*
 * Return true si present, false Sinon
 */
function heurDebutExisteHeurDebut($heur_debut) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT heur_debut FROM heur_debut WHERE heur_debut = :heur_debut";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":heur_debut", $heur_debut);
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
