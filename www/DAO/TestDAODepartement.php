<?php

require('DAODepartement.php');

$libelle = "jeutest";

/*
 * Test création département test aussi libelleExiste
 */
if (createDepartement($libelle)!=0) {
    echo "Create département reussi <br>";
} else {
    echo "Create département echoué <br>";
}

// réinsertion departement
if (createDepartement($libelle)==0) {
    echo "Create département erreur duplicata reussi <br>";
} else {
    echo "Create département erreur duplicata echoué <br>";
}


/*
 * Test Select département
 */
selectDepartement();


?>
