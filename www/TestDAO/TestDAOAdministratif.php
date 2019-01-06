<?php

require('../DAOFactory.php');

razBDD();

$identifiant = "adminif.adminif";
$nom = "adminif";
$prenom = "adminif";
$mdp = hash('sha256',"adminif");
$libelleDep = "departement";
$libelleFil = "QLIO";


/*
 * Création personnel
 */
echo "Insertion nouveau personnel : ";
$numpers = createPersonnel($identifiant, $mdp, $nom, $prenom);
if ($numpers != 0) {
    echo "reussi, numeropersonnel = ".$numpers."<br>";
} else {
    echo "échoué <br>";
}

/*
 * Test création administratif
 */
echo "Insertion nouveau administratif : ";
$id_adminif = createAdministratif($numpers);
if ($id_adminif != 0) {
    echo "reussi, id_administratif = ".$id_adminif."<br>";
} else {
    echo "échoué code retourné : ".$id_adminif."<br>";
}

// réinsertion administratif
echo "Insertion meme administratif : ";
$id_adminif2 = createAdministratif($numpers);
if ($id_adminif2==0) {
    echo "non inserer, id_administratif retrourné = ".$id_adminif2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_administratif existe
 */
echo "Administratif présent : ";
if (isAdministratif($id_adminif)) {
    echo "Oui, id_administratif = ".$id_adminif."<br>";
} else {
    echo "Non<br>";
}

/*
* Création departement
*/
echo "Insertion nouveau departement : ";
$id_dep = createDepartement($libelleDep);
if ($id_dep != 0) {
 echo "reussi, id_departement = ".$id_dep."<br>";
} else {
 echo "échoué <br>";
}

/*
* Création filiere
*/
echo "Insertion nouvelle filiere : ";
$id_fil = createFiliere($libelleFil, $id_dep);
if ($id_fil > 0) {
 echo "reussi, id_filiere = ".$id_fil."<br>";
} else {
 echo "échoué <br>";
}

/*
 * Test isFiliereUniqueAdministratif existe
 */
echo "Filiere unique présente : ";
if (isFiliereUniqueAdministratif($id_fil)) {
    echo "Oui, filiere unique<br>";
} else {
    echo "Non filiere déja presente dans la table<br>";
}

/*
 * Test update administratif
 */
 echo "Mise a jour administratif : ";
$id_result = updateResponsableAdministratif($id_adminif, $id_fil);
if ($id_result > 0) {
 echo "reussi, administratif mis à jour<br>";
} else {
 echo "échoué code retour = ".$id_result."<br>";
}

/*
 * Test isFiliereUniqueAdministratif existe
 */
echo "Filiere unique présente : ";
if (isFiliereUniqueAdministratif($id_fil)) {
    echo "Oui, filiere unique<br>";
} else {
    echo "Non filiere déja presente dans la table<br>";
}

razBDD();

?>
