<?php

require('../DAOFactory.php');

$numero_salle = "A306";


/*
 * Test création salle test aussi libelleExiste
 */
if (createLocalisation($numero_salle)!=0) {
    echo "Create salle reussi <br>";
} else {
    echo "Create salle echoué <br>";
}

// réinsertion departement
if (createLocalisation($numero_salle)==0) {
    echo "Create salle erreur duplicata reussi <br>";
} else {
    echo "Create salle erreur duplicata échoué <br>";
}

/*
 * Test id existe
 */
if (idExisteLocalisation($numero_salle)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

?>
