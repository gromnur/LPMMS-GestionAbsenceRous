<?php

require_once 'DAOFactory.php';

/**
 * Insere des eleves à partir d'un fichier CSV
 * @param  string $csv Chemin vers le fichier CSV
 */
function insertionElevesFromCSV($csv) {
	$row = 1;
	if (($handle = fopen($csv, "r")) !== FALSE) {
        // parcours le fichier
		while (($eleves = fgetcsv($handle, 0, ";")) !== FALSE) {
			$num = count($eleves);

			$ine = $eleves[0];
			$nom = $eleves[1];
			$prenom = $eleves[2];
			$filiere = $eleves[3];
			$groupes = array();
			for ($i=4; $i < $num; $i++) {
				$groupe = $eleves[$i];
				if (!empty($groupe)) {
					array_push($groupes, $groupe);
				}
			}

            // créé un etudiant
			createEtudiant($ine, $nom, $prenom);

			foreach($groupes as $groupe) {
				$id_filiere = libelleExisteFiliere($filiere);
				if ($id_filiere != 0) {
                    // créé le groupe étudiant si possible
					createGroupeEtudiant($ine, $id_filiere, $groupe);
				} else {
					throw new Exception("L'etudiant $ine n'a pas pu être créé : la filière $filiere n'existe pas");
				}
			}
		}
		fclose($handle);
	}
}

?>
