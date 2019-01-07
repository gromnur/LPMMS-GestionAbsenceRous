<?php


require('../DAOFactory.php');

razBDD();

$identifiant = "michel.dupond";
$identifiantIncorect = "Lichel.Lupond";
$nom = "Michel";
$prenom = "Dupond";
$mdp = hash('sha256',"lemdp");


/*
 * Test création personnel
 */
echo "Insertion nouveau personnel : ";
$numpers = createPersonnel($identifiant, $mdp, $nom, $prenom, 0);
if ($numpers != 0) {
    echo "reussi, numeropersonnel = ".$numpers."<br>";
} else {
    echo "échoué <br>";
}

// réinsertion personnel
echo "Insertion meme personnel : ";
$numpers2 = createPersonnel($identifiant, $mdp, $nom, $prenom);
if ($numpers2 == 0) {
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

/*
 * Test verifMDP compinaison valide
 */
echo "Test verification mdp/identifiant : ";
$choixPersonnel1 = verifMDP($identifiant, $mdp);
if (count($choixPersonnel1) == 3) {
    echo "Oui combinaison valide<br>";
    print_r($choixPersonnel1);
    echo "<br>";
} else {
    echo "Non<br>";
}


/*
 * Test verifMDP compinaison invalide
 */
echo "Test verification mdp/identifiant incorect: ";
$choixPersonnel2 = verifMDP($identifiantIncorect, $mdp);
if ($choixPersonnel2 == null) {
    echo "Oui combinaison invalide<br>";
    print_r($choixPersonnel2);
    echo "<br>";
} else {
    echo "Non erreur result<br>";
}

//razBDD();

?>
