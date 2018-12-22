<?php

/*
 * Créé un cours.
 * Renvoi id_cours si inserer, 0 si le cours est déja présent,
 * -1 si id_matiere n'existe pas,
 * -2 si le groupe d'étudiant n'existe ftp_pas,
 * -3 si le id_prefesseur n'existe ftp_pas,
 * -4 si le numero de salle n'éxiste ftp_pas,
 * -5 si l'datee de debut n'existe pas pas,
 * -6 si l'date de fin n'existe pas pas
 * TODO insere quand plusieur prof, plusieur groupe, 1 salle
 */
function createCours($id_matiere, $libelle_groupe, $id_filiere, $id_professeur, $numero_salle, $date_debut, $date_fin) {

    // Verifier si le cours n'est pas présent
    echo "cours existe <br>";
    if (coursExisteCours($id_matiere, $libelle_groupe, $id_filiere, $id_professeur, $numero_salle, $date_debut, $date_fin) != 0) {
        // Si present renvoie 0
        return 0;
    }

    // Verifier si $id_matiere existe.
    echo "matiere existe <br>";
    if (!idExisteMatiere($id_matiere)) {
        return -1;
    }

    // Verifier si $id_groupe existe
    echo "groupe existe <br>";
    if (!groupeExisteGroupeEtudiant($libelle_groupe, $id_filiere)) {
        return -2;
    }

    // Verifier si $id_professeur existe
    echo "prof existe <br>";
    if (!isProfesseur($id_professeur)) {
        return -3;
    }

    // Verifier si $numero_salle existe
    echo "salle existe <br>";
    if (!numeroExisteSalle($numero_salle)) {
        return -4;
    }

    // Verifier si $date_debut valide
    echo "date deb existe <br>";
    if (!isExistedate($date_debut)) {
        return -5;
    }

    // Verifier si $date_fin valide
    echo "date fin existe <br>";
    if (!isExistedate($date_fin)) {
        return -6;
    }

    echo "création cours existe <br>";
    // Creation d'un cours
    // récupération accés base de données
    $bd = getConnexion();

    // TODO table séquance pour les cours
    $rqt = "INSERT INTO cours(id_cours ,id_matiere, id_filiere, libelle_groupe, id_professeur, numero_salle, date_debut, date_fin) VALUES (1, :id_matiere, :id_filiere, :libelle_groupe, :id_professeur, :numero_salle, :date_debut, :date_fin)";
    $stmt = $bd->prepare($rqt);

    echo "1, ".$id_matiere.", ".$id_filiere.", '".$libelle_groupe."', ".$id_professeur.", '".$numero_salle."', '".$date_debut."', '".$date_fin."'<br>";
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
    return coursExisteCours($id_matiere, $libelle_groupe, $id_filiere, $id_professeur, $numero_salle, $date_debut, $date_fin);
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

    //SELECT id_cours FROM cours WHERE id_matiere=39 AND id_filiere=40 AND libelle_groupe='TD01' AND id_professeur=97 AND numero_salle="A300" AND date_debut='2018-12-22 10:00:00' AND date_fin='2018-12-22 12:00:00'
    $rqt = "SELECT id_cours FROM cours WHERE id_matiere=:id_matiere AND
                                              id_filiere=:id_filiere AND
                                              libelle_groupe=:libelle_groupe AND
                                              id_professeur=:id_professeur AND
                                              numero_salle=:numero_salle AND
                                              date_debut=:date_debut AND
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
