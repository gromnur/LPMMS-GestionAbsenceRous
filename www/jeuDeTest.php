<?php

require('../DAOFactory.php');

// insertion des departement
$dep_1 = createDepartement("informatique");

// création Filiere
$fil_1 = createFiliere("LPMMS",$dep_1);
$fil_2 = createFiliere("INFO1",$dep_1);

// création groupe
$gr_1 = createGroupeEtudiant($fil_1,"01");
$gr_2 = createGroupeEtudiant($fil_2 ,"TD01");
$gr_3 = createGroupeEtudiant($fil_2 ,"TD02");

// création salle
$salle_1 = "A300";
$salle_2 = "A301";

// création salle
$matiere_1 = createMatiere("POO");
$matiere_2 = createMatiere("html");

// création personne
$pers_1 = createPersonnel("profinfo1", "profinfo1","profinfo1",hash("sha256","profinfo"));
$pers_2 = createPersonnel("profinfo2", "profinfo2","profinfo2",hash("sha256","profinfo2"));
$pers_3 = createPersonnel("administratifinfo", "administratifinfo","administratifinfo",hash("sha256","administratifinfo"));
$pers_4 = createPersonnel("administratifinfo2", "administratifinfo2","administratifinfo2",hash("sha256","administratifinfo2"));
$pers_5 = createPersonnel("administrateur", "administrateur","administrateur",hash("sha256","administrateur"));

// création adminif
$adminif_1 = createAdministratif($pers_3);
$adminif_2 = createAdministratif($pers_4);
updateResponsableAdministratif($adminif_1,$fil_3);
updateResponsableAdministratif($adminif_2,$fil_4);

// création prof



 ?>
