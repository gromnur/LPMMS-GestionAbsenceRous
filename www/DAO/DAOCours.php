<?php



/*
 * Créé un cours
 * Renvoi id_cours si inserer, 0 sinon
 */
function createCours($id_matiere,$id_groupe,$id_professeur,$numero_salle,$heur_debut,$heur_fin) {

    // Verifier si le libelle n'est pas present
    if (existeCours($id_matiere,$id_groupe,$id_professeur,$numero_salle,$heur_debut,$heur_fin) != 0) {
        // Si present renvoye 0
        return 0;
    }

    // Verifier si $id_matiere existe
    if (idExisteMatiere($id_matiere)) {
        return -1;
    }

    // Verifier si $id_groupe existe
    if (idExisteGroupeEtudiant($id_groupe_etudiant)) {
        return -2;
    }

    // Verifier si $id_professeur existe
    if (isProfesseur($id_professeur)) {
        return -3;
    }

    // Verifier si $numero_salle existe
    if (numeroExisteSalle($numero_salle)) {
        return -4;
    }

    // Verifier si $heur_debut existe
    

    // Verifier si $heur_fin existe


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
    return libelleExisteCours($libelle);
}

?>
