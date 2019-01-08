<?php

require('../DAOFactory.php');

razBDD();

// Insertion de donnée pour créé une abscence

// insertion des departement
$dep_1 = createDepartement("informatique2");
echo "Insertion departement terminé <br>";

// création Filiere
$fil_1 = createFiliere("MMS",$dep_1);
echo "Insertion filiere terminé <br>";

// création Etudiant
$etud1 = createEtudiant('azertyuiop001','FR1','RE1');
echo "Insertion étudiant terminé <br>";

// création groupe etudiant
createGroupeEtudiant($etud1, $fil_1,"TD01");
echo "Insertion groupe terminé <br>";

// création salle
$salle_1 = createSalle("A300");
echo "Insertion salle terminé <br>";

// création matiere
$matiere_1 = createMatiere("POO");
echo "Insertion matiere terminé <br>";

// création personne
$pers_1 = createPersonnel("prof", hash("sha256","prof"), "prof", "prof");
echo "Insertion personnel terminé <br>";

// insertion prof
$prof_1  = createProfesseur($pers_1);
echo "Insertion prof terminé <br>";

// création de cours
$cours_1 = createCours($matiere_1, array("TD01"), array($fil_1), array($prof_1), array($salle_1), "2018-12-22 10:00:00", "2018-12-22 11:00:00");
echo "Insertion cours terminé <br>";

/*
 * insertion absence
 */
echo "Insertion nouvelle absence : ";
$abs_1 = createAbsence($cours_1[0], $etud1);
if (count($abs_1) != 0) {
    echo "Insetion absence reussi<br>";
} else {
    echo "échoué <br>";
}

// réinsertion absence
echo "Insertion meme absence : ";
$abs_2 = createAbsence($cours_1[0], $etud1);
if (count($abs_2) == 0) {
    echo "Non Insetion absence reussi <br>";
} else {
    echo "échoué <br>";
}

// vérification presence absence
echo "Verification absence : ";
$abs_3 = isExisteAbsence($cours_1[0], $etud1);
if (count($abs_3) != 0) {
    echo "Absence présente : ";
    print_r($abs_3);
    echo "<br>";
} else {
    echo "échoué <br>";
}

// vérification modification absence
echo "Verification AVANT modification absence : ";
selectAvecEtudiantAbsence($etud1);
echo "<br>";

// mise a jour de l'Absence
echo "Mise à jour dela justification absence : ";
$abs_4 = updateAbsence($cours_1[0], $etud1, "1");
if ($abs_4) {
    echo "Absence présente mise a jour <br>";
} else {
    echo "échoué <br>";
}

// vérification modification absence
echo "Verification APRES modification absence : ";
selectAvecEtudiantAbsence($etud1);
echo "<br>";

// supression absence
echo "Supression absence <br>";
deleteAbsence($cours_1[0], $etud1);


// vérification modification absence
echo "Verification supression absence : ";
$abs_6 = isExisteAbsence($cours_1[0], $etud1);
if (count($abs_6) == 0) {
    echo "Absence suprimé ";
    print_r($abs_6);
    echo "<br>";
} else {
    echo "échoué <br>";
}




razBDD();
 ?>
