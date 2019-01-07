<?php

/**
 * Créés des etudiant
 * @param  string $ine    Numero ine de l'étudiant
 * @param  string $nom    Nom de l'étudiant
 * @param  string $prenom Prenom de l'étudiant
 * @return string         Numero ine de l'étudiant
 */
function createEtudiant($ine, $nom, $prenom) {

    // verifier l'ine
    if(ineExisteEtudiant($ine) != 0){
        return 0;
    }

    // Création d'un étudiant
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO etudiant(ine, nom, prenom) VALUES (:ine, :nom, :prenom)";

    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":ine", $ine);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    // execution requette
    $stmt->execute();

    // Renvoie le numero personnel
    return ineExisteEtudiant($ine);
}


/**
 * Verifie si un étudiant existe
 * @param  string $ine  Numero ine de l'étudiant
 * @return boolean      true si present, false Sinon
 */
function ineExisteEtudiant($ine) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT ine FROM etudiant WHERE ine = :ine";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":ine", $ine);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        return $listResult[0]["ine"];
    }
}

/**
 * Renvoie la liste des absence d'un groupe d'étudiant en JSON
 * @param  integer $id_filiere     id du cours
 * @return JSON                    Un JSON contenant la liste des etudiant du cours
 * [ine, nom, prenom]
 */
function selectWithCoursEtudiant($id_cours) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT E.ine, E.nom, E.prenom FROM etudiant E JOIN groupe_etudiant G ON G.ine = E.ine JOIN cours C ON C.id_filiere = G.id_filiere AND G.libelle_groupe = C.libelle_groupe WHERE id_cours = :id_cours";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_cours);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array("ine"=>$ligne['ine'],
                                  "nom"=>$ligne['nom'],
                                  "prenom"=>$ligne['prenom']);
        }
    }
    echo json_encode($listResult);
}

?>
