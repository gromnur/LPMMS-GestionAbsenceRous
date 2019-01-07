<?php

require('../DAOFactory.php');

razBDD();

$libelleFil = "filiere";
$libelleFil2 = "filiere2";
$libelleDep = "departement";

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
 * Test création filiere
 */
echo "Insertion nouvelle filiere : ";
$id_fil = createFiliere($libelleFil, $id_dep);
if ($id_fil != 0) {
    echo "reussi, id_filiere = ".$id_fil."<br>";
} else {
    echo "échoué <br>";
}

/*
 * Test création filiere
 */
echo "Insertion nouvelle filiere : ";
$id_fil = createFiliere($libelleFil2, $id_dep);
if ($id_fil != 0) {
    echo "reussi, id_filiere = ".$id_fil."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion filiere
echo "Insertion même filiere : ";
$id_fil2 = createFiliere($libelleFil, $id_dep);
if ($id_fil2==0) {
    echo "non inserer, id_filiere retrourné = ".$id_fil2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_filiere existe
 */
echo "Filiere libelle présent : ";
$id_fil3 = libelleExisteFiliere($libelleFil);
if ($id_fil3 != 0) {
    echo "Oui, id_filiere = ".$id_fil3."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test id_filiere existe
 */
echo "Filiere id créé présent : ";
$id_fil4 = idExisteFiliere($id_fil);
if ($id_fil4) {
    echo "Oui, id_filiere = ".$id_fil."<br>";
} else {
    echo "Non<br>";
}

razBDD();

?>
