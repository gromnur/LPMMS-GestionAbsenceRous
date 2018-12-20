<?php


/*
 * Créé un professeur
 * Renvoi le numeropersonnel du professeur
 */
function createProfesseur($numeropersonnel) {
    // verifiaction presence professeur
    if (isProfesseur($numeropersonnel)) {
        return false;
    }

    // Creation d'un professeur
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "INSERT INTO professeur(id_professeur) VALUES (:numeropersonnel)";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
    // execution requette
    $stmt->execute();
    // renvoi le libelle généré
    return $numeropersonnel;

}

/*
 * Return true si le numeros personnel est present dans la table professeur, false sinon
 */
function isProfesseur($numeropersonnel) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_professeur FROM professeur WHERE id_professeur = :numeropersonnel";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":numeropersonnel", $numeropersonnel);
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
