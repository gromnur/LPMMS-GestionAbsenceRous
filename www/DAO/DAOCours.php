<?php

/**
 * Créé un cours. L'index $tab_libelle_groupe doit correspondre à l'index $tab_id_filiere
 * @param  integer  $id_matiere         L'id de la matiere
 * @param  array    $tab_libelle_groupe Un liste des différent groupe du cours
 * @param  array    $tab_id_filiere     Un liste des différente filiere du cours
 * @param  array    $tab_id_professeur  Un liste des différent professeur du cours
 * @param  array    $tab_numero_salle   Un liste des différent salles du cours
 * @param  DateTime $date_debut         La date de debut du cours
 * @param  DateTime $date_fin           La date de fin du cours
 * @return array                        Un liste contenant l'id du cours ou un code d'Erreur
 * 0 si le cours est déja présent,
 * -1 si id_matiere n'existe pas,
 * -2 si le groupe d'étudiant n'existe pas, ou que $tab_libelle_groupe et $tab_id_filiere n'est pas le meme nombre d'élement
 * -3 si le id_prefesseur n'existe pas,
 * -4 si le numero de salle n'éxiste pas,
 * -5 si l'datee de debut n'existe pas,
 * -6 si l'date de fin n'existe pas
 */
function createCours($id_matiere, $tab_libelle_groupe, $tab_id_filiere, $tab_id_professeur, $tab_numero_salle, $date_debut, $date_fin) {

    // recupere les count de chaque tableau
    $count_tab_libelle_groupe = count($tab_libelle_groupe);
    $count_tab_id_filiere = count($tab_id_filiere);
    $count_tab_id_professeur = count($tab_id_professeur);
    $count_tab_numero_salle = count($tab_numero_salle);

    //verifier que les variable sont bien des tableaux
    if (!is_array($tab_libelle_groupe) || $count_tab_libelle_groupe < 1) {
        // si pas tableau code erreur lié
        return -2;
    }

    if (!is_array($tab_id_filiere) || $count_tab_id_filiere < 1) {
        // si pas tableau code erreur lié
        return -2;
    }

    if (!is_array($tab_id_professeur) || $count_tab_id_professeur < 1) {
        // si pas tableau code erreur lié
        return -3;
    }

    if (!is_array($tab_numero_salle) || $count_tab_numero_salle < 1) {
        // si pas tableau code erreur lié
        return -4;
    }

    // Mise a niveau des tableaux
    // $tab_libelle_groupe et $tab_id_filiere doivent avoir le meme nombre de donné sinon erreur -2
    if ($count_tab_libelle_groupe != $count_tab_id_filiere) {
        return -2;
    }

    // Recupération du max des count de chaque tableau
    $max_count = max($count_tab_libelle_groupe, $count_tab_id_professeur,  $count_tab_numero_salle);
    //var_dump($max_count);

    // on ajoute a la fin du tableau la premiere ligne de tel sorte qu'il est tous le meme nombre d'elements.

    // mise a niveau $tab_libelle_groupe
    while ($count_tab_libelle_groupe < $max_count) {
        $tab_libelle_groupe[] = $tab_libelle_groupe[0];
        $count_tab_libelle_groupe += 1;
    }

    // mise a niveau $tab_id_filiere
    while ($count_tab_id_filiere < $max_count) {
        $tab_id_filiere[] = $tab_id_filiere[0];
        $count_tab_id_filiere += 1;
    }

    // mise a niveau $tab_id_professeur
    while ($count_tab_id_professeur < $max_count) {
        $tab_id_professeur[] = $tab_id_professeur[0];
        $count_tab_id_professeur += 1;
    }

    // mise a niveau $tab_numero_salle
    while ($count_tab_numero_salle < $max_count) {
        $tab_numero_salle[] = $tab_numero_salle[0];
        $count_tab_numero_salle += 1;
    }

    // verifiction des champs stables : $id_matiere, $date_debut, $date_fin

    // Verifier si $id_matiere existe.
    if (!idExisteMatiere($id_matiere)) {
        return -1;
    }

    // Verifier si $date_debut valide
    if (!isExistedate($date_debut)) {
        return -5;
    }

    // Verifier si $date_fin valide
    if (!isExistedate($date_fin)) {
        return -6;
    }

    // liste des resultat
    $listResult = array();

    // id_cours du premier cours inserer
    $id_cours = -1;

    // récuperation accé BDD
    $bd = getConnexion();
    // Nombre d'insertion à faire
    for ($i = 0; $i < $max_count; $i++) {
        // Verifier si le cours n'est pas présent

        // cas ou on à pas pu recuperer le id_cours car cours deja inserer
        if ($i > 0 && $id_cours == -1) {
            $id_cours = coursExisteCours($id_matiere, $tab_libelle_groupe[$i-1], $tab_id_filiere[$i-1], $tab_id_professeur[$i-1], $tab_numero_salle[$i-1], $date_debut, $date_fin);
            var_dump($id_cours);
        }

        if (coursExisteCours($id_matiere, $tab_libelle_groupe[$i], $tab_id_filiere[$i], $tab_id_professeur[$i], $tab_numero_salle[$i], $date_debut, $date_fin) > 0)  {
            $listResult[] = 0;
            continue;
        }

        // vérification des champs restant

        // Verifier si $id_groupe existe
        if (!isExisteGroupeEtudiant($tab_libelle_groupe[$i], $tab_id_filiere[$i])) {
            $listResult[] = -2;
            continue;
        }

        // Verifier si $id_professeur existe
        if (!isProfesseur($tab_id_professeur[$i])) {
            $listResult[] = -3;
            continue;
        }

        // Verifier si $numero_salle existe
        if (!numeroExisteSalle($tab_numero_salle[$i])) {
            $listResult[] = -4;
            continue;
        }

        $rqt = "";
        if ($i == 0) {
            // si premier passage
            $rqt = "INSERT INTO cours(id_matiere, id_filiere, libelle_groupe, id_professeur, numero_salle, date_debut, date_fin) VALUES (:id_matiere, :id_filiere, :libelle_groupe, :id_professeur, :numero_salle, :date_debut, :date_fin)";
        } else {
            // si un autre passge
            $rqt = "INSERT INTO cours(id_cours, id_matiere, id_filiere, libelle_groupe, id_professeur, numero_salle, date_debut, date_fin) VALUES (:id_cours, :id_matiere, :id_filiere, :libelle_groupe, :id_professeur, :numero_salle, :date_debut, :date_fin)";
        }

        // Préparation de la rqt
        $stmt = $bd->prepare($rqt);

        if ($i != 0) {
            $stmt->bindParam(":id_cours", $id_cours);
        }
        $stmt->bindParam(":id_matiere", $id_matiere);
        $stmt->bindParam(":id_filiere", $tab_id_filiere[$i]);
        $stmt->bindParam(":libelle_groupe", $tab_libelle_groupe[$i]);
        $stmt->bindParam(":id_professeur", $tab_id_professeur[$i]);
        $stmt->bindParam(":numero_salle", $tab_numero_salle[$i]);
        $stmt->bindParam(":date_debut", $date_debut);
        $stmt->bindParam(":date_fin", $date_fin);

        // création du cours
        $stmt->execute();

        // récupération id_cours du premier cours insérer
        if ($i == 0) {
            $id_cours = coursExisteCours($id_matiere, $tab_libelle_groupe[$i], $tab_id_filiere[$i], $tab_id_professeur[$i], $tab_numero_salle[$i], $date_debut, $date_fin);
        }

        // on ajoute l'id du cour créé
        $listResult[] = $id_cours;

    } // fin boucle

    // le resultat
    return $listResult;

}

