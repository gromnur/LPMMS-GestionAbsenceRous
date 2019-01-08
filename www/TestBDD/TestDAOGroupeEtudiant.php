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
echo "Insertion nouvelle etudiant <br> ";
$id_etudiant = createEtudiant($ine, $nom, $prenom);


/*
 * Création departement
 */
echo "Insertion nouveau departement  <br> ";
$id_dep = createDepartement($libelleDep);

/*
 * Création filiere
 */
echo "Insertion nouvelle filiere  <br> ";
$id_fil = createFiliere($libelleFil, $id_dep);

/*
 * Test création groupe_etudiant
 */
echo "Insertion nouveau groupe_etudiant : ";
$id_gr_etud = createGroupeEtudiant($id_etudiant, $id_fil, $libelleGrEtud);
if (count($id_gr_etud) == 2 ) {
    echo "reussi, id_filiere = ".$id_gr_etud[0].", libelle = ".$id_gr_etud[1]."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion groupe_etudiant
echo "Insertion même groupe_etudiant : ";
$id_gr_etud2 = createGroupeEtudiant($id_etudiant, $id_fil, $libelleGrEtud);
if (count($id_gr_etud2) == 0 ) {
    echo "groupe non créé, tableau vide retourné<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test groupe étudiant existe
 */
echo "GroupeEtudiant id créé présent : ";
if (isExisteGroupeEtudiant($libelleGrEtud, $id_fil)) {
    echo "Oui, le groupe étudiant existe <br>";
} else {
    echo "Erreur<br>";
}

razBDD();

?>
