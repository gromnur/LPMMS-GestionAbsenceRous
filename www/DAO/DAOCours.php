<?php

/*
 * Créés un cours avec id_matiere, heur debut heur fin
 * Return true si créé/existant, false si erreur
 */
function createCours($id_matiere, $horaireDebut, $horaireFin) {
    // Verifier si $id_matiere n'est pas présent
    if (idExisteMatiere($id_matiere) != 0) {
        // Si present renvoye 0
        return 0;
    }

    // Creation d'un departement
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO cours(id_matiere, horaireDebut, horaireFin) VALUES (:id_matiere, :horaireDebut, :horaireFin)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_matiere", id_matiere);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return idExisteMatieret($id_matiere);
}

/*
 * Return la liste des cours [$nom, $prenom, $ine]
 */
function selectCours() {
    // TODO coder selectAvecFiliereCours
    // Construire la requete en fonction des different argument passé pour affiner le resultat
}

/*
 * Delete tout les cours lier à un departement selectionné ansi que les tables associés Localisation, assiste, anime
 */
function dropDepartementCours($id_departement) {
    // TODO dropDepartementCours

}

/*
 * Return true si present, false Sinon
 */
function idExisteCours($id_cours) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_cours FROM cours WHERE id_cours = :id_cours";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_cours", $id_cours);
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
