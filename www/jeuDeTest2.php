<?php

require('DAOFactory.php');

$id_matiere = 13;
$tab_libelle_groupe = array("TD01","TD02");
$tab_id_filiere = array(13,13);
$tab_id_professeur = array(31,2);
$tab_numero_salle = array("A300");
$date_debut = "2018-12-22 10:00:00";
$date_fin = "2018-12-22 11:00:00";


$test1 = createCours($id_matiere, $tab_libelle_groupe, $tab_id_filiere, $tab_id_professeur, $tab_numero_salle, $date_debut, $date_fin);
echo $test1
?>
