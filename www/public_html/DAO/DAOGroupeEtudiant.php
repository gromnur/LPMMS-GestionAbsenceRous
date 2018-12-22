<?php

require('AccesBDD.php');
require('DAOFiliere.php');

/*
 * Créés groupe d'étudiant avec le departement et la filiere
 */
function createGroupeEtudiant($id_filiere, $libelle) {
    // TODO createGroupeEtudiant
        // Verifie existance $id_filiere

        // Verifier presence du libelle
}

/*
 * Return la liste des groupeetudiant [$id_groupe_departement, $libelle]
 */
function selectAvecFiliereGroupeEtudiant($id_filiere) {
    // TODO coder selectAvecFiliereGroupeEtudiant
}

/*
 * Return id_groupe_etudiant si present, 0 Sinon
 */
function libelleExisteGroupeEtudiant($libelle) {
    // TODO coder libelleExisteGroupeEtudiant
}

/*
 * Return true si present, false Sinon
 */
function idExisteGroupeEtudiant($id_groupe_etudiant) {
    // TODO coder idFiliereExisteGroupeEtudiant
}

?>
