<?php

/**
 * Créé un professeur
 * @param  integer $numeropersonnel Le numeropersonnel du personnel
 * @return integer                  Le numeropersonnel du professeur, 0 si la
 * personne est deja professeur, -1 si le personnel n'existe pas.
 */
function createProfesseur($numeropersonnel) {

    // verification presence professeur
    if (isProfesseur($numeropersonnel)) {
        return 0;
    }

    // verifiaction presence personnel
    if (!idExistePersonnel($numeropersonnel)) {
        return -1;
    }

    // Creation d'un professeur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO professeur(id_professeur) VALUES (:numeropersonnel)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numeropersonnel;

}

/**
 * Verifie si le personnel est déja dans la Table professeur.
 * @param  integer  $numeropersonnel Le numeropersonnel du personnel
 * @return boolean                   True si present, false sinon
 */
function isProfesseur($numeropersonnel) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_professeur FROM professeur WHERE id_professeur = :numeropersonnel";
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
 * Verifie si un professeur possede le nom et prenom donné
 * @param  string $nom    Le nom du prefesseur
 * @param  string $prenom Le prenom du professeur
 * @return integer          Le numeropersonnel/id_professeur si present, 0 sinon
 */
function libelleExisteProfesseur($nom, $prenom) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT numeropersonnel FROM personnel WHERE upper(nom) = :nom AND upper(prenom) = :prenom";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    // execution requette

    $listResult = array();

    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = $ligne['numeropersonnel'];
        }
    }

    // verification si la personne est bie nun professeur
    foreach ($listResult as $numeropersonnel) {
        if (isProfesseur($numeropersonnel)) {
            return $numeropersonnel;
        }
    }
    return 0;
}

 ?>
