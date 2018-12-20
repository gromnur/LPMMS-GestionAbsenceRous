<?php

require('../DAOFactory.php');

$numeropersonnel = 4;
$id_administratif = 4;
$id_filiere = 1;

/*
 * Test création administratif test aussi libelleExiste
 */
if (createProfesseur($numeropersonnel)!=0) {
    echo "Create administratif reussi <br>";
} else {
    echo "Create administratif echoué <br>";
}

// réinsertion departement
if (createProfesseur($numeropersonnel)==0) {
    echo "Create administratif erreur duplicata reussi <br>";
} else {
    echo "Create administratif erreur duplicata échoué <br>";
}

/*
 * Test id existe
 */
if (isProfesseur($numeropersonnel)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

?>
