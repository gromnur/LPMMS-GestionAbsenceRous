<?php


require('../DAOFactory.php');

razBDD();

$identifiant = "michel.dupond";
$nom = "Michel";
$prenom = "Dupond";
$mdp = hash('sha256',"lemdp");


/*
 * Test création personnel
 */
echo "Insertion nouveau personnel : ";
$numpers = createPersonnel($identifiant, $mdp, $nom, $prenom);
if ($numpers != 0) {
    echo "reussi, numeropersonnel = ".$numpers."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion personnel
echo "Insertion meme personnel : ";
$numpers2 = createPersonnel($identifiant, $mdp, $nom, $prenom);
if ($numpers2==0) {
    echo "non inserer, numeropersonnel retrourné = ".$numpers2."<br>";
} else {
    echo "erreur <br>";
}

/*
 * Test id_personnel existe
 */
echo "Personnel présent : ";
$numpers3 = identifiantExistePersonnel($identifiant);
if ($numpers3 != 0) {
    echo "Oui, numeropersonnel = ".$numpers3."<br>";
} else {
    echo "Non<br>";
}

/*
 * Test id_personnel existe
 */
echo "Personnel numeropersonnel créé présent : ";
$result = idExistePersonnel($numpers);
if ($result) {
    echo "Oui, numeropersonnel = ".$numpers."<br>";
} else {
    echo "Non<br>";
}

razBDD();

?>
