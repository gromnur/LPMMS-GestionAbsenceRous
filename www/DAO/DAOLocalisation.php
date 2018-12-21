<?php

/*
 * Créé un lien entre une salle et sont lieu de cour
 * renvoie true si l'insertion est reussi, false sinon
 */
createLocalisation($id_cours, $numero_salle) {

    // Verifier si le libelle n'est pas present
    if (idExisteLocalisation($id_cours, $numero_salle)) {
        // Si present renvoye 0
        return false;
    }

    // Verifier si le cours existe
    if (idExisteCours($id_cours)) {
        // Si present renvoye 0
        return false;
    }

    // Verifier si le libelle n'est pas present
    if (numeroExisteSalle($numero_salle)) {
        // Si present renvoye 0
        return false;
    }

    // Creation d'un matiere
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO localisation(numero_salle, id_cours) VALUES (:numero_salle, :id_cours)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numero_salle", $numero_salle);
    $stmt->bindParam(":id_cours", $id_cours);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return numeroExisteSalle($id_cours, $numero_salle);
}

/*
 * Return true si present, 0 Sinon
 */
function idExisteLocalisation($id_cours, $numero_salle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_cours, numero_salle FROM localisation WHERE id_cours = :id_cours AND numero_salle = :numero_salle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_matiere", $id_cours);
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

 ?>
