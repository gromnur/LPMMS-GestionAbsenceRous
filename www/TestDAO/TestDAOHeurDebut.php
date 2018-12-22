<?php

require('../DAOFactory.php');

$id_heur_debut = "10:05";

/*
 * Test création heurDebut
 */
echo "Insertion nouvelle heurDebut : ";
$id_heurDebut = createHeurDebut($id_heur_debut);
if (strlen($id_heurDebut) > 1) {
    echo "reussi, id_heurDebut = ".$id_heurDebut."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion heurDebut
echo "Insertion même heurDebut : ";
$id_heurDebut2 = createHeurDebut($id_heur_debut);
if (strlen($id_heurDebut2) > 1) {
    echo "non inserer, id_heurDebut retrourné = ".$id_heurDebut2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_heurDebut existe
 */
echo "HeurDebut id créé présent : ";
$id_heurDebut4 = heurDebutExisteHeurDebut($id_heurDebut);
if ($id_heurDebut4) {
    echo "Oui, id_heurDebut = ".$id_heurDebut."<br>";
} else {
    echo "Non<br>";
}

?>
