<?php

require('DAO/AccesBDD.php');

//function selectDepartement() {
//    // récupération accés base de données
//    $bd = getConnexion();
//    $rqt = "SELECT id_departement, libelle FROM departement";
//    $stmt = $bd->prepare($rqt);
//
//    header('Content-type: application/json');
//
//    $listResult = array();
//    // execution requette
//    if ($stmt->execute()) {
//        while ($ligne = $stmt->fetch()) {
//            $listResult[$ligne['id_departement']] = $ligne['libelle'];
//        }
//    }
//    echo json_encode($listResult);
//}
//
//function lebontest() {
//// Dans un fichier test.php
//// Je déclare un tableau
//    $array = ["foo", "bar"];
//// J'indique au navigateur que je retourne du JSON
//    header('Content-type: application/json');
//// Je transforme mon tableau en JSON et je l'imprime dans le body de ma réponse
//    echo json_encode($array);
//}
//
//function libelleExisteDepartement($libelle) {
//    // récupération accés base de données
//    $bd = getConnexion();
//    $rqt = "SELECT id_departement, libelle FROM departement WHERE libelle = :libelle";
//    $stmt = $bd->prepare($rqt);
//    // ajout param
//    $stmt->bindParam(":libelle", $libelle);
//    // execution requette
//    $stmt->execute();
//
//    // récupération resultat
//    $listResult = $stmt->fetchAll();
//
//    if (count($listResult) == 0) {
//        return 0;
//    } else {
//        echo json_encode($listResult[0]);
//    }
//}
//
//
//function selectAvecDepartementFiliere($id_department) {
//    // récupération accés base de données
//    $bd = getConnexion();
//    $rqt = "SELECT id_filiere, libelle, id_departement FROM filiere WHERE id_departement = :id_departement";
//    $stmt = $bd->prepare($rqt);
//    $stmt->bindParam(":id_departement", $id_department);
//
//    $listResult = array();
//    // execution requette
//    if ($stmt->execute()) {
//        while ($ligne = $stmt->fetch()) {
//            $listResult[] = array($ligne['id_filiere'], $ligne['libelle'],$ligne['id_departement']);
//        }
//    }
//    echo json_encode($listResult);
//}
//
////le switch sert de "routeur" et appelle la fonction demandé par l'appel ajax 
////en fonction du parametre passer en POST 'func'
//$func = $_POST['func'];
//
//switch ($func) {
//    case 'selectDept':
//        selectDepartement();
//        break;
//    case 'test':
//        lebontest();
//        break;
//    case 'param':
//        $test = $_POST['test'];
//        libelleExisteDepartement($test);
//        break;
//    case 'selectFiliereByDept':
//        $test = $_POST['param'];
//        selectAvecDepartementFiliere($test);
//        break;
//    default:
//        //function not found, error or something
//        break;
//}
//
//
//
//function lebontestduformulaire(){
//    print_r("lebontestdelafonction");
//}
//
//function libelleExisteDepartement($libelle) {
//    // récupération accés base de données
//    $bd = getConnexion();
//    $rqt = "SELECT id_departement, libelle FROM departement WHERE libelle = :libelle";
//    $stmt = $bd->prepare($rqt);
//    // ajout param
//    $stmt->bindParam(":libelle", $libelle);
//    // execution requette
//    $stmt->execute();
//
//    // récupération resultat
//    $listResult = $stmt->fetchAll();
//
//    if (count($listResult) == 0) {
//        return 0;
//    } else {
//        return $listResult[0]["id_departement"];
//    }
//}
//
//function createDepartement($libelle) {
//
//    // Verifier si le libelle n'est pas present
//    if (libelleExisteDepartement($libelle) != 0) {
//        // Si present renvoye 0
//        return 0;
//    }
//
//    // Creation d'un departement
//    // récupération accés base de données
//    $bd = getConnexion();
//    $rqt = "INSERT INTO departement(libelle) VALUES (:libelle)";
//    $stmt = $bd->prepare($rqt);
//    // ajout param
//    $stmt->bindParam(":libelle", $libelle);
//    // execution requette
//    $stmt->execute();
//    // renvoi le libelle généré
//    return libelleExisteDepartement($libelle);
//}
//
//$nomCreaDept = htmlspecialchars($_POST['nomCreaDept']);
//
//createDepartement($nomCreaDept);

