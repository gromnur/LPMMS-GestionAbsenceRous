<?php



/*
 * Ajoute un personnel dans la table personnel si celui-ci n'est pas present
 * Retourne le numeropersonnel du personnel ajouté
 */
function createPersonnel($identifiant, $mdp, $nom, $prenom) {
    // TODO faire le contenu

    // verifier la presence du personnel
        // Si present revoie le numero personnel

        // Si non present
            // l'ajoute
            // Renvoie le numero personnel
}

/*
 * Return 0 si personnel non present, sont numeropersonnel sinon
 */
function findPersonnel($nom, $prenom) {
    // TODO coder findPersonnel
}

/*
 * Le mot de passe doit etre crypté avec le sha256
 * Return une liste contenant $nom, $prenom, $numeropersonnel, null sinon
 */
function verifMDP($indentifiant, $mdp) {
    // TODO coder verifMDP
}



 ?>
