<?php

/**
 * création d'un département
 */
if (isset($_POST['nomCreaDept'])) {
    //récupération du nom du départment en htmlspecialchars
    $nomCreaDept = htmlspecialchars($_POST['nomCreaDept']);

    //si le nom est vide on affecte 0 a la variable $resultat pour afficher une erreur dans la page
    // sinon le resultat prend la valeur retourner par la fonction createDepartement et on affiche succee
    // ou erreur
    if ($nomCreaDept != "") {
        $resultat = createDepartement($nomCreaDept);
    } else {
        $resultat = 0;
    }
}


/**
 * création d'une filière
 */
if (isset($_POST['nomCreaFil']) && isset($_POST['comboxDeptCreaFil'])) {
    //récupération du nom de la filiere et du departement en htmlspecialchars
    $nomCreaFil = htmlspecialchars($_POST['nomCreaFil']);
    $dept = htmlspecialchars($_POST['comboxDeptCreaFil']);
    //si le nom est vide on affecte 0 a la variable $resultat pour afficher une erreur dans la page
    // sinon le resultat prend la valeur retourner par la fonction createDepartement et on affiche succee
    // ou erreur
    if ($nomCreaFil != "") {
        $resultat = createFiliere($nomCreaFil, $dept);
    } else {
        $resultat = 0;
    }
}

/**
 * création d'un personnel
 */
if (isset($_POST['nomCreaPerso']) && isset($_POST['prenomCreaPerso']) && isset($_POST['identifiantCreaPerso']) && isset($_POST['mdpCreaPerso']) && isset($_POST['choixCreaPerso'])) {
    //passage de tout les parametre en htmlspecialchars
    $nomCrea = htmlspecialchars($_POST['nomCreaPerso']);
    $prenomCrea = htmlspecialchars($_POST['prenomCreaPerso']);
    $identifiantCrea = htmlspecialchars($_POST['identifiantCreaPerso']);
    $mdpCrea = htmlspecialchars($_POST['mdpCreaPerso']);
    $choixCrea = htmlspecialchars($_POST['choixCreaPerso']);
    //encryptage du mdp
    $mdpCreaSha = hash("sha256", $mdpCrea);

    //si le nom est vide on affecte 0 a la variable $resultat pour afficher une erreur dans la page
    // sinon le resultat prend la valeur retourner par la fonction createDepartement et on affiche succee
    // ou erreur
//    var_dump($nomCrea);
//    var_dump($prenomCrea);
//    var_dump($identifiantCrea);
//    var_dump($mdpCrea);
//    var_dump($choixCrea);
    if ($nomCrea != "" && $prenomCrea != "" && $identifiantCrea != "" && $mdpCrea != "" && $choixCrea != "") {
        $resultat = createPersonnel($identifiantCrea, $mdpCreaSha, $nomCrea, $prenomCrea, $choixCrea);
    } else {
        $resultat = 0;
    }

    //si le personnel créé est un adminitratif on recupere la filiere a laquelle il est associé
    // si aucune filière n'est associé alors l'appel a la fonction n'est pas fait
    if (isset($_POST['filiereCreaPerso'])) {
        $filiere = $_POST['filiereCreaPerso'];
        if ($filiere != "null") {
            updateResponsableAdministratif($resultat, $filiere);
        }
    }
}


/**
 * ajout absences etudiant
 */
if (isset($_POST["absences"])) {
    $tableau = $_POST["absences"];
    $id_cours = $_POST['id_cours'];
//    $resultat = array();
    foreach ($tableau as $ine) {
        $resultat = createAbsence($id_cours, $ine);
    }
}
/**
 * justification absences etudiants
 */
if (isset($_POST['justifie']) && isset($_POST["absences"])) {
    $justifieTab = $_POST["justifie"];
    $absent = $_POST["absences"];
    $id_cours = $_POST['id_cours'];

    foreach ($absent as $ine) {
        $array[] = $ine;
    }
    $index = 0;
    foreach ($justifieTab as $justifie) {
        updateAbsence($id_cours, $array[$index], $justifie);
        $index = $index + 1;
    }
}

/**
 * suppression cours d'une filiere
 */
if (isset($_POST['filDelete']) && isset($_POST['dateMinDelete']) && isset($_POST['dateMaxDelete'])) {
    $fil = $_POST['filDelete'];
    $dateMin = $_POST['dateMinDelete'];
    $dateMax = $_POST['dateMaxDelete'];
    deleteByDateCours($fil, $dateMin, $dateMax);
}

/**
 * Insere des eleves à partir d'un fichier CSV
 * @param  string $csv Chemin vers le fichier CSV
 */
function insertionElevesFromCSV($csv) {
    $row = 1;
    if (($handle = fopen($csv, "r")) !== FALSE) {
        // parcours le fichier
        while (($eleves = fgetcsv($handle, 0, ";")) !== FALSE) {
            $num = count($eleves);

            $ine = $eleves[0];
            $nom = $eleves[1];
            $prenom = $eleves[2];
            $filiere = $eleves[3];
            $groupes = array();
            for ($i = 4; $i < $num; $i++) {
                $groupe = $eleves[$i];
                if (!empty($groupe)) {
                    array_push($groupes, $groupe);
                }
            }

            // créé un etudiant
            createEtudiant($ine, $nom, $prenom);

            foreach ($groupes as $groupe) {
                $id_filiere = libelleExisteFiliere($filiere);
                if ($id_filiere != 0) {
                    // créé le groupe étudiant si possible
                    createGroupeEtudiant($ine, $id_filiere, $groupe);
                } else {
                    throw new Exception("L'etudiant $ine n'a pas pu être créé : la filière $filiere n'existe pas");
                }
            }
        }
        fclose($handle);
    }
}

if (isset($_POST['file'])) {
    insertionElevesFromCSV($_POST['file']);
}

if (isset($_FILES["fileICS"]["tmp_name"])) {
    icsExtractor($_FILES["fileICS"]["tmp_name"]);
}