/**
 * Verifie si une datetime est correct
 * Format = '2018-01-04 23:55:59'
 * @param  DateTime $date La date à vérifier
 * @return boolean        True si créé false sinon
 */
function isExistedate($date) {
    $format = 'Y-m-d H:i:s';

    $DateTime = DateTime::createFromFormat($format, $date);

    return $DateTime && $date == $DateTime->format($format);
}

/**
 * Verfie si un cour existe
 * @param  integer $id_matiere      L'id de la matiere
 * @param  string $libelle_groupe   Un libelle du groupe du cours
 * @param  integer $id_filiere      Un id_filiere du cours
 * @param  integer $id_professeur   Un id_professeur du cours
 * @param  string $numero_salle     Un numero salles du cours
 * @param  DateTime $date_debut     La date de debut du cours
 * @param  DateTime $date_fin       La date de fin du cours
 * @return integer                  l'id du cours
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


function deleteByDateCours($id_filiere, $date_debut, $date_fin) {
    $bd = getConnexion();

    //SELECT id_cours FROM cours WHERE id_matiere=39 AND id_filiere=40 AND libelle_groupe='TD01' AND id_professeur=97 AND numero_salle="A300" AND date_debut='2018-12-22 10:00:00' AND date_fin='2018-12-22 12:00:00'
    $rqt = "DELETE FROM cours WHERE id_filiere = :id_filiere AND date_debut BETWEEN :date_deb_sup AND : date_fin_sup";

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

/**
 * Renvoie la liste des absence d'un groupe d'étudiant en JSON
 * @param  integer $id_filiere     id de la filiere
 * @param  string  $libelle_groupe libelle du groupe
 * @param  string  $id_matiere     id de la matiere
 * @return JSON                    Un JSON contenant la liste des cours et leur
 * heur de debut [id_cours, date_debut]
 */
function selectWithGroupeEtudiantMatiereCours($id_filiere, $libelle_groupe, $id_matiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT C.id_cours, C.date_debut FROM cours C JOIN matiere M ON C.id_matiere = M.id_matiere WHERE C.id_filiere = :id_filiere AND C.libelle_groupe = :libelle_groupe AND id_matiere = :id_matiere ";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":id_matiere", $id_matiere);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("id_cours"=>$ligne['id_cours'],
                                  "date_debut"=>$ligne['date_debut']);
        }
    }
    echo json_encode($listResult);
}

// TODO voir planning des cours de la semaine.

?>
