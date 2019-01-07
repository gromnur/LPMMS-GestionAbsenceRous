<?php

/*
 * Créés une abscence avec le id_cours et le ine
 * Return [$id_cours, $ine], sinon une liste vide si non créé.
 */
function createAbsence($id_cours, $ine) {

    // Verifier presence du libelle/id_filiere
    if (count(isExisteAbsence($id_cours, $ine)) != 0) {
        return array();
    }

    // Creation d'une absence
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
 * supprime une abscence avec le id_cours et le ine
 * Return liste vide , sinon [$id_cours, $ine]
 */
function deleteAbsence($id_cours, $ine) {

    // Verifier presence du id_cours/ine
    if (count(isExisteAbsence($id_cours, $ine)) != 0) {
        return array();
    }

    // Creation d'une abxence
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "DELETE FROM absence WHERE ine = :ine AND id_cours = :id_cours";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_cours", $id_cours);
    $stmt->bindParam(":ine", $ine);
    // execution requette
    $stmt->execute();
    // renvoi un array vide car le libelle n'existe plus
    return isExisteAbsence($id_cours, $ine);

}

/*
 * Return [$id_cours, $ine] si present, sinon une liste vide
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
 * supprime groupe d'étudiant avec le departement et la filiere
 * Return true si reussi, false sinon;
 */
function updateAbsence($id_cours, $ine, $justifier) {

    // Verifier presence du libelle/id_filiere
    if (count(isExisteAbsence($id_cours, $ine)) == 0) {
        return false;
    }

    // mise a jour d'une absence
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "UPDATE absence SET justifier=:justifier WHERE ine = :ine AND id_cours = :id_cours";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_cours", $id_cours);
    $stmt->bindParam(":ine", $ine);
    $stmt->bindParam(":justifier", $justifier);
    // execution requette
    $stmt->execute();
    // renvoi reussi
    return true;

}

/*
 * Return la liste des absence [id_cours, id_matiere, date_debut, date_fin]
 */
function selectAvecEtudiantAbsence($ine) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT M.libelle, C.date_debut, C.date_fin, A.justifier FROM absence A JOIN cours C ON A.id_cours = C.id_cours JOIN matiere M ON C.id_matiere = M.id_matiere WHERE A.ine = :ine";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":ine", $ine);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("libelle"=>$ligne['libelle'],
                                  "date_debut"=>$ligne['date_debut'],
                                  "date_fin"=>$ligne['date_fin'],
                                  "justifier"=>$ligne['justifier']);
        }
    }
    echo json_encode($listResult);
}

/*
 * Return la liste des absence [id_cours, id_matiere, date_debut, date_fin]
 */
function selectWithGroupeEtudiantAbsence($id_filiere, $libelle_groupe) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT A.ine, E.nom, E.prenom, M.libelle, C.date_debut, C.date_fin, A.justifier FROM etudiant E JOIN absence A ON A.ine = E.ine JOIN cours C ON A.id_cours = C.id_cours JOIN matiere M ON C.id_matiere = M.id_matiere WHERE C.id_filiere = :id_filiere AND C.libelle_groupe = :libelle_groupe";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("ine"=>$ligne['ine'],
                                  "nom"=>$ligne['nom'],
                                  "prenom"=>$ligne['prenom'],
                                  "libelle"=>$ligne['libelle'],
                                  "date_debut"=>$ligne['date_debut'],
                                  "date_fin"=>$ligne['date_fin'],
                                  "justifier"=>$ligne['justifier']);
        }
    }
    echo json_encode($listResult);
}

?>
