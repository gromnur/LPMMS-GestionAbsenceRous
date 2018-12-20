<?php



/*
 * Créé un administratif
 * Renvoi le numeropersonnel de l'administratif
 */
function createAdministratif($identifiant, $mdp, $nom, $prenom) {
    // TODO appel la fonction verif personnel
    
        // Si present ajouter a la table administratif

        // Sinon appel createPersonnel

    // Creation d'un administratif

}

/*
 * Return true si le numeros personnel est present dans la tableadministratif, false sinon
 */
function isAdministratif($id_administratif) {

    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_administratif FROM administratif WHERE id_administratif = :id_administratif";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":id_administratif", $id_administratif);
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
