<?php

require('../DAOFactory.php');

$libelle = "Francais";

/*
 * Test création département test aussi libelleExiste
 */
if (createMatiere($libelle)!=0) {
    echo "Create département reussi <br>";
} else {
    echo "Create département echoué <br>";
}

// réinsertion matiere
if (createMatiere($libelle)==0) {
    echo "Create département erreur duplicata reussi <br>";
} else {
    echo "Create département erreur duplicata échoué <br>";
}



/*
 * Test id existe
 */
if (idExisteMatiere(1)) {
    echo "Test id existe reussi";
} else {
    echo "Test id existe échoué";
}

?>
