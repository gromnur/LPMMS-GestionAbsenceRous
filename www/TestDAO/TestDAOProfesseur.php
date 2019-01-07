<?php


require('../DAOFactory.php');

razBDD();
$identifiant = "insertion.prof";
$nom = "insertion";
$prenom = "prof";
$mdp = hash('sha256',"le prof");


/*
 * Création personnel
 */
echo "Insertion nouveau personnel : ";
$numpers = createPersonnel($identifiant, $mdp, $nom, $prenom,);
if ($numpers != 0) {
    echo "reussi, numeropersonnel = ".$numpers."<br>";
} else {
    echo "échoué <br>";
}

/*
 * Test création professeur
 */
echo "Insertion nouveau professeur : ";
$id_prof = createProfesseur($numpers);
if ($id_prof != 0) {
    echo "reussi, id_professeur = ".$id_prof."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion professeur
echo "Insertion meme professeur : ";
$id_prof2 = createProfesseur($numpers);
if ($id_prof2==0) {
    echo "non inserer, id_professeur retrourné = ".$id_prof2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_professeur existe
 */
echo "Professeur présent : ";
if (isProfesseur($id_prof)) {
    echo "Oui, id_professeur = ".$id_prof."<br>";
} else {
    echo "Non<br>";
}

razBDD();

?>
