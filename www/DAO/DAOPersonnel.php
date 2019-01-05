<?php

/*
 * Ajoute un personnel dans la table personnel si celui-ci n'est pas present
 * Retourne le numeropersonnel du personnel ajouté, sinon 0
 */

function createPersonnel($identifiant, $mdp, $nom, $prenom, $choixCreaPerso = -1) {

    // verifier l'identifiant

    if (identifiantExistePersonnel($identifiant) != 0) {

        // Renvoie le numero personnel si rien n'est demander en plus
        if ($choixCreaPerso == -1) {
            return $numeropersonnel;
        }

        // Créé un administratif avec le $numeropersonnel
        if ($choixCreaPerso == 0) {
            return createAdministratif($numeropersonnel);
        }

        // Créé un professeur avec le $numeropersonnel
        if ($choixCreaPerso == 1) {
            return createProfesseur($numeropersonnel);
        }

        return 0;
    }

    // Création personnel
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO personnel(identifiant, nom, prenom, mdp ) VALUES (:identifiant, :nom, :prenom, :mdp)";

    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":identifiant", $identifiant);
    $stmt->bindParam(":mdp", $mdp);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    // execution requette
    $stmt->execute();

    $numeropersonnel = identifiantExistePersonnel($identifiant);

    // Renvoie le numero personnel si rien n'est demander en plus
    if ($choixCreaPerso == -1) {
        return $numeropersonnel;
    }

    // Créé un administratif avec le $numeropersonnel
    if ($choixCreaPerso == 0) {
        return createAdministratif($numeropersonnel);
    }

    // Créé un professeur avec le $numeropersonnel
    if ($choixCreaPerso == 1) {
        return createProfesseur($numeropersonnel);
    }
}

/*
 * Return 0 si indentifiant non present, sinon numeropersonnel
 */

function identifiantExistePersonnel($identifiant) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT numeropersonnel FROM personnel WHERE identifiant = :identifiant";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":identifiant", $identifiant);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0]["numeropersonnel"];
    }
}

/*
 * Return true si present, false Sinon
 */

function idExistePersonnel($numeropersonnel) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT numeropersonnel FROM personnel WHERE numeropersonnel = :numeropersonnel";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return false;
    } else {
        return true;
    }
}

/*
 * Le mot de passe doit etre crypté avec le sha256
 * Return une liste contenant [$nom, $prenom, $numeropersonnel], null sinon
 */

function verifMDP($identifiant, $mdp) {

    $mdpSha = sha1($mdp);

    $bd = getConnexion();

    // récupération nom prénom utilisateur
    $rqt = "SELECT nom, prenom, numeropersonnel FROM personnel WHERE identifiant = :identifiant and mdp = :mdp";
    $stmt = $bd->prepare($rqt);
// ajout param
    $stmt->bindParam(":identifiant", $identifiant);
    $stmt->bindParam(":mdp", $mdpSha);

// execution requette
    $stmt->execute();

    // init nulero prsonnel
    $numeropersonnel = -1;

    $listReturn = array();
    // récupération du numero personnel
    while ($ligne = $stmt->fetch()) {
        var_dump($ligne);
        $nom = $ligne["nom"];
        $prenom = $ligne["prenom"];
        $numeropersonnel = $ligne["numeropersonnel"];
    }
    // verif is administrateur
    // TODO DAO administrateur
    // verif is administratif
    if (isAdministratif($numeropersonnel) == true) {
        return array($nom, $prenom, 1);
    }

    // verif is professeur
    if (isProfesseur($numeropersonnel) == true) {
        return array($nom, $prenom, 2);
    }
}

?>