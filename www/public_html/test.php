<?php

require('DAO/AccesBDD.php');

function selectDepartement() {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement";
    $stmt = $bd->prepare($rqt);

    header('Content-type: application/json');

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[$ligne['id_departement']] = $ligne['libelle'];
        }
    }
    echo json_encode($listResult);
}

function lebontest() {
// Dans un fichier test.php
// Je déclare un tableau
    $array = ["foo", "bar"];
// J'indique au navigateur que je retourne du JSON
    header('Content-type: application/json');
// Je transforme mon tableau en JSON et je l'imprime dans le body de ma réponse
    echo json_encode($array);
}

function libelleExisteDepartement($libelle) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_departement, libelle FROM departement WHERE libelle = :libelle";
    $stmt = $bd->prepare($rqt);
    // ajout param
    $stmt->bindParam(":libelle", $libelle);
    // execution requette
    $stmt->execute();

    // récupération resultat
    $listResult = $stmt->fetchAll();

    if (count($listResult) == 0) {
        return 0;
    } else {
        echo json_encode($listResult[0]);
    }
}


function selectAvecDepartementFiliere($id_department) {
    // récupération accés base de données
    $bd = getConnexion();
    $rqt = "SELECT id_filiere, libelle, id_departement FROM filiere WHERE id_departement = :id_departement";
    $stmt = $bd->prepare($rqt);
    $stmt->bindParam(":id_departement", $id_department);

    $listResult = array();
    // execution requette
    if ($stmt->execute()) {
        while ($ligne = $stmt->fetch()) {
            $listResult[] = array($ligne['id_filiere'], $ligne['libelle'],$ligne['id_departement']);
        }
    }
    echo json_encode($listResult);
}

//le switch sert de "routeur" et appelle la fonction demandé par l'appel ajax 
//en fonction du parametre passer en POST
$func = $_POST['func'];

switch ($func) {
    case 'selectDept':
        selectDepartement();
        break;
    case 'test':
        lebontest();
        break;
    case 'param':
        $test = $_POST['test'];
        libelleExisteDepartement($test);
        break;
    default:
        //function not found, error or something
        break;
}
?>