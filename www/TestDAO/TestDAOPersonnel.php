<?php

require('../DAOFactory.php');

$nom = "// zef: ";
$prenom = "mrfr: ";
$identifiant = "le test";
$mdp = hash('sha256',"ger");


/*
 * Test création personnel test
 */
if (createPersonnel($identifiant, $mdp, $nom, $prenom) !=0 ) {
    echo "Create personnel reussi <br>";
} else {
    echo "Create personnel echoué <br>";
}

// réinsertion departement
if (createPersonnel($identifiant, $mdp, $nom, $prenom)==0) {
    echo "Create personnel erreur duplicata reussi <br>";
} else {
    echo "Create personnel erreur duplicata échoué <br>";
}

/*
 * Test id existe
 */
if (identifiantExistePersonnel($identifiant)) {
    echo "Test id existe reussi<br>";
} else {
    echo "Test id existe échoué<br>";
}

// TODO test verifmdp

?>
