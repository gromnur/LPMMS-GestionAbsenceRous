<?php

	include 'Objets/Cour.php';
	//include 'DataManagement.php';

	//On initialize la timezone
	// On utilise une commande pour donner la timezone par défault, pour utiliser les DATETIME par la suite
	// On récupère la liste des timeZone UTC et prend la premieère etant donné que l'on est en UTC + 0
	date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

	/*
	* Recupère le contenu d'un fichier .ics, le parse et en ressors un objet php
	* Cet objet contient toutes les infos permettant de devenir un cours
	*/
	function icsExtractor($nomFile) {
		$calendar = file_get_contents($nomFile);
		// recupere la filiere via le nom du fichier

		// Récupération de la FIliere via le nom du fichier ICS
		$listNom = explode(".",str_replace("/", ".", $nomFile));
		$filiere = $listNom[count($listNom)-2];

		//Préparation des recherche dans le fichier ics
		$intituleCours = "/SUMMARY:(.*)/";
		$dateCours = "/DTSTART:(.*)/";
		$dateCoursFin = "/DTEND:(.*)/";
		$descCours = "/DESCRIPTION:(.*)/";
		$location = "/LOCATION:(.*)/";

		// n sera le nombre d'élément du fichier ICS
		// recupère dans le tableau $coursTab tout les noms de cours
		$n = preg_match_all($intituleCours, $calendar, $coursTab, PREG_PATTERN_ORDER);

		// récupère dans le tableau dateTab tout les élements composant de la date début
		preg_match_all($dateCours, $calendar, $dateTab, PREG_PATTERN_ORDER);

		// recupère dans le tableau dateTabEnd tout les éléments composant de la date de fin
		preg_match_all($dateCoursFin, $calendar, $dateTabEnd, PREG_PATTERN_ORDER);

		// récupère dans le tableau descTab tout les éléments composant la description des cours (nomProf, promo)
		preg_match_all($descCours, $calendar, $descTab, PREG_PATTERN_ORDER);

		//recupère la salle de cours
		preg_match_all($location, $calendar, $salleTab, PREG_PATTERN_ORDER);

		$returnTab = array();
		// Parcours de tout le tableau
		for ($j=0 ; $j < $n ; ++$j) {
			/*
			* Recupère les données de la fonction en preg_match_all
			*/

			// Découpe la date de début
			$anneeD = substr($dateTab[0][$j], 8, 4);
			$moisD = substr($dateTab[0][$j], 12, 2);
			$jourD = substr($dateTab[0][$j], 14, 2);
			$heureD = substr($dateTab[0][$j], 17, 2);
			$minD = substr($dateTab[0][$j], 19, 2);

			// Découpe la date de fin
			$anneeF = substr($dateTabEnd[0][$j], 6, 4);
			$moisF = substr($dateTabEnd[0][$j], 10, 2);
			$jourF = substr($dateTabEnd[0][$j], 12, 2);
			$heureF = substr($dateTabEnd[0][$j], 15, 2);
			$minF = substr($dateTabEnd[0][$j], 17, 2);

			//Gestion des données du cours
			$titreCours = substr($coursTab[0][$j], 8);
			$descCours = explode("\\n",substr($descTab[0][$j], 12));

			// Retire le premier element du tableau, qui est une chaine vide
			array_splice($descCours, 0, 1);
			// retire le dernier element du tableau qui est la date de l'export
			array_splice($descCours, sizeof($descCours)-1, 1);


			//Intialisation des chaines de caractère pour catégoriser les cours
			$promo = "";
			$prof = array();
			// Si il manque des infos alors on rajoutera les informations qui en découle
			for ($i = 0; $i < sizeof($descCours); $i++) {

				// Si il n'y a pas de chiffre ni de - et qu'il y a un espace alors c'est bien un prof
				if(stripos($descCours[$i], " ") and preg_match('~[0-9]~', $descCours[$i]) === 0 and preg_match('~-~', $descCours[$i]) === 0) {
						$prof[] = $descCours[$i];
				} else {
						$promo .= $descCours[$i]."\\n";
				}
			}

			// Si le prof n'est pas indiqué -->
			if(sizeof($prof) == 0) {
					$prof[] = "non déterminé";
			}

			// Recupère le nom de la salle et sa description, en le détachant de LOCATION
			$salle = explode(":", $salleTab[0][$j]);
			// Sépare le numéro de salle et sa descritpion
			$salle = explode(" ",$salle[1]);
			//Recupère le num de la salle
			$numSalle = $salle[0];
			//Initialize la variable $descSalle a une chaine prédéfini si  de description
			$descSalle = "";
			if (sizeof($salle) > 1) {
					$descSalle = "(".$salle[1]." ".$salle[2].")";
			}

			// format les données entre elles
			$dateD = $anneeD."-".$moisD."-".$jourD;
			$dateTimeD = new DateTime($dateD);
			$dateTimeD->setTime($heureD, $minD);

			$dateF = $anneeF."-".$moisF."-".$jourF;
			$dateTimeF = new DateTime($dateF);
			$dateTimeF->setTime($heureF, $minF);

			// ajoute le nouvel objet de cours au tableau de cours a return
			$returnTab[$j] = new Cours($titreCours, $numSalle, $descSalle, $prof, $promo, $dateTimeD, $dateTimeF);
		}

		foreach($returnTab as $cours) {
			$profs = $cours->getProfs(); // Init profs
			$groupes = explode("\\n", $cours->getPromo()); // Groupes

			for ($i=0; $i < count($groupes); $i++) {
				if (strpos($groupes[$i], "0") === FALSE
					&& strpos($groupes[$i], "1") === FALSE
					&& strpos($groupes[$i], "2") === FALSE
					&& strpos($groupes[$i], "3") === FALSE
					&& strpos($groupes[$i], "4") === FALSE
					&& strpos($groupes[$i], "5") === FALSE
					&& strpos($groupes[$i], "6") === FALSE
					&& strpos($groupes[$i], "7") === FALSE
					&& strpos($groupes[$i], "8") === FALSE
					&& strpos($groupes[$i], "9") === FALSE) {
					if ($profs[0] == "non déterminé") {
						$profs[0] = $groupes[$i];
					}
					$groupes[$i] = "";
				}
			}
			sort($groupes);

			while (array_key_exists(0,$groupes) && $groupes[0] == "") {
				array_shift($groupes);
			}


			$filieres = array(libelleExisteFiliere($filiere)); // Filieres
			$id_profs = array(); // Professeurs
			foreach ($profs as $prof) {
				$nomPrenom = explode(" ", $prof);
				if (count($nomPrenom) != 2) {
					$prenom = $nomPrenom[count($nomPrenom)-1];
					$nom = "";
					for ($i=0; $i < count($nomPrenom)-1; $i++) {
						$nom .= $nomPrenom[$i];
						if ($i != count($nomPrenom)-2) {
							$nom .= ' ';
						}
					}
				} else {
					$nom = $nomPrenom[0];
					$prenom = $nomPrenom[1];
				}
				//echo $nom.'<br/>';//
				//echo $prenom.'<br/><br/>';//
				$id_prof = libelleExisteProfesseur($nom, $prenom);
				array_push($id_profs, $id_prof);
			}
			$dateDebut = $cours->getDateDebut(); // Date debut
			$dateFin = $cours->getDateFin();// Date fin
			$matiere = createMatiere($cours->getTitre()); // Matiere
			$matiere = libelleExisteMatiere($cours->getTitre());
			$salles = explode("\,", $cours->getNumeroSalle()); // Salles
			foreach ($salles as $salle) {
				createSalle($salle);
			}
			
			// Création du cours
			$coursCree = createCours($matiere, $groupes, $filieres, $id_profs, $salles, $dateDebut, $dateFin);
			if ($coursCree < 0) {
				throw new Exception($coursCree);
			}
		}
	}
?>
