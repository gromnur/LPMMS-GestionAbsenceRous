<?php

/*
 * Créés groupe d'étudiant avec le departement et la filiere
 * Return $idgroupe si le groupe est créé, 0 si la fillere n'existe pas,
 * -1 si le libelle n'existe pas
 */
function createGroupeEtudiant($id_filiere, $libelle) {

    // Verifie existance $id_filiere
    if (!idExisteFiliere($id_filiere)) {
        return 0;
    }

    // Verifier presence du libelle
    if (libelleExisteGroupeEtudiant($libelle) == 0) {
        return -1;
    }

    // Creation d'un groupe étudiant
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO groupe_etudiant(id_filiere,libelle) VALUES (:id_filiere,:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return libelleExisteGroupeEtudiant($libelle);

}

/*
 * Return la liste des groupeetudiant [$id_groupe_departement, $libelle]
 */
function selectAvecFiliereGroupeEtudiant($id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_groupe, libelle, id_fliere FROM groupe_etudiant WHERE id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("id_groupe"=>$ligne['id_groupe'],
                                  "libelle"=>$ligne['libelle'],
                                  "id_fliere"=>$ligne['id_fliere']);
        }
    }
    return $listResult;
}

/*
 * Return id_groupe_etudiant si present, 0 Sinon
 */
function libelleExisteGroupeEtudiant($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_groupe, libelle FROM groupe_etudiant WHERE libelle = :libelle";
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
function idExisteGroupeEtudiant($id_groupe_etudiant) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_groupe_etudiant FROM filiere WHERE id_groupe_etudiant = :id_groupe_etudiant";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_groupe_etudiant", $id_groupe_etudiant);
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

?>
