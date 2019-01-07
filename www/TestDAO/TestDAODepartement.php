<?php

require('../DAOFactory.php');

razBDD();

$libelleDep = "departement";

/*
 * Test création departement
 */
echo "Insertion nouveau departement : ";
$id_dep = createDepartement($libelleDep);
if ($id_dep != 0) {
    echo "reussi, id_departement = ".$id_dep."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion departement
echo "Insertion même departement : ";
$id_dep2 = createDepartement($libelleDep);
if ($id_dep2==0) {
    echo "non inserer, id_departement retrourné = ".$id_dep2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_departement existe
 */
echo "Departement libelle présent : ";
$id_dep3 = libelleExisteDepartement($libelleDep);
if ($id_dep3 != 0) {
    echo "Oui, id_departement = ".$id_dep3."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test id_departement existe
 */
echo "Departement id créé présent : ";
$id_dep4 = idExisteDepartement($id_dep);
if ($id_dep4) {
    echo "Oui, id_departement = ".$id_dep."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test Select département
 */
echo "List des département : ";
var_dump(selectDepartement());
echo ("<br>");

razBDD();

?>
