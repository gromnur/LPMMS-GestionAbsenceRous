<?php

/**
 * Ajoute un personnel dans la table personnel si celui-ci n'est pas present
 * @param  string  $identifiant    Identifiant de l'utilisateur du personnel
 * @param  string  $mdp            Mot de passe du personnel
 * @param  string  $nom            Nom du personnel
 * @param  string  $prenom         Prenom du personnel
 * @param  integer $choixCreaPerso Information sur le type de personnel que l'on
 * souhaite créé par la suite: 0 = administratif , 1 = professeur
 * @return integer                 Le numeropersonnel du personnel ajouté, sinon 0
 */
function createPersonnel($identifiant, $mdp, $nom, $prenom, $choixCreaPerso = -1) {

    // verifier l'identifiant

    if (identifiantExistePersonnel($identifiant) != 0) {
        $numeropersonnel = identifiantExistePersonnel($identifiant);

        $numeropersonnel = identifiantExistePersonnel($identifiant);
        // Renvoie le numero personnel si rien n'est demander en plus
        if ($choixCreaPerso == -1) {
            return 0;
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

/**
 * Verifie si l'identifiant du personnel existe
 * @param  integer $identifiant L'identifiant du personnel
 * @return integer              0 si indentifiant non présent, sinon numeropersonnel
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

/**
 * Verifie si le numero personnel existe
 * @param  integer $numeropersonnel Le numeropersonnel du personnel
 * @return boolean                  true si present, false sinon
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

/**
 * Verifie la combinaison mot de passe identifian
 * Le mot de passe doit etre crypté avec le sha256
 * @param  string $indentifiant L'identifiant du personnel
 * @param  string $mdp          Le mot de passe du personnel
 * @return array                [$nom, $prenom, $choixCreaPerso]
 * $choixCreaPerso :  0 = administrateur, 1 = administratif, 2 = professeur
 */
function verifMDP($identifiant, $mdp) {

    $bd = getConnexion();

    // récupération nom prénom utilisateur
    $rqt = "SELECT nom, prenom, numeropersonnel FROM personnel WHERE identifiant = :identifiant and mdp = :mdp";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":identifiant", $identifiant);
    $stmt->bindParam(":mdp", $mdp);

    // execution requette
    $stmt->execute();

    // init nulero prsonnel
    $numeropersonnel = -1;

    // récupération du numero personnel
    while ($ligne = $stmt->fetch()) {
        $nom = $ligne["nom"];
        $prenom = $ligne["prenom"];
        $numeropersonnel = $ligne["numeropersonnel"];
    }
    // verif is administrateur
    if (isAdministrateur($numeropersonnel)) {
        return array($nom, $prenom, 0);
    }

    // verif is administratif
    if (isAdministratif($numeropersonnel)) {
        return array($nom, $prenom, 1);
    }

    // verif is professeur
    if (isProfesseur($numeropersonnel)) {
        return array($nom, $prenom, 2);
    }
}

?>