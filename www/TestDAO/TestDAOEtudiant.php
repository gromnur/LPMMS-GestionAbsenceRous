<?php

require('../DAOFactory.php');

razBDD();

$ine = "azertyuiop001";
$nom = "nom";
$prenom = "prenom";


/*
 * Test création etudiant
 */
echo "Insertion nouvelle etudiant : ";
$id_etudiant = createEtudiant($ine, $nom, $prenom);
if (strlen($id_etudiant) > 2 ) {
    echo "reussi, ine = ".$id_etudiant."<br>";
} else {
    echo "échoué code retours = ".$id_etudiant." <br>";
}

// réinsertion etudiant
echo "Insertion même etudiant : ";
$id_etudiant2 = createEtudiant($ine, $nom, $prenom);
if ($id_etudiant2 != null ) {
    echo "étudiant non créé<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test étudiant existe
 */
echo "Etudiant ine créé présent : ";
$id_etudiant3 = ineExisteEtudiant($ine);
if (strlen($id_etudiant3) > 2 ) {
    echo "Oui, ine = ".$id_etudiant3."<br>";
} else {
    echo "Non<br>";
}

razBDD();

?>
