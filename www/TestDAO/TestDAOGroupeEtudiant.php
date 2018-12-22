<?php

require('../DAOFactory.php');

$libelleGrEtud = "4efz44";
$libelleFil = "FFF14z14f45";
$libelleDep = "aors1441zf34215";

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
if ($id_fil > 0) {
    echo "reussi, id_filiere = ".$id_fil."<br>";
} else {
    echo "échoué <br>";
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

// réinsertion groupe_etudiant
echo "Insertion même groupe_etudiant : ";
$id_gr_etud2 = createGroupeEtudiant($id_fil, $libelleGrEtud);
if (count($id_gr_etud2) == 0 ) {
    echo "groupe non créé, tableau vide retourné<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test groupe étudiant existe
 */
echo "GroupeEtudiant id créé présent : ";
$id_gr_etud3 = groupeExisteGroupeEtudiant($libelleGrEtud, $id_fil);
if (count($id_gr_etud3) == 2 ) {
    echo "Oui, id_filiere = ".$id_gr_etud3["id_filiere"].", libelle = ".$id_gr_etud3["libelle"]."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test Select département
 */
echo "List des GroupeEtudiant avec id_filiere : ";
var_dump(selectAvecFiliereGroupeEtudiant($id_fil));
echo ("<br>");


?>