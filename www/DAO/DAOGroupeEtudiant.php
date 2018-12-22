<?php

/*
 * Créés groupe d'étudiant avec le departement et la filiere
 * Return [$id_filiere, $libelle], sinon une liste vide si non créé.
 */
function createGroupeEtudiant($id_filiere, $libelle) {

    // Verifier presence du libelle/id_filiere
    if (count(groupeExisteGroupeEtudiant($libelle, $id_filiere)) != 0) {
        return array();
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
    return groupeExisteGroupeEtudiant($libelle, $id_filiere);

}

/*
 * Return la liste des groupeetudiant [$id_groupe_departement, $libelle]
 */
function selectAvecFiliereGroupeEtudiant($id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT libelle, id_filiere FROM groupe_etudiant WHERE id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("libelle"=>$ligne['libelle'],
                                  "id_filiere"=>$ligne['id_filiere']);
        }
    }
    return $listResult;
}

/*
 * Return [$id_filiere, $libelle] si present, sinon une liste vide
 */
function groupeExisteGroupeEtudiant($libelle, $id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT libelle, id_filiere FROM groupe_etudiant WHERE libelle = :libelle AND id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return array();
    } else {
        return array("id_filiere" => $listResult[0]["id_filiere"],
                     "libelle" => $listResult[0]["libelle"]);
    }
}

?>
