<?php

require('../DAOFactory.php');

$numeropersonnel = 3;

/*
 * Test création professeur test aussi libelleExiste
 */
if (createProfesseur($numeropersonnel)!=0) {
    echo "Create professeur reussi <br>";
} else {
    echo "Create professeur echoué <br>";
}

// réinsertion departement
if (createProfesseur($numeropersonnel)==0) {
    echo "Create professeur erreur duplicata reussi <br>";
} else {
    echo "Create professeur erreur duplicata échoué <br>";
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
