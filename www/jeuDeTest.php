<?php

require('DAOFactory.php');

// insertion des departement
$dep_1 = createDepartement("informatique");
echo "Insertion departement terminé <br>";

// création Filiere
$fil_1 = createFiliere("MMS",$dep_1);
$fil_2 = createFiliere("INFO1",$dep_1);
echo "Insertion filiere terminé <br>";


// création Etudiant
$etud1 = createEtudiant('azertyuiop001','FR1','RE1');
$etud2 = createEtudiant('azertyuiop002','FR2','RE2');
$etud3 = createEtudiant('azertyuiop003','FR3','RE3');
$etud4 = createEtudiant('azertyuiop004','FR4','RE4');
$etud5 = createEtudiant('azertyuiop005','FR5','RE5');
echo "Insertion étudiant terminé <br>";

// création groupe etudiant
$gr_1 = createGroupeEtudiant($etud1, $fil_1,"TD01");
$gr_1 = createGroupeEtudiant($etud5, $fil_1,"TD01");
$gr_2 = createGroupeEtudiant($etud1, $fil_1,"TD02");
$gr_3 = createGroupeEtudiant($etud2, $fil_2 ,"TD01");
$gr_3 = createGroupeEtudiant($etud3, $fil_2 ,"TD01");
$gr_4 = createGroupeEtudiant($etud4, $fil_2 ,"TD02");
echo "Insertion groupe terminé <br>";

// création salle
$salle_1 = createSalle("A300");
$salle_2 = createSalle("A301");
$salle_3 = createSalle("A301 A302");
echo "Insertion salle terminé <br>";

// création matiere
$matiere_1 = createMatiere("POO");
$matiere_2 = createMatiere("html");
echo "Insertion matiere terminé <br>";

// création personne
$pers_1 = createPersonnel("profinfo1", hash("sha256","profinfo"), "profinfo1", "profinfo1");
$pers_2 = createPersonnel("profinfo2", hash("sha256","profinfo2"), "profinfo2", "profinfo2");
$pers_3 = createPersonnel("administratifinfo", hash("sha256","administratifinfo"), "administratifinfo","administratifinfo");
$pers_4 = createPersonnel("administratifinfo2", hash("sha256","administratifinfo2"), "administratifinfo2","administratifinfo2");
$pers_5 = createPersonnel("administrateur", hash("sha256","administrateur"), "administrateur","administrateur");
echo "Insertion personnel terminé <br>";

// création adminif
$adminif_1 = createAdministratif($pers_3);
$adminif_2 = createAdministratif($pers_4);
updateResponsableAdministratif($pers_3,$fil_1);
updateResponsableAdministratif($pers_4,$fil_2);
echo "Insertion administratif terminé <br>";

// insertion prof
$prof_1  = createProfesseur($pers_1);
$prof_2  = createProfesseur($pers_2);
echo "Insertion prof terminé <br>";



// création de cours
$cours_1 = createCours($matiere_1, "TD01", $fil_2, $prof_1, $salle_1, "2018-12-22 10:00:00", "2018-12-22 11:00:00");
$cours_2 = createCours($matiere_2, "TD01", $fil_1, $prof_1, $salle_2, "2018-12-22 10:00:00", "2018-12-22 12:00:00");
$cours_3 = createCours($matiere_1, "TD01", $fil_2, $prof_2, $salle_2, "2018-12-22 11:00:00", "2018-12-22 12:00:00");
$cours_4 = createCours($matiere_1, "TD02", $fil_2, $prof_1, $salle_1, "2018-12-22 11:00:00", "2018-12-22 12:00:00");
echo "code retours cours : ".$cours_1."<br>";



 ?>
