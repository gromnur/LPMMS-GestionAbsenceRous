<?php

require('../DAOFactory.php');

razBDD();

// insertion des departement
$dep_1 = createDepartement("informatique2");
echo "Insertion departement terminé <br>";

// création Filiere
$fil_1 = createFiliere("MMS",$dep_1);
$fil_2 = createFiliere("INFO1",$dep_1);
var_dump($fil_1);
echo "Insertion filiere terminé <br>";

// création Etudiant
$etud1 = createEtudiant('azertyuiop001','FR1','RE1');
$etud2 = createEtudiant('azertyuiop002','FR2','RE2');
$etud3 = createEtudiant('azertyuiop003','FR3','RE3');
$etud4 = createEtudiant('azertyuiop004','FR4','RE4');
$etud5 = createEtudiant('azertyuiop005','FR5','RE5');
echo "Insertion étudiant terminé <br>";

// création groupe etudiant
createGroupeEtudiant($etud1, $fil_1,"TD01");
createGroupeEtudiant($etud5, $fil_1,"TD02");
createGroupeEtudiant($etud5, $fil_1,"CM01");
createGroupeEtudiant($etud1, $fil_1,"CM01");
createGroupeEtudiant($etud2, $fil_2 ,"TD01");
createGroupeEtudiant($etud3, $fil_2 ,"TD01");
createGroupeEtudiant($etud4, $fil_2 ,"TD02");
createGroupeEtudiant($etud2, $fil_2 ,"CM01");
createGroupeEtudiant($etud3, $fil_2 ,"CM01");
createGroupeEtudiant($etud4, $fil_2 ,"CM01");
echo "Insertion groupe terminé <br>";

// création salle
$salle_1 = createSalle("A300");
$salle_2 = createSalle("A301");
$salle_3 = createSalle("A302");
echo "Insertion salle terminé <br>";

// création matiere
$matiere_1 = createMatiere("POO");
$matiere_2 = createMatiere("html");
echo "Insertion matiere terminé <br>";

// création personne
$pers_1 = createPersonnel("prof", hash("sha256","prof"), "prof", "prof");
$pers_2 = createPersonnel("profinfo2", hash("sha256","profinfo2"), "profinfo2", "profinfo2");
$pers_3 = createPersonnel("adminif", hash("sha256","adminif"), "adminif","adminif");
$pers_4 = createPersonnel("administratifinfo2", hash("sha256","administratifinfo2"), "administratifinfo2","administratifinfo2");
$pers_5 = createPersonnel("admin", hash("sha256","admin"), "admin","admin", 0);
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

// insertion administrateur
$admin_1 = createAdministrateur($pers_5);
echo "Insertion administrateur terminé <br>";


// création de cours
$cours_1 = createCours($matiere_1, array("TD01"), array($fil_1), array($prof_1), array($salle_1), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
$cours_2 = createCours($matiere_2, array("TD02"), array($fil_1), array($prof_2), array($salle_2), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
$cours_3 = createCours($matiere_1, array("TD01"), array($fil_2), array($prof_2), array($salle_2), "2018-12-22 11:00:00", "2018-12-22 12:00:00");
$cours_4 = createCours($matiere_1, array("TD02"), array($fil_2), array($prof_1), array($salle_1), "2018-12-22 11:00:00", "2018-12-22 12:00:00");
$cours_5 = createCours($matiere_2, array("CM01"), array($fil_2), array($prof_2), array($salle_1), "2018-12-22 14:00:00", "2018-12-22 16:00:00");
var_dump($cours_1);
var_dump($cours_2);
var_dump($cours_3);
var_dump($cours_4);
var_dump($cours_5);
echo "Insertion cours terminé <br>";

// création d'abscence
createAbsence($cours_1[0], $etud1);
createAbsence($cours_5[0], $etud1);
createAbsence($cours_3[0], $etud2);

var_dump(updateAbsence($cours_3[0], $etud2,"1"));
echo "Insertion absence terminé <br>";

// testt affichage matiere
echo "Affichage selectMatiereWithFiliere : <br>";
selectMatiereWithFiliere($fil_1);
echo "<br>";

 ?>
