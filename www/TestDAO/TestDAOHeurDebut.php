<?php

require('../DAOFactory.php');

$id_heure = "10:05";

/*
 * Test création heurDebut
 */
echo "Insertion nouvelle heure : ";
$id_heure = createHeure($id_heure);
if (strlen($id_heure) > 1) {
    echo "reussi, id_heure = ".$id_heure."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion heurDebut
echo "Insertion même heurDebut : ";
$id_heure2 = createHeure($id_heure);
if (strlen($id_heure2) > 1) {
    echo "non inserer, id_heure retrourné = ".$id_heure2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_heure existe
 */
echo "Heure id créé présent : ";
$id_heure4 = isExisteHeure($id_heure);
if ($id_heure4) {
    echo "Oui, id_heure = ".$id_heure."<br>";
} else {
    echo "Non<br>";
}

?>
