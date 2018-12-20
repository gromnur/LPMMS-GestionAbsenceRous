<?php

require('../DAOFactory.php');

$numeropersonnel = 4;
$id_administratif = 4;
$id_filiere = 1;

/*
 * Test création administratif test aussi libelleExiste
 */
if (createAdministratif($numeropersonnel)!=0) {
    echo "Create administratif reussi <br>";
} else {
    echo "Create administratif echoué <br>";
}

// réinsertion departement
if (createAdministratif($numeropersonnel)==0) {
    echo "Create administratif erreur duplicata reussi <br>";
} else {
    echo "Create administratif erreur duplicata échoué <br>";
}

if (updateResponsableAdministratif($id_administratif, $id_filiere)== 1) {
    echo "update reussi<br>";

} else if (updateResponsableAdministratif($id_administratif, $id_filiere)== 0) {
    echo "update echoué erreur id admin<br>";
} else if (updateResponsableAdministratif($id_administratif, $id_filiere)== -1) {
    echo "update echoué erreur filiere<br>";
} else if (updateResponsableAdministratif($id_administratif, $id_filiere)== -2) {
    echo "update echoué erreur unicité<br>";
}

/*
 * Test id existe
 */
if (isAdministratif($numeropersonnel)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

?>
