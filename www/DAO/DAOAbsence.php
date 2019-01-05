<?php

/*
 * Créés groupe d'étudiant avec le departement et la filiere
 * Return [$id_filiere, $libelle], sinon une liste vide si non créé.
 */
function createAbsence($id_cours, $ine) {

    // Verifier presence du libelle/id_filiere
    if (count(isExisteAbsence($id_cours, $ine)) != 0) {
        return array();
    }

    // Creation d'un groupe étudiant
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO absence(id_cours, ine) VALUES (:id_cours, :ine)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_cours", $id_cours);
    $stmt->bindParam(":ine", $ine);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return isExisteAbsence($id_cours, $ine);

}

/*
 * Return [$id_filiere, $libelle] si present, sinon une liste vide
 */
function isExisteAbsence($id_cours, $ine) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_cours, ine FROM absence WHERE id_cours = :id_cours AND ine = :ine";
    $stmt = $bd->prepare($rqt);

    // ajout param
    $stmt->bindParam(":id_cours", $id_cours);
    $stmt->bindParam(":ine", $ine);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return array();
    } else {
        return array("id_cours" => $listResult[0]["id_cours"],
                     "ine" => $listResult[0]["ine"]);
    }
}


/*
 * Return la liste des absence [id_cours, id_matiere, date_debut, date_fin]
 */
function selectAvecEtudiantAbsence($ine) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT C.id_cours, C.id_matiere, C.date_debut, C.date_fin FROM absence A JOIN cours C ON A.id_cours = C.id_cours WHERE A.ine = :ine";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":ine", $ine);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("id_cours"=>$ligne['id_cours'],
                                  "id_matiere"=>$ligne['id_matiere'],
                                  "date_debut"=>$ligne['date_debut'],
                                  "date_fin"=>$ligne['date_fin']);
        }
    }
    echo json_encode($listResult);
}

// TODO faire les vue absence pour un groupe d'etudiant


?>
