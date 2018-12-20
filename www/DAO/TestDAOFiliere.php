<?php

require('../DAOFactory.php');

$libelle = "testFiliere";
$id_filiere = 1;
$id_departement = 1;


/*
 * Test création filiere test aussi libelleExiste
 */
if (createFiliere($libelle, $id_departement)!=0) {
    echo "Create filiere reussi <br>";
} else {
    echo "Create filiere echoué <br>";
}

// réinsertion departement
if (createFiliere($libelle, $id_departement)==0) {
    echo "Create filiere erreur duplicata reussi <br>";
} else {
    echo "Create filiere erreur duplicata échoué <br>";
}

/*
 * Test ajoutResponsableFiliereAdministratif
 */
if (ajoutResponsableFiliereAdministratif($id_filiere, $id_administratif)) {
    echo "Update responsable reussi<br>";
} else {
    echo "Update responsable echoué<br>";
}

/*
 * Test Select filiere
 */
print_r(selectAvecDepartementFiliere($id_departement));
echo ("<br>");

/*
 * Test id existe
 */
if (idExisteFiliere(1)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

?>
