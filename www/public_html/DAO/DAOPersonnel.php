<?php

/*
 * Ajoute un personnel dans la table personnel si celui-ci n'est pas present
 * Retourne le numeropersonnel du personnel ajouté, sinon 0
 */

function createPersonnel($identifiant, $mdp, $nom, $prenom) {

    // verifier l'identifiant
    if (identifiantExistePersonnel($identifiant) != 0) {
        return 0;
    }

    $mdp = sha1($mdp);
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

    // Renvoie le numero personnel
    return identifiantExistePersonnel($identifiant);
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
    $rqt = "SELECT nom, prenom, numeropersonnel FROM personnel WHERE identifiant = :identifiant and mdp = :mdp";
    $stmt = $bd->prepare($rqt);
// ajout param
    $stmt->bindParam(":identifiant", $identifiant);
    $stmt->bindParam(":mdp", $mdpSha);

// execution requette
    $stmt->execute();

    $listReturn = array();
    // récupération resultat
    while ($ligne = $stmt->fetch()) {
        $listReturn = array($ligne['nom'], $ligne['prenom'], $ligne['numeropersonnel']);
    }
    return $listReturn;
}

?>
