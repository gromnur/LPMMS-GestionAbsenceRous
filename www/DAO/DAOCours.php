<?php

/*
 * Créé un cours. l'index $tab_libelle_groupe doit correspondre à l'index $tab_id_filiere
 * $tab_libelle_groupe et $tab_id_filiere doivent avoir le meme nombre de donné sinon erreur -2.
 * Renvoi id_cours si inserer, 0 si le cours est déja présent,
 * -1 si id_matiere n'existe pas,
 * -2 si le groupe d'étudiant n'existe pas,
 * -3 si le id_prefesseur n'existe ftp_pas,
 * -4 si le numero de salle n'éxiste ftp_pas,
 * -5 si l'datee de debut n'existe pas pas,
 * -6 si l'date de fin n'existe pas pas

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
    var_dump($max_count);

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

    //  Insertion 1

    // verifiction des champs stables : $id_matiere, $date_debut, $date_fin

    // Verifier si $id_matiere existe.
    echo "matiere existe <br>";
    if (!idExisteMatiere($id_matiere)) {
        return -1;
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

    // Nombre d'insertion a faire -1
    for ($i = 1; $i < $max_count; $i++) {
        var_dump($i);
    }

    // Verifier si le cours n'est pas présent
    echo "verif cours existe <br>";
    $id_cours = coursExisteCours($id_matiere, $tab_libelle_groupe[0], $tab_id_filiere[0], $tab_id_professeur[0], $tab_numero_salle[0], $date_debut, $date_fin);
    if ($id_cours > 1) {
        return 0;
    }

    // Verifier si $id_matiere existe.
    echo "matiere existe <br>";
    if (!idExisteMatiere($id_matiere)) {
        return -1;
    }

    // Verifier si $id_groupe existe
    echo "groupe existe <br>";
    if (!isExisteGroupeEtudiant($libelle_groupe, $id_filiere)) {
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

    echo "création cours existe <br>";
    // Creation d'un cours
    // récupération accés base de données
    $bd = getConnexion();

    // TODO table séquance pour les cours
    $rqt = "INSERT INTO cours(id_matiere, id_filiere, libelle_groupe, id_professeur, numero_salle, date_debut, date_fin) VALUES (:id_matiere, :id_filiere, :libelle_groupe, :id_professeur, :numero_salle, :date_debut, :date_fin)";
    $stmt = $bd->prepare($rqt);

    echo $id_matiere.", ".$id_filiere.", '".$libelle_groupe."', ".$id_professeur.", '".$numero_salle."', '".$date_debut."', '".$date_fin."'<br>";
    // ajout param
    $stmt->bindParam(":id_matiere", $id_matiere);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":id_professeur", $id_professeur);
    $stmt->bindParam(":numero_salle", $numero_salle);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);


    // Recupération de l'id cours

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
