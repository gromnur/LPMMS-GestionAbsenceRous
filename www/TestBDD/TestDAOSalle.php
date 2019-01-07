<?php

require('../DAOFactory.php');

$libelleSalle = "A37";

razBDD();
/*
 * Test création salle
 */
echo "Insertion nouvelle salle : ";
$id_salle = createSalle($libelleSalle);
if (strlen($id_salle) > 1) {
    echo "reussi, id_salle = ".$id_salle."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion salle
echo "Insertion même salle : ";
$id_salle2 = createSalle($libelleSalle);
if ($id_salle2 == 0) {
    echo "non inserer, id_salle retrourné = ".$id_salle2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_salle existe
 */
echo "Salle id créé présent : ";
$id_salle4 = numeroExisteSalle($id_salle);
if ($id_salle4) {
    echo "Oui, id_salle = ".$id_salle."<br>";
} else {
    echo "Non<br>";
}

razBDD();

?>
