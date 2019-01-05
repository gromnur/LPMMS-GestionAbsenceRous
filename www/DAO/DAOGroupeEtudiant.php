<?php

/*
 * Créés groupe d'étudiant avec le departement et la filiere
 * Return true si créé, sinon false.
 */
function createGroupeEtudiant($ine, $id_filiere, $libelle) {

    // verifier l'ine
    if(ineExisteEtudiant($ine) != 0){
        return false;
    }

    // Creation d'un groupe étudiant
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO groupe_etudiant(ine,id_filiere,libelle) VALUES (:ine,:id_filiere,:libelle)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":ine", $ine);
    $stmt->bindParam(":libelle", $libelle);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return array($libelle, $id_filiere);

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
    echo json_encode($listResult);
}

/*
 * Return [$id_filiere, $libelle] si present, sinon une liste vide
 */
function isExisteGroupeEtudiant($libelle, $id_filiere) {
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
        return false;
    } else {
        return true;
    }
}

/*
 * Return [$id_filiere, $libelle] si present, sinon une liste vide
 */
function selectAvecGroupeEtudiantEtudiant($id_groupe, $id_filiere); {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT ine, nom, prenom FROM groupe_etudiant G JOIN etuiant E ON G.ine = E.ine WHERE id_groupe = :id_groupe AND id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_groupe", $id_groupe);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array('ine'=>$ligne['ine'],
                                  'nom' =>$ligne['nom'],
                                  'prenom' =>$ligne['prenom']);
        }
    }
}



?>
