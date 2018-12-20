<?php

/*
 * Créé un administratif
 * Renvoie le numeropersonnel de l'administratif
 */
function createAdministratif($numeropersonnel) {

    // verifiaction presence administratif
    if (isAdministratif($numeropersonnel)) {
        return false;
    }

    // Creation d'un administratif
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO administratif(id_administratif) VALUES (:numeropersonnel)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numeropersonnel;

}

/*
 * Met à jour un administratif pourqu'il devienne chef de filiere
 * Renvoi 1 si succé, renvoi 0 si l'aministrateur n'existe pas, -1 si la filiere n'existe pas
 * -2 si la filiere n'est pas unique dansla table
 */
function updateResponsableAdministratif($id_administratif, $id_filiere) {
    // verifiaction presence administratif
    if (!isAdministratif($id_administratif)) {
        return false;
    }

    // verifiaction presence administratif
    if (!idExisteFiliere($id_filiere)) {
        return false;
    }

    // verifiction id unique
    if (!isFiliereUniqueAdministratif($id_filiere)) {
        return false;
    }

    // Mise a jour d'un administratif
    $bd = getConnexion();
    $rqt = "UPDATE administratif SET id_filiere=:id_filiere WHERE id_administratif = :id_administratif";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_administratif", $id_administratif);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return true;

}

/*
 * Return true si le numeros personnel est present dans la tableadministratif, false sinon
 */
function isAdministratif($id_administratif) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_administratif FROM administratif WHERE id_administratif = :id_administratif";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_administratif", $id_administratif);
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
 * Return true si le nombre de filiere est < 1
 */
function isFiliereUniqueAdministratif($id_filiere) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere FROM administratif WHERE id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) < 1) {
        return true;
    } else {
        return false;
    }
}

 ?>
