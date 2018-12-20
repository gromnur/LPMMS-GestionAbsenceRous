<?php

require('DAODepartement.php');

/*
 * Créé une filiere
 * Renvoi l'id_filiere si inserer, 0 si libelle deja présent,
 * -1 si id_departement non présent
 */
function createFiliere($libelle, $id_departement, $id_administratif) {
    // Verifie si le libelle n'est pas present
    if (libelleExisteFiliere($libelle) != 0) {
        // Si present renvoye 0
        echo "libelle deja présent";
        return 0;
    }

    // Verifie que le id_departement existe
    if (idExisteDepartement($id_departement) == 0) {
        echo "le depart existe";
        return -1;
    }

    // Verifie que le id_administratif existe
    if (idExisteDepartement($id_administratif) == 0) {
        echo "le adminif existe";
        return -1;
    }

    // Creation d'une filiere
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO filiere(libelle,id_departement, id_administratif) VALUES (:libelle,:id_departement,:id_administratif)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    $stmt->bindParam(":id_administratif", $id_administratif);
    $stmt->bindParam(":id_departement", $id_departement);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteFiliere($libelle);
}

/*
 * La filiere doit etre crée à l'avance ansi que le departement
 * Ajoute un responsable filiere qui doit etre un administrtif
 * Return true ajouter false sinon.
 */
function ajoutResponsableFiliereAdministratif($id_filiere, $id_administratif) {
    // TODO coder ajoutResponsableFiliereAdministratif
    // Faire un ALTER TABLE
    // Verifie existance filiere
        // si present ajout et return true

    // sinon return false
}

/*
 * Return la liste des filire [$id_filiere, $libelle, $id_department]
 */
function selectAvecDepartementFiliere($id_department) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere, libelle, id_departement FROM filiere WHERE id_departement = :id_departement";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_departement", $id_department);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array($ligne['id_filiere'], $ligne['libelle'],$ligne['id_departement']);
        }
    }
    echo json_encode($listResult);
}

/*
 * Return id_filiere si present, 0 Sinon
 */
function libelleExisteFiliere($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere, libelle FROM filiere WHERE libelle = :libelle";
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
        return $listResult[0];
    }
}

/*
 * Return true si present, false Sinon
 */
function idExisteFiliere($id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere FROM filiere WHERE id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_filiere", $id_filiere);
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
