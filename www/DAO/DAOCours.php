<?php



/*
 * Créé un cours
 * Renvoi id_departement si inserer, 0 sinon
 */
function createCours($id_matiere,$id_groupe,$id_professeur,$numero_salle,$heur_debut,$heur_fin) {

    // Verifier si le libelle n'est pas present
    if (libelleExisteCours($libelle) != 0) {
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
    return libelleExisteCours($libelle);
}

?>
