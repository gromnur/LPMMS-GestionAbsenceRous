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
if (isset($_POST['nomCreaPerso']) && isset($_POST['prenomCreaPerso']) && isset($_POST['identifiantCreaPerso']) && isset($_POST['mdpCreaPerso']) && isset($_POST['choixCreaPerso'])) {
    $nomCrea = htmlspecialchars($_POST['nomCreaPerso']);
    $prenomCrea = htmlspecialchars($_POST['prenomCreaPerso']);
    $identifiantCrea = htmlspecialchars($_POST['identifiantCreaPerso']);
    $mdpCrea = htmlspecialchars($_POST['mdpCreaPerso']);
    $choixCrea = htmlspecialchars($_POST['choixCreaPerso']);
    $mdpCreaSha = sha1($mdpCrea);


    $resultat = createPersonnel($identifiantCrea, $mdpCreaSha, $nomCrea, $prenomCrea, $choixCrea);

    if (isset($_POST['filiereCreaPerso'])) {
        $filiere = $_POST['filiereCreaPerso'];
        if ($filiere != "null") {
            updateResponsableAdministratif($resultat, $filiere);
        }
    }

    if ($resultat == 0) {
        echo 'echec de la création';
    }
}