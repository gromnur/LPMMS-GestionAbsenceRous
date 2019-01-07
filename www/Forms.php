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
    foreach ($tableau as $ine) {
        createAbsence($id_cours, $ine);
    }
}

/**
 * suppression cours d'une filiere
 */
if (isset($_POST['deptFil']) && isset($_POST['dateMinDelete']) && isset($_POST['dateMaxDelete'])) {
    $fil = $_POST['deptFil'];
    $dateMin = $_POST['dateMinDelete'];
    $dateMax = $_POST['dateMaxDelete'];
    var_dump($dateMax);
//    deleteByDateCours($fil, $dateMin, $dateMax);
}