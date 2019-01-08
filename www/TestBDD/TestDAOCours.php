<?php

require('../DAOFactory.php');

razBDD();

$date_incorect = "fes zfqsd";
$date_deb = "2018-05-15 10:00:00";
$date_fin = "2018-05-15 12:00:00";

/*
 * Test date valide
 */
echo "Test date valide : ";
if(isExistedate($date_deb)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

/*
 * Test date valide
 */
echo "Test date valide : ";
if(isExistedate($date_fin)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

/*
 * Test date invalide
 */
echo "Test date valide : ";
if(isExistedate($date_incorect)) {
    echo "Valide <br>";
} else {
    echo "Invalide <br>";
}

// Insertion de donnée pour créé un cours

// insertion des departement
$dep_1 = createDepartement("informatique2");
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
echo "Insertion personnel terminé <br>";

// insertion prof
$prof_1  = createProfesseur($pers_1);
$prof_2  = createProfesseur($pers_2);
echo "Insertion prof terminé <br>";

/*
 * insertion cours
 */
echo "Insertion nouveau cour : ";
$cours_1 = createCours($matiere_1, array("TD01","TD02"), array($fil_1,$fil_1), array($prof_1), array($salle_1), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
if ($cours_1[0] != 0) {
    echo "reussi, id_cours = ";
    print_r($cours_1);
    echo "<br>";
} else {
    echo "échoué <br>";
}

// réinsertion cours
echo "Insertion meme cours : ";
$cours_2 = createCours($matiere_1, array("TD01"), array($fil_1), array($prof_1), array($salle_1), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
if ($cours_2[0]==0) {
    echo "non inserer, id_cours retrourné = ";
    print_r($cours_2);
    echo "<br>";
} else {
    echo "erreur <br>";
}

// insertion cours matiere introuvable
echo "Insertion nouveau cours matiere inexistante : ";
$cours_3 = createCours(56, array("TD01"), array($fil_1), array($prof_1), array($salle_1), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
echo "Code erreur retourner : $cours_3[0]<br>";

// insertion cours
echo "Insertion nouveau cours libelle_groupe/id_filiere inexistant inexistant : ";
$cours_4 = createCours($matiere_1, array("TD05"), array($fil_2), array($prof_2), array($salle_2), "2018-12-22 11:00:00", "2018-12-22 12:00:00");
echo "Code erreur retourner : $cours_4[0]<br>";

// insertion cours
echo "Insertion nouveau cours prof inexistant inexistant : ";
$cours_5 = createCours($matiere_1, array("TD01"), array($fil_2), array("fezfzfefzef"), array($salle_2), "2018-12-22 11:00:00", "2018-12-22 12:00:00");
echo "Code erreur retourner : $cours_5[0]<br>";

// insertion cours
echo "Insertion nouveau cours salle inexistant inexistant : ";
$cours_7 = createCours($matiere_1, array("TD01"), array($fil_2), array($prof_2), array("A600"), "2018-12-22 11:00:00", "2018-12-22 12:00:00");
echo "Code erreur retourner : $cours_7[0]<br>";

// insertion cours
echo "Insertion nouveau cours heur invalide inexistant : ";
$cours_8 = createCours($matiere_1, array("TD01"), array($fil_2), array($prof_2), array("A600"), "2zzadadaz", "2018-12-22 12:00:00");
echo "Code erreur retourner : $cours_8[0]<br>";

// insertion cours
echo "Insertion nouveau cours heur invalide inexistant : ";
$cours_9 = createCours($matiere_1, array("TD01"), array($fil_2), array($prof_2), array("A600"), "2018-12-22 12:00:00", "fezfzf");
echo "Code erreur retourner : $cours_9[0]<br>";

// test cours existe
echo "Test existe cours : ";
$cours_10 = coursExisteCours($matiere_1, "TD01", $fil_1, $prof_1, $salle_1, "2018-12-22 10:00:00", "2018-12-22 11:00:00");
if ($cours_10 != 0) {
    echo "L'id du cours est : $cours_10 <br>";
} else {
    echo "Erreur <br>";
}

// delete cours avec filiere
$del_1 = deleteByDateCours($fil_1,"2018-12-22", "2018-12-23");

// test cours existe
echo "Test existe cours : ";
$cours_10 = coursExisteCours($matiere_1, "TD01", $fil_1, $prof_1, $salle_1, "2018-12-22 10:00:00", "2018-12-22 11:00:00");
if ($cours_10 == 0) {
    echo "Le cours a bien été suprimé <br>";
} else {
    echo "Erreur <br>";
}

// test cours existe
echo "Test existe cours : ";
$cours_10 = coursExisteCours($matiere_1, "TD02", $fil_1, $prof_1, $salle_1, "2018-12-22 10:00:00", "2018-12-22 11:00:00");
if ($cours_10 == 0) {
    echo "Le cours a bien été suprimé <br>";
} else {
    echo "Erreur <br>";
}

echo "<br><br> Test cours terminé";

razBDD();
 ?>
