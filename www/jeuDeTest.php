<?php

require('DAOFactory.php');

// insertion des departement
$dep_1 = createDepartement("informatique");

// création Filiere
$fil_1 = createFiliere("MMS",$dep_1);
$fil_2 = createFiliere("INFO1",$dep_1);

// création groupe
$gr_1 = createGroupeEtudiant($fil_1,"TD01");
$gr_2 = createGroupeEtudiant($fil_2 ,"TD01");
$gr_3 = createGroupeEtudiant($fil_2 ,"TD02");

// création salle
$salle_1 = createSalle("A300");
$salle_2 = createSalle("A301");

// création salle
$matiere_1 = createMatiere("POO");
$matiere_2 = createMatiere("html");

// création personne
$pers_1 = createPersonnel("profinfo1", hash("sha256","profinfo"), "profinfo1","profinfo1");
$pers_2 = createPersonnel("profinfo2", hash("sha256","profinfo2"), "profinfo2","profinfo2");
$pers_3 = createPersonnel("administratifinfo", hash("sha256","administratifinfo"), "administratifinfo","administratifinfo");
$pers_4 = createPersonnel("administratifinfo2", hash("sha256","administratifinfo2"), "administratifinfo2","administratifinfo2");
$pers_5 = createPersonnel("administrateur", hash("sha256","administrateur"), "administrateur","administrateur");

// création adminif
$adminif_1 = createAdministratif($pers_3);
$adminif_2 = createAdministratif($pers_4);
updateResponsableAdministratif($pers_3,$fil_1);
updateResponsableAdministratif($pers_4,$fil_2);

// création prof
echo "pers 1 ".$pers_1."<br>";
$prof_1  = createProfesseur($pers_1);
echo $prof_1."<br>";
echo "pers 2 ".$pers_1."<br>";
$prof_2  = createProfesseur($pers_2);
echo $prof_1."<br>";

// TODO faire un csv pour les étudiants.

echo "Insertion terminé";
 ?>
