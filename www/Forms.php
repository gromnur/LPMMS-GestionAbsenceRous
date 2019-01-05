<?php

/**
 * création d'un département
 */
if (isset($_POST['nomCreaDept'])) {
    $nomCreaDept = htmlspecialchars($_POST['nomCreaDept']);

    createDepartement($nomCreaDept);
}


/**
 * création d'une filière
 */
if (isset($_POST['nomCreaFil']) && isset($_POST['comboxDeptCreaFil'])) {
    $nomCreaFil = htmlspecialchars($_POST['nomCreaFil']);
    $dept = htmlspecialchars($_POST['comboxDeptCreaFil']);

    createFiliere($nomCreaFil, $dept);
}

/**
 * création d'un personnel
 */
if (isset($_POST['nomCreaPerso']) && isset($_POST['prenomCreaPerso']) && isset($_POST['identifiantCreaPerso']) && isset($_POST['mdpCreaPerso'])) {
    $nomCrea = htmlspecialchars($_POST['nomCreaPerso']);
    $prenomCrea = htmlspecialchars($_POST['prenomCreaPerso']);
    $identifiantCrea = htmlspecialchars($_POST['identifiantCreaPerso']);
    $mdpCrea = htmlspecialchars($_POST['mdpCreaPerso']);

    $resultat = createPersonnel($identifiantCrea, $mdpCrea, $nomCrea, $prenomCrea);

    if ($resultat == 0) {
        echo 'echec de la création';
    }
}