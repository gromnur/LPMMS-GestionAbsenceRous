<?php

/**
 * Créé une filiere
 * @param  string $libelle         Le libelle de la filiere
 * @param  integer $id_departement L'id du département
 * @return integer                 L'id_filiere si inserer, 0 si libelle deja présent,
 * -1 si id_departement non présent
 */

function createFiliere($libelle, $id_departement) {
    // Verifie si le libelle n'est pas present
    if (libelleExisteFiliere($libelle)) {
        // Si present renvoye 0
        return 0;
    }

    // Verifie que le id_departement existe
    if (idExisteDepartement($id_departement) == 0) {
        return -1;
    }

    // Creation d'une filiere
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO filiere(libelle,id_departement) VALUES (:libelle,:id_departement)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    $stmt->bindParam(":id_departement", $id_departement);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteFiliere($libelle);
}

/**
 * La liste des filiere
 * @return array La liste des filieres [$id_filiere, $libelle, $id_department]
 */
function selectFiliere() {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere, libelle FROM filiere";
    $stmt = $bd->prepare($rqt);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array('id_filiere'=>$ligne['id_filiere'],
                                  'libelle' =>$ligne['libelle']);
        }
    }
    return $listResult;
}

/**
 * La liste des filiere d'un département
 * @param  integer $id_department L'id du département
 * @return JSON                   Un Json de la liste des filiere
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
            $listResult[] = array("id_filiere" => $ligne['id_filiere'],
                "libelle" => $ligne['libelle'],
                "id_departement" => $ligne['id_departement']);
        }
    }
    echo json_encode($listResult);
}


/**
 * Verifie si le $libelle est déja dans la Table filiere.
 * @param  string $libelle Le libelle de la filiere
 * @return integer         id_filiere si present, 0 Sinon
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
        return $listResult[0]["id_filiere"];
    }
}

/**
 * Verifie si le $id_filiere est déja dans la Table filiere
 * @param  integer $id_filiere L'id de la filiere
 * @return boolean             True si présent, false sinon
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
