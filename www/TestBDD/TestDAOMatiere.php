<?php

require('../DAOFactory.php');

$libelleMat = "histoire";

/*
 * Test créations matieres
 */
echo "Insertion nouvelle matiere : ";
$id_mat = createMatiere($libelleMat);
if ($id_mat != 0) {
    echo "reussi, id_matiere = ".$id_mat."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion matiere
echo "Insertion même matiere : ";
$id_mat2 = createMatiere($libelleMat);
if ($id_mat2==0) {
    echo "non inserer, id_matiere retrourné = ".$id_mat2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_matiere existe
 */
echo "Matiere libelle présent : ";
$id_mat3 = libelleExisteMatiere($libelleMat);
if ($id_mat3 != 0) {
    echo "Oui, id_matiere = ".$id_mat3."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test id_matiere existe
 */
echo "Matiere id créé présent : ";
$id_mat4 = idExisteMatiere($id_mat);
if ($id_mat4) {
    echo "Oui, id_matiere = ".$id_mat."<br>";
} else {
    echo "Non<br>";
}

?>
