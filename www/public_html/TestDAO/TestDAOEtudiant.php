<?php

require('../DAOFactory.php');

$libelleGrEtud = "efqkf4";
$libelleFil = "f4fzefq5";
$libelleDep = "aefez34215";
$ine = "qsdfghjkfwxc";
$nom = "rgkjk";
$prenom = "jfekz";

/*
 * Création departement
 */
echo "Insertion nouveau departement : ";
$id_dep = createDepartement($libelleDep);
if ($id_dep != 0) {
    echo "reussi, id_departement = ".$id_dep."<br>";
} else {
    echo "échoué <br>";
}

/*
 * Création filiere
 */
echo "Insertion nouvelle filiere : ";
$id_fil = createFiliere($libelleFil, $id_dep);
if ($id_fil ) {
    echo "reussi, id_filiere = ".$id_fil."<br>";
} else {
    echo "échoué<br>";
}

/*
 * Test création groupe_etudiant
 */
echo "Insertion nouveau groupe_etudiant : ";
$id_gr_etud = createGroupeEtudiant($id_fil, $libelleGrEtud);
if (count($id_gr_etud) == 2 ) {
    echo "reussi, id_filiere = ".$id_gr_etud["id_filiere"].", libelle = ".$id_gr_etud["libelle"]."<br>";
} else {
    echo "échoué <br>";
}

/*
 * Test création etudiant
 */
echo "Insertion nouvelle etudiant : ";
$id_etudiant = createEtudiant($ine, $nom, $prenom, $id_fil, $libelleGrEtud);
if (strlen($id_etudiant) > 2 ) {
    echo "reussi, ine = ".$id_etudiant."<br>";
} else {
    echo "échoué code retours = ".$id_etudiant." <br>";
}

// réinsertion etudiant
echo "Insertion même etudiant : ";
$id_etudiant2 = createEtudiant($ine, $nom, $prenom, $id_fil, $libelleGrEtud);
if ($id_etudiant2 > 0 ) {
    echo "étudiant non créé<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test groupe étudiant existe
 */
echo "Etudiant id créé présent : ";
$id_etudiant3 = ineExisteEtudiant($ine);
if (strlen($id_etudiant3) > 2 ) {
    echo "Oui, ine = ".$id_etudiant3."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test Select étudiant
 */
//echo "List des Etudiant avec id_filiere : ";
//var_dump(selectAvecFiliereEtudiant($id_fil));
//echo ("<br>");


?>
