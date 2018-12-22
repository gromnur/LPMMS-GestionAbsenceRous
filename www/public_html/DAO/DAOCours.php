<?php

require('AccesBDD.php');
require('DAOGroupeEtudiant.php');
require('DAOMatiere.php');

/*
 * Créés des cours avec leur nom, prenom, idGroupe et ine
 * Return true si créé/existant, false si erreur
 */
function createCours($id_matiere, $id_groupe, $horaireDebut, $horaireFin) {
    // TODO createCours
    // créé cours
}

/*
 * Return la liste des cours [$nom, $prenom, $ine]
 */
function selectCours($dateDebut,$dateFin, $id_groupe = null, $id_filiere = null, $id_departement = null, $id_matiere = null, $id_professeur = null) {
    // TODO coder selectAvecFiliereCours
    // Construire la requete en fonction des different argument passé pour affiner le resultat
}

/*
 * Delete tout les cours lier à un departement selectionné
 */
function dropDepartementCours($id_departement) {
    // TODO dropDepartementCours
    // Faire une grosse jointure et supprimer
}

?>
