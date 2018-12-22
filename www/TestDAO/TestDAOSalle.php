<?php

require('../DAOFactory.php');

$numero_salle = "A306";


/*
 * Test création salle test aussi libelleExiste
 */
if (createSalle($numero_salle)!=0) {
    echo "Create salle reussi <br>";
} else {
    echo "Create salle echoué <br>";
}

// réinsertion departement
if (createSalle($numero_salle)==0) {
    echo "Create salle erreur duplicata reussi <br>";
} else {
    echo "Create salle erreur duplicata échoué <br>";
}

/*
 * Test id existe
 */
if (numeroExisteSalle($numero_salle)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

?>
