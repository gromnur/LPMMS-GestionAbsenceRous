<?php

require('../DAOFactory.php');

razBDD();

$libelleGrEtud = "TD01";
$libelleFil = "info";
$libelleDep = "departement";
$ine = "azertyuiop001";
$nom = "nom";
$prenom = "prenom";

/*
 * Création etudiant
 */
echo "Insertion nouvelle etudiant : ";
$id_etudiant = createEtudiant($ine, $nom, $prenom);
if (strlen($id_etudiant) > 2 ) {
    echo "reussi, ine = ".$id_etudiant."<br>";
} else {
    echo "échoué code retours = ".$id_etudiant." <br>";
}


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
$id_gr_etud = createGroupeEtudiant($id_etudiant, $id_fil, $libelleGrEtud);
var_dump($id_gr_etud);
if (count($id_gr_etud) == 2 ) {
    echo "reussi, id_filiere = ".$id_gr_etud[0].", libelle = ".$id_gr_etud[1]."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion groupe_etudiant
echo "Insertion même groupe_etudiant : ";
$id_gr_etud2 = createGroupeEtudiant($id_etudiant, $id_fil, $libelleGrEtud);
var_dump($id_gr_etud2);
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

/*
 * Test select
 */

razBDD();

?>
