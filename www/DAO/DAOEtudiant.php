<?php

/*
 * Créés des etudiant avec leur nom, prenom, idGroupe et ine
 * Return true si créé/existant, false si erreur
 */
function createEtudiant($ine, $nom, $prenom, $id_filiere, $libelle_groupe) {
    // verifier l'identifiant
    if(ineExisteEtudiant($ine) != 0){
        return 0;
    }

    // verifier le groupe
    if(count(groupeExisteGroupeEtudiant($libelle_groupe, $id_filiere)) == 0){
        return -1;
    }

    // Création personnel
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO etudiant(ine, nom, prenom, id_filiere, libelle_groupe) VALUES (:ine, :nom, :prenom, :id_filiere, :libelle_groupe)";

    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":ine", $ine);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    // execution requette
    $stmt->execute();

    // Renvoie le numero personnel
    return ineExisteEtudiant($ine);
}

/*
 * Return la liste des groupeetudiant [$nom, $prenom, $ine]
 */
function selectAvecGroupeEtudiantEtudiant($libelle_groupe,$id_filiere) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT ine, nom, prenom FROM etudiant WHERE id_filiere = :id_filiere AND libelle_groupe = :libelle_groupe";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_filiere", $id_filiere);
    $stmt->bindParam(":libelle_groupe", $libelle_groupe);

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

/*
 * Return true si present, false Sinon
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
