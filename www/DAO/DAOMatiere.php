<?php

/*
 * Créé une matiere
 * Renvoi i si inserer, false sinon
 */
function createMatiere($libelle) {

    // Verifier si le libelle n'est pas present
    if (libelleExisteMatiere($libelle) != 0) {
        // Si present renvoye 0
        return 0;
    }

    // Creation d'un matiere
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO matiere(libelle) VALUES (:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteMatiere($libelle);

}

/*
 * Verifie si un libelle matiere existe
 * Return id_matiere si present, 0 Sinon
 */
function libelleExisteMatiere($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_matiere, libelle FROM matiere WHERE libelle = :libelle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0]["id_matiere"];
    }
}

/*
 * Verifie si l'id_matiere existe
 * Return true si present, false Sinon
 */
function idExisteMatiere($id_matiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_matiere FROM matiere WHERE id_matiere = :id_matiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_matiere", $id_matiere);
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
 * Renvoie la liste des matiere pour une certaine filiere
 * Return true si present, false Sinon
 */
function selectMatiereWithFiliere($id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT M.libelle FROM matiere M JOIN cours C ON M.id_matiere = C.id_matiere JOIN filiere F ON F.id_filiere = C.id_filiere WHERE F.id_filiere = :$id_filiere;";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("libelle"=>$ligne['libelle']);
        }
    }
    echo json_encode($listResult);

}
