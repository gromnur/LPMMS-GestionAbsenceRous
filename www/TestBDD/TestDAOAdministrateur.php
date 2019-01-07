<?php

require('../DAOFactory.php');

razBDD();

$identifiant = "admin.admin";
$nom = "admin";
$prenom = "admin";
$mdp = hash('sha256',"admin");


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
 * Test création administrateur
 */
echo "Insertion nouveau administrateur : ";
$id_admin = createAdministrateur($numpers);
if ($id_admin != 0) {
    echo "reussi, id_administrateur = ".$id_admin."<br>";
} else {
    echo "échoué code retourné : ".$id_admin."<br>";
}

// réinsertion administrateur
echo "Insertion meme administrateur : ";
$id_admin2 = createAdministrateur($numpers);
if ($id_admin2==0) {
    echo "non inserer, id_administrateur retrourné = ".$id_admin2."<br>";
} else {
    echo "erreur <br>";
}

// réinsertion administrateur
echo "Verif administrateur : ";
if (isAdministrateur($id_admin)) {
    echo "La personne est bien un admin<br>";
} else {
    echo "erreur <br>";
}

razBDD();

?>
