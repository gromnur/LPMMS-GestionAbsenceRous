<?php

require('../DAOFactory.php');

$id_heur_fin = "10:02";

/*
 * Test création heurFin
 */
echo "Insertion nouvelle heurFin : ";
$id_heurFin = createHeurFin($id_heur_fin);
if (strlen($id_heurFin) > 1) {
    echo "reussi, id_heurFin = ".$id_heurFin."<br>";
} else {
    echo "échoué code erreur = ".$id_heurFin."<br>";
}

// réinsertion heurFin
echo "Insertion même heurFin : ";
$id_heurFin2 = createHeurFin($id_heur_fin);
if (strlen($id_heurFin2) > 1) {
    echo "non inserer, id_heurFin retrourné = ".$id_heurFin2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_heurFin existe
 */
echo "HeurFin id créé présent : ";
$id_heurFin4 = heurFinExisteHeurFin($id_heurFin);
if ($id_heurFin4) {
    echo "Oui, id_heurFin = ".$id_heurFin."<br>";
} else {
    echo "Non<br>";
}

?>
