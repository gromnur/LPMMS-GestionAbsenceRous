<?php

/*
 * Créé un cours.
 * Renvoi id_cours si inserer, 0 si le cours est déja présent,
 * -1 si id_matiere n'existe pas,
 * -2 si le groupe d'étudiant n'existe ftp_pas,
 * -3 si le id_prefesseur n'existe ftp_pas,
 * -4 si le numero de salle n'éxiste ftp_pas,
 * -5 si l'datee de debut n'existe pas pas,
 * -6 si l'datee de fin n'existe pas pas
 * TODO insere quand plusieur prof, plusieur groupe, 1 salle
 */
function createCours($id_matiere,$id_groupe,$id_professeur,$numero_salle,$date,$date_fin) {

    // Verifier si le cours n'est pas présent
    if (coursExisteCours($id_matiere,$libelle_groupe, $id_filiere, $id_professeur,$numero_salle, $date_debut, $date_fin) != 0) {
        // Si present renvoie 0
        return 0;
    }

    // Verifier si $id_matiere existe.
    if (!idExisteMatiere($id_matiere)) {
        return -1;
    }

    // Verifier si $id_groupe existe
    if (!groupeExisteGroupeEtudiant($libelle_groupe, $id_filiere)) {
        return -2;
    }

    // Verifier si $id_professeur existe
    if (!isProfesseur($id_professeur)) {
        return -3;
    }

    // Verifier si $numero_salle existe
    if (!numeroExisteSalle($numero_salle)) {
        return -4;
    }

    // Verifier si $date_debut valide
    if (!isExistedate($date_debut)) {
        return -5;
    }

    // Verifier si $date_fin valide
    if (!isExistedate($date_fin)) {
        return -6;
    }

    // Creation d'un cours
    // récupération accés base de données
    $bd = getConnexion();



    $rqt = "INSERT INTO cours(id_matiere, id_filiere, libelle_groupe, id_professeur, numero_salle, date_debut, date_fin) VALUES (:id_matiere, :id_filiere, :libelle_groupe, :id_professeur, :numero_salle, :date_debut, :date_fin)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_matiere", $id_matiere);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":id_professeur", $id_professeur);
    $stmt->bindParam(":numero_salle", $numero_salle);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);

    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return coursExisteCours($libelle);
}

/*
 * Verifie si une datetime est correct
 * Format = '2018-01-04 23:55:59'
 */
function isExistedate($date) {
    $format = 'Y-m-d H:i:s';

    $DateTime = DateTime::createFromFormat($format, $date);

    return $DateTime && $date == $DateTime->format($format);
}

/*
 * Return id_cours si present, 0 Sinon
 */
function coursExisteCours($id_matiere,$libelle_groupe, $id_filiere, $id_professeur,$numero_salle, $date_debut, $date_fin) {
    $bd = getConnexion();


    $rqt = "SELECT id_cours FROM cours WHERE id_matiere=:id_matiere,
                                              id_filiere=:id_filiere,
                                              libelle_groupe=:libelle_groupe,
                                              id_professeur=:id_professeur,
                                              numero_salle=:numero_salle,
                                              date_debut=:date_debut,
                                              date_fin=:date_fin";

    $stmt = $bd->prepare($rqt);

    // ajout param
    $stmt->bindParam(":id_matiere", $id_matiere);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":id_professeur", $id_professeur);
    $stmt->bindParam(":numero_salle", $numero_salle);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);

    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0]["id_cours"];
    }
}

?>
