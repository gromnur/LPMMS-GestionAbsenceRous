<?php

require('AccesBDD.php');
require('DAODepartement.php')

/*
 * Créé une filiere
 * Renvoi true si inserer, false sinon
 */
function createFiliere($libelle, $id_departement) {
    // Verifier si le libelle est present
        // Si present renvoye false

    // Creation d'un departement

}

/*
 * La filiere doit etre crée à l'avance ansi que le departement
 * Ajoute un responsable filiere qui doit etre un administrtif
 * Return true ajouter false sinon.
 */
function ajoutResponsableFiliereAdministratif($id_filiere, $id_administratif) {
    // TODO coder ajoutResponsableFiliereAdministratif
    // Faire un ALTER TABLE
    // Verifie existance filiere
        // si present ajout et return true

    // sinon return false
}

/*
 * Return la liste des filire [$id_filiere, $libelle]
 */
function selectFiliereAvecDepartement($id_departement) {
    // TODO coder selectFiliereAvecDepartement
}

/*
 * Return id_filiere si present, 0 Sinon
 */
function libelleExisteFiliere($libelle) {
    // TODO coder libelleExisteDepartement
}

/*
 * Return true si present, false Sinon
 */
function idFiliereExisteFiliere($libelle) {
    // TODO coder idFiliereExisteFiliere
}
