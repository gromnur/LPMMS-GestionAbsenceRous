<?php

/*
 * Créés des etudiant avec leur nom, prenom, idGroupe et ine
 * Return true si créé/existant, false si erreur
 */
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

/*
 * Return true si present, false Sinon
 */
/**
 * [ineExisteEtudiant description]
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

?>
