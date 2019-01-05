<?php

require 'DAOFactory.php';

function insertionElevesFromCSV($csv) {

	$row = 1;
	if (($handle = fopen($csv, "r")) !== FALSE) {
		while (($eleves = fgetcsv($handle, 0, ";")) !== FALSE) {
			$num = count($eleves);
			$ine = $eleves[0];
			$nom = $eleves[1];
			$prenom = $eleves[2];
			$filiere = $eleves[3];
			for ($i=4; $i < $num; $i++) {
				$groupes = array();
				$groupe = $eleves[$i];
				echo '('.$groupe.')<br/>';
				echo '('.$groupe != "".')<br/>';
				if ($groupe != "") {
					$groupes[] = $groupe);
				}
			}

			echo $ine.'<br/>';
			echo $nom.'<br/>';
			echo $prenom.'<br/>';
			echo $filiere.'<br/>';
			var_dump($groupes).'<br/>';

		}
		fclose($handle);
	}
}
insertionElevesFromCSV("Eleve.csv");

?>
