<?php

/**
 * Créés groupe d'étudiant avec le departement et la filiere et l'ine d'un étudiant
 * @param  integer $ine            Numero ine de l'étudiant
 * @param  integer $id_filiere     L'id de la filiere
 * @param  string $libelle_groupe  Le libelle du groupe
 * @return array                  [$libelle_groupe, $id_filiere]
 */
function createGroupeEtudiant($ine, $id_filiere, $libelle_groupe) {

    // verifier l'ine
    if(ineExisteEtudiant($ine) != 0){
        return array();
    }

    // Creation d'un groupe étudiant
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO groupe_etudiant(ine,id_filiere,libelle_groupe) VALUES (:ine,:id_filiere,:libelle_groupe)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":ine", $ine);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":id_filiere", $id_filiere);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return array($libelle_groupe, $id_filiere);
}

/**
 * La liste des groupeEtudiant d'une filiere
 * @param  integer $id_filiere l'id de la filiere
 * @return JSON                Un Json de la liste des groupeetudiant [$libelle]
 */
function selectAvecFiliereGroupeEtudiant($id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT DISTINCT libelle_groupe FROM groupe_etudiant WHERE id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("libelle_groupe"=>$ligne['libelle_groupe']);
        }
    }
    echo json_encode($listResult);
}

/**
 * Verifie si le $libelle_groupe et le $id_filiere est déja dans la Table filiere.
 * @param  string  $libelle_groupe Le libelle du groupe
 * @param  integer $id_filiere     L'id de la filiere
 * @return boolean                 True si present false sinon
 */
function isExisteGroupeEtudiant($libelle_groupe, $id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT libelle_groupe, id_filiere FROM groupe_etudiant WHERE libelle_groupe = :libelle_groupe AND id_filiere = :id_filiere";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
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

/**
 * Sélectionne les etudiant d'un groupe d'etudiant
 * @param  string $libelle_groupes Le libelle du groupe
 * @param  integer $id_filiere     L'id de la filiere
 * @return JSON                    Un JSON contenant [ine, nom, prenom] pour chaque etudiant
 */
function selectAvecGroupeEtudiantEtudiant($libelle_groupe, $id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT ine, nom, prenom FROM groupe_etudiant G JOIN etudiant E ON G.ine = E.ine WHERE G.id_filiere = :id_filiere AND G.libelle_groupe = :libelle_groupe";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
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

    echo json_encode($listResult);
}

?>
